<?php

namespace Apps\App\Controller;
use Apps\App\Model\UserModel;
use Apps\Core\Validators\Validator;
use Apps\Core\Controller;
use Apps\Core\Session;
use Apps\App\App; 

class ProfesseurController extends Controller
{
    private $professeurModel;
    private $coursModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct(); 
        $this->professeurModel = App::getInstance()->getModel("ProfesseurModel");
        $this->coursModel = App::getInstance()->getModel("CoursModel");
        $this->userModel = App::getInstance()->getModel("UserModel");
    }

    public function index()
    {
        $this->renderView("professeur", []);  
    }

    public function showAllCourses()
    {
        $idProfesseur = Session::get('user');
        $courses = $this->coursModel->getAllCourses($idProfesseur);
        $user = $this->userModel->getUserById($idProfesseur);
        $this->renderView("professeur", ["courses" => $courses, "user" => $user]);
    } 
    

    public function showLayout()
    {
        $this->renderView("layout", []);
    }
    public function showSession()
    {
        $this->renderView("session"); 
    }
}
