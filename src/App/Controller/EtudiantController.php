<?php

namespace Apps\App\Controller;

use Apps\Core\Controller;
use Apps\Core\Session;
use Apps\App\App;

class EtudiantController extends Controller
{
    private $etudiantModel;
    private $coursModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->etudiantModel = App::getInstance()->getModel("EtudiantModel");
        $this->coursModel = App::getInstance()->getModel("CoursModel");
        $this->userModel = App::getInstance()->getModel("UserModel");
    }

    public function index()
    {
        $this->renderView("etudiant", []);
    }

    public function showAllCourse() 
    {
        $idEtudiant = Session::get('user');
        $currentPage = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $perPage = 1; 
        $totalCourses = $this->etudiantModel->countCoursEtudiant($idEtudiant);
        $totalPages = ceil($totalCourses / $perPage);

        $courses = $this->etudiantModel->getCoursEtudiant($idEtudiant, $currentPage, $perPage);
        $user = $this->userModel->getUserById($idEtudiant);

        $this->renderView("etudiant", [
            "courses" => $courses,
            "user" => $user,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages
        ]);
    }

    public function showAllSessions()
    {
        $idEtudiant = Session::get('user');
        $sessions = $this->etudiantModel->getSessionCoursEtudiant($idEtudiant);
        $this->renderView("sessionC", ["sessions" => $sessions]);

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
