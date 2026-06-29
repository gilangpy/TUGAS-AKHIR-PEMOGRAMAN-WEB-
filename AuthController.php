<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login_type = $_POST['login_type'] ?? 'user';
            $password = $_POST['password'];
            
            $is_admin = ($login_type === 'admin');
            $identifier = $is_admin ? filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);

            $userModel = $this->model('User');
            $loggedInUser = $userModel->login($identifier, $password, $is_admin);

            if ($loggedInUser) {
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['user_nama'] = $loggedInUser['nama'];
                $_SESSION['user_role'] = $loggedInUser['role'];
                
                // Redirect based on role
                if (in_array($loggedInUser['role'], ['superadmin', 'admin_bpbd'])) {
                    header('Location: ' . BASE_URL . '/admin');
                } else {
                    header('Location: ' . BASE_URL);
                }
            } else {
                $error_msg = $is_admin ? 'Username atau password salah.' : 'Nama atau password salah.';
                $data = [
                    'title' => 'Login - ' . APP_NAME,
                    'error' => $error_msg
                ];
                $this->view('layouts/header', $data);
                $this->view('auth/login', $data);
                $this->view('layouts/footer');
            }
        } else {
            $data = ['title' => 'Login - ' . APP_NAME];
            $this->view('layouts/header', $data);
            $this->view('auth/login', $data);
            $this->view('layouts/footer');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $register_type = $_POST['register_type'] ?? 'user';
            $is_admin = ($register_type === 'admin');
            
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $password = $_POST['password'];
            $no_hp = null;
            $username = null;

            // Validasi Password
            if (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{6,}$/', $password)) {
                return $this->showAuthError('register', 'Password minimal 6 karakter, harus terdiri dari huruf dan angka, dan tidak boleh mengandung spasi atau karakter khusus.');
            }

            $userModel = $this->model('User');

            if ($is_admin) {
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                if ($userModel->getUserByUsername($username)) {
                    return $this->showAuthError('register', 'Username sudah terdaftar.');
                }
            } else {
                $no_hp = filter_input(INPUT_POST, 'no_hp', FILTER_SANITIZE_STRING);
                // Validasi no hp minimal 11 digit angka
                if (!preg_match('/^[0-9]{11,}$/', $no_hp)) {
                    return $this->showAuthError('register', 'Nomor HP harus berupa angka dan minimal 11 digit.');
                }
                if ($userModel->getUserByHp($no_hp)) {
                    return $this->showAuthError('register', 'Nomor HP sudah terdaftar.');
                }
                if ($userModel->getUserByNama($nama)) {
                    return $this->showAuthError('register', 'Nama sudah terdaftar. Silakan gunakan nama lain untuk login nanti.');
                }
            }

            $data = [
                'nama' => $nama,
                'no_hp' => $no_hp,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            if ($userModel->register($data, $is_admin)) {
                // Auto login after registration
                $identifier = $is_admin ? $username : $nama;
                $loggedInUser = $userModel->login($identifier, $password, $is_admin);
                
                if ($loggedInUser) {
                    $_SESSION['user_id'] = $loggedInUser['id'];
                    $_SESSION['user_nama'] = $loggedInUser['nama'];
                    $_SESSION['user_role'] = $loggedInUser['role'];
                    if ($is_admin) {
                        header('Location: ' . BASE_URL . '/admin');
                    } else {
                        header('Location: ' . BASE_URL);
                    }
                } else {
                    header('Location: ' . BASE_URL . '/auth/login?registered=true');
                }
            } else {
                return $this->showAuthError('register', 'Terjadi kesalahan saat pendaftaran.');
            }
        } else {
            $data = ['title' => 'Register - ' . APP_NAME];
            $this->view('layouts/header', $data);
            $this->view('auth/register', $data);
            $this->view('layouts/footer');
        }
    }

    private function showAuthError($view, $message) {
        $viewData = [
            'title' => ucfirst($view) . ' - ' . APP_NAME,
            'error' => $message
        ];
        $this->view('layouts/header', $viewData);
        $this->view('auth/' . $view, $viewData);
        $this->view('layouts/footer');
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}
