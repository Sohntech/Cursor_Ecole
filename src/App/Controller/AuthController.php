<?php 
namespace Apps\App\Controller;

use Apps\Core\Security\AuthMiddleware;
use Apps\Core\Session;
use Apps\Core\Controller;


class AuthController extends Controller {
    private $userModel;
    private $validator;

    public function __construct($userModel, $validator) {
        parent::__construct();
        $this->userModel = $userModel;
        $this->validator = $validator;
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

    public function showLogin() {
        if (Session::isset('user')) {
            $this->redirect('etudiant'); 
        } else {
            $this->renderView('login');
        }
    }
    


}