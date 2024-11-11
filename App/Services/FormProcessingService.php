<?php

namespace App\Services;

use App\Models\SurveyForm;

class FormProcessingService
{
    public function saveData(array $data): void
    {
        $surveyForm = new SurveyForm();
        $surveyForm->save($data);
    }
}
