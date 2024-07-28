<?php 
namespace Apps\App\Model;
use Apps\Core\Model\Model;
use Apps\App\Entity\UserEntity;


class UserModel extends Model {
   
    protected string $table = 'utilisateurs';

    public function getEntity() {
        return UserEntity::class;
    }
    public function getUserById($id) {
        $sql = "SELECT CONCAT(prenom, ' ',nom) as nom_complet FROM utilisateurs WHERE id = :id";
        $result = $this->database->prepare($sql, ['id' => $id], $this->getEntity(), true);
        if ($result) {
            return new UserEntity($result);
        }
        return null;
    }
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM utilisateurs WHERE username = :username";
        $result = $this->database->prepare($sql, ['username' => $username], $this->getEntity(), true);
        if ($result) {
            return new UserEntity($result);
        }
        return null;
    }

    public function getUserRoleById($id) {
        $sql = "SELECT id_role FROM utilisateurs WHERE id = :id";
        $result = $this->database->prepare($sql, ['id' => $id], null, true);
        if ($result) {
            return $result->id_role; 
        }
        return null;
    }

  
}