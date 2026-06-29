<?php
// app/controllers/HomeController.php

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Dashboard - ' . APP_NAME
        ];
        
        $this->view('layouts/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('layouts/footer');
    }

    // Alias untuk /home route
    public function home() {
        $this->index();
    }
}
