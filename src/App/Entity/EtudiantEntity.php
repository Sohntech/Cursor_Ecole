<?php
namespace Apps\App\Entity;

use Apps\Core\Entity\Entity;

class EtudiantEntity extends Entity {
    protected int $id;
    protected string $prenom;
    protected string $nom;
    protected string $email;
    protected string $telephone;
    protected string $photo;
    protected string $role_id;
    protected string $password;
    protected string $adresse;
    protected string $login;
    protected string $matricule;

   
    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}