<?php
namespace App\Models;

use App\Helpers\Database;

class SurveyForm
{
    public function save(array $data): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, surname, birth_date, email, marital_status, about)
            VALUES (:first_name, :last_name, :surname, :birth_date, :email, :marital_status, :about)");
        
        $stmt->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':surname' => $data['surname'] ?? '',
            ':birth_date' => $data['birth_date'],
            ':email' => $data['email'] ?? '',
            ':marital_status' => $data['marital_status'],
            ':about' => $data['about'] ?? ''
        ]);

        $userId = $pdo->lastInsertId();

        $stmtPhone = $pdo->prepare("INSERT INTO user_phones (user_id, country_code, phone) VALUES (:user_id, :country_code, :phone)");
        
        foreach ($data['phone'] as $index => $phone) {
            $stmtPhone->execute([
                ':user_id' => $userId,
                ':country_code' => $data['country_code'][$index],
                ':phone' => $phone
            ]);
        }
    }
}
