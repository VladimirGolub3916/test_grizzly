<?php
session_start();
require_once 'autoload.php';

use App\Controllers\FormController;

$controller = new FormController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleFormSubmission($_POST);
} else {
    $controller->showForm();
}
