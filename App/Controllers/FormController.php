<?php

namespace App\Controllers;

use App\Services\FormValidationService;
use App\Services\FormProcessingService;

class FormController
{
    private FormValidationService $validationService;
    private FormProcessingService $processingService;

    public function __construct()
    {
        $this->validationService = new FormValidationService();
        $this->processingService = new FormProcessingService();
    }

    public function showForm(): void
    {
        include __DIR__ . '/../Views/form.php';
    }

    public function handleFormSubmission(array $formData): never
    {
        $errors = $this->validationService->validate($formData);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $formData;
            header("Location: /");
            exit;
        }

        $this->processingService->saveData($formData);
        $_SESSION['success'] = true;
        header("Location: /");
        exit;
    }
}
