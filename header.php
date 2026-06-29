<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? APP_NAME; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/style.css">

    <!-- Bootstrap 5 JS (di head agar siap sebelum view) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet JS (WAJIB di head agar L tersedia saat view dirender) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
// Determine active nav item based on current URL segment
$currentUrl = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$urlParts   = explode('/', $currentUrl);
$segment1   = $urlParts[0] ?? ''; // e.g. 'laporan', 'auth', 'evakuasi'
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL; ?>/home">
        <i class="fa-solid fa-shield-halved text-brand me-2"></i>MDEWS
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php 
          $dashLink = BASE_URL . '/home';
          if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['superadmin', 'admin_bpbd'])) {
              $dashLink = BASE_URL . '/admin';
          }
          ?>
          <a class="nav-link <?= ($segment1 === '' || $segment1 === 'home' || $segment1 === 'admin') ? 'active fw-semibold' : ''; ?>" href="<?= $dashLink; ?>">
            <i class="fa-solid fa-house me-1"></i>Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($segment1 === 'laporan') ? 'active fw-semibold' : ''; ?>" href="<?= BASE_URL; ?>/laporan/create">
            <i class="fa-solid fa-triangle-exclamation me-1"></i>Lapor Kejadian
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($segment1 === 'evakuasi') ? 'active fw-semibold' : ''; ?>" href="<?= BASE_URL; ?>/evakuasi">
            <i class="fa-solid fa-map-location-dot me-1"></i>Peta Evakuasi
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($segment1 === 'komunitas') ? 'active fw-semibold' : ''; ?>" href="<?= BASE_URL; ?>/komunitas">
            <i class="fa-solid fa-bell me-1"></i>Notifikasi & Grup
          </a>
        </li>
        <!-- Auth Links -->
        <li class="nav-item ms-lg-3 dropdown">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a class="btn btn-brand px-3 dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-user me-1"></i><?= htmlspecialchars(explode(' ', $_SESSION['user_nama'])[0]); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item text-danger" href="<?= BASE_URL; ?>/auth/logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Keluar</a></li>
                </ul>
            <?php else: ?>
                <a class="btn btn-outline-brand px-3" href="<?= BASE_URL; ?>/auth/login">
                  <i class="fa-solid fa-right-to-bracket me-1"></i>Login
                </a>
            <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4 mb-5">
