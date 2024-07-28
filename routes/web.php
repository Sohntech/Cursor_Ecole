<?php
use Apps\Core\Router;

$route = new Router();
$route->get('login',['controller'=>'LoginController','action'=>'showLogin']);
$route->post('login',['controller'=>'LoginController','action'=>'login']);
$route->get('professeur',['controller'=>'ProfesseurController','action'=>'showAllCourses']);
$route->get('etudiant',['controller'=>'EtudiantController','action'=>'showAllCourse']);
$route->post('etudiant',['controller'=>'EtudiantController','action'=>'showAllCourse']);
$route->post('sessionC',['controller'=>'EtudiantController','action'=>'showAllSessions']);
$route->get('layout',['controller'=>'ProfesseurController','action'=>'showLayout']);
$route->post('logout',['controller'=>'AuthController','action'=>'logout']);

$route::separate();