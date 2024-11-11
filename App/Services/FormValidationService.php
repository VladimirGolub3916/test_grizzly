<?php

namespace App\Services;

class FormValidationService
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['first_name'])) {
            $errors['first_name'] = 'Имя обязательно';
        }

        if (empty($data['last_name'])) {
            $errors['last_name'] = 'Фамилия обязательна';
        }

        if (empty($data['birth_date'])) {
            $errors['birth_date'] = 'Дата рождения обязательна';
        }

        if (empty($data['phone']) && empty($data['email'])) {
            $errors['phone'] = 'Заполните хотя бы одно поле: Телефон или Email';
        }

        return $errors;
    }
}
