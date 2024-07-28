<?php
namespace Apps\Core;

use Apps\App\App;
final class SecurityDatabase
{
    private $database;

    private function __construct()
    {
        $this->database = App::getDatabase();
    }

    public function getUser($userId)
    {
        $query = "SELECT r.libelle FROM Utilisateurs u JOIN `Roles` r ON r.id = u.role_id WHERE u.id = :user_id";
        $result = $this->database->prepare($query, ["user_id" => $userId],true);
        return $result;
    }
}




