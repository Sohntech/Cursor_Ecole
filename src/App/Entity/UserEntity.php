<?php
namespace Apps\App\Entity;
class UserEntity {
    private $id;
    private $username;
    private $password;
    private $nom;
    private $prenom;
    private $nom_complet;
    private $email;
    private $id_role;
    private $telephone;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
    

    // Getters et setters pour chaque propriété
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getNomComplet() {
        return $this->nom_complet;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getIdRole() {
        return $this->id_role;
    }
    public function getTelephone() {
        return $this->telephone;
    }

}
