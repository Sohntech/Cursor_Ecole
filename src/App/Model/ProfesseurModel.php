<?php

namespace Apps\App\Model;
use Apps\Core\Model\Model;
use Apps\App\Entity\ProfeseurEntity;

class ProfesseurModel extends Model
{

    protected string $table = 'professeurs';

    public function getEntity() {
        return ProfeseurEntity::class;
    }

    public function save($data) {
            $sql = "INSERT INTO professeurs (prenom, nom, email, telephone, photo, role_id, adresse) VALUES (:prenom, :nom, :email, :tel, :photo, :role, :adresse)";
        $this->database->prepare($sql, $data, $this->getEntity());
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM professeurs WHERE email = :email";
        $result = $this->database->prepare($sql, ['email' => $email], $this->getEntity(), true);
        if ($result) {
            return new ProfeseurEntity($result);
        }
        return null;
    }

   
}