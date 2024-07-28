<?php

namespace Apps\App\Model;
use Apps\Core\Model\Model;
use Apps\App\Entity\CoursEntity;

class CoursModel extends Model
{

    protected string $table = 'cours';

    public function getEntity() {
        return CoursEntity::class;
    }

    public function save($data) {
            $sql = "INSERT INTO cours (nom, description, photo, professeur_id) VALUES (:nom, :description, :photo, :professeur)";
        $this->database->prepare($sql, $data, $this->getEntity());
    }


    public function getAllCourses($idProfesseur) {
        $sql = "SELECT 
        c.id,
        m.libelle as module,
        cl.libelle as classe,
        s.libelle as semestre,
        c.nombre_heure_global as nombre_heure_global,
        CONCAT(u.nom, ' ', u.prenom) as professeur
        FROM 
            cours c
        JOIN 
            modules m ON m.id = c.id_module
        JOIN 
            professeurs p ON p.id = c.id_professeur
        JOIN 
            semestres s ON s.id = c.id_semestre
        JOIN 
            cours_classes cc ON cc.id_cours = c.id
        JOIN 
            classes cl ON cl.id = cc.id_classe
        JOIN utilisateurs u ON u.id = p.id
        WHERE 
            p.id = :idProfesseur";
            $result = $this->database->prepare($sql, ['idProfesseur' => $idProfesseur], $this->getEntity());
            return $result;
        }
        public function getCoursesForEtudiant($idEtudiant)
        {
            $sql = "SELECT m.libelle as module, s.libelle as semestre, 
                           CONCAT(u.nom, ' ', u.prenom) as professeur,
                           c.nombre_heure_global, sc.type_session,
                           CASE 
                               WHEN sc.date > CURDATE() THEN 'À venir'
                               ELSE 'Terminé'
                           END as statut
                    FROM etudiants e
                    JOIN inscriptions i ON e.id = i.id_etudiant
                    JOIN classes cl ON i.id_classe = cl.id
                    JOIN cours_classes cc ON cl.id = cc.id_classe
                    JOIN cours c ON cc.id_cours = c.id
                    JOIN modules m ON c.id_module = m.id
                    JOIN semestres s ON c.id_semestre = s.id
                    JOIN professeurs p ON c.id_professeur = p.id
                    JOIN utilisateurs u ON p.id = u.id
                    JOIN session_cours sc ON c.id = sc.id_cours
                    WHERE e.id = ?
                    GROUP BY c.id";
            return $this->database->prepare($sql, [$idEtudiant]);
        }
        }