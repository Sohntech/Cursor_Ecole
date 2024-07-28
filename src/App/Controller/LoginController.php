<?php
namespace Apps\App\Controller;

use Apps\App\Model\UserModel;
use Apps\Core\Controller;
use Apps\Core\Session;
use Apps\Core\Validators\Validator;
use Apps\App\App;

class LoginController extends Controller {
    private $userModel;
    private $validator;

    public function __construct() {
        $this->userModel = App::getInstance()->getModel("UserModel");
        $this->validator = new Validator();
    }

    public function showLogin() {
        $this->renderView("login", []); 
    }

    public function login() {
        $data = [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
        ];
    
        $rules = [
            'username' => ['required', 'alphaNum'],
            'password' => ['required', 'min:6'],
        ];
    
        $errors = $this->validator->validate($data, $rules);
    
        if (!is_null($errors)) {
            $this->renderView("login", ['errors' => $errors]);
            return;
        }
    
        $user = $this->userModel->getUserByUsername($data['username']);
        if ($user && $data['password'] == $user->getPassword()) {
            Session::start();
            Session::set('user', $user->getId());
            
            $roleId = $user->getIdRole();

            switch ($roleId) {
                case 3:
                    $this->redirect("professeur");
                    break;
                case 4:
                    $this->redirect("etudiant");
                    break;
                default:
                    $this->redirect("default");
                    break;
            }
        } else {
            $this->renderView("login", ['error' => 'Nom d\'utilisateur ou mot de passe incorrect.']);
        }
    }
    

    public function logout() {
        Session::close();
        $this->redirect("login");
    }
}

