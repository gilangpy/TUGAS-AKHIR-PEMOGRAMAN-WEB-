<?php
require_once '../app/core/Database.php';
require_once '../config/config.php';
$db = new Database();
try {
    $db->executeParams("ALTER TABLE laporan_masyarakat ADD COLUMN solusi TEXT NULL", []);
    echo "Added solusi column";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
