<?php

namespace Apps\App\Model;
use Apps\Core\Model\Model;
use Apps\App\Entity\EtudiantEntity;

class EtudiantModel extends Model {
    protected string $table = 'etudiants';
    
    public function getEntity() {
        return EtudiantEntity::class;
    }
    
    
    public function findById($id) {
        $sql = "SELECT e.*, u.nom, u.prenom, u.email, c.libelle as classe, c.filiere, c.niveau
                FROM etudiants e
                JOIN utilisateurs u ON e.id = u.id
                JOIN inscriptions i ON e.id = i.id_etudiant
                JOIN classes c ON i.id_classe = c.id
                WHERE e.id = ?";
        return $this->database->prepare($sql, [$id], $this->getEntity(), true);
    }
    
    public function getCoursEtudiant($id, $currentPage = 1, $perPage = 1) {
        $offset = ($currentPage - 1) * $perPage;

        $sql = "SELECT
                    e.id AS etudiant_id,
                    e.matricule,
                    u.nom AS etudiant_nom,
                    u.prenom AS etudiant_prenom,
                    c.id AS classe_id,
                    c.libelle AS classe_libelle,
                    cr.id AS cours_id,
                    cr.libelle AS cours_libelle,
                    m.libelle AS module_libelle,
                    cr.nombre_heure_global,
                    sem.libelle AS semestre_libelle,
                    prof.nom AS professeur_nom,
                    prof.prenom AS professeur_prenom
                FROM etudiants e
                JOIN utilisateurs u ON e.id = u.id
                JOIN inscriptions i ON e.id = i.id_etudiant
                JOIN classes c ON i.id_classe = c.id
                JOIN cours_classes cc ON c.id = cc.id_classe
                JOIN cours cr ON cc.id_cours = cr.id
                JOIN modules m ON cr.id_module = m.id
                JOIN semestres sem ON cr.id_semestre = sem.id
                JOIN professeurs p ON cr.id_professeur = p.id
                JOIN utilisateurs prof ON p.id = prof.id
                WHERE e.id = ?
                LIMIT ? OFFSET ?";
        
        return $this->database->prepare($sql, [$id, $perPage, $offset]);
    }

    public function countCoursEtudiant($id) {
        $sql = "SELECT COUNT(*) as total
                FROM etudiants e
                JOIN inscriptions i ON e.id = i.id_etudiant
                JOIN classes c ON i.id_classe = c.id
                JOIN cours_classes cc ON c.id = cc.id_classe
                JOIN cours cr ON cc.id_cours = cr.id
                WHERE e.id = ?";
        
        $result = $this->database->prepare($sql, [$id], null, true);
        return $result['total'];
    }

    public function getSessionCoursEtudiant($id) {
        $sql = "SELECT
    sc.id AS session_id,
    sc.date AS session_date,
    sc.heure_debut AS session_heure_debut,
    sc.heure_fin AS session_heure_fin,
    sc.nombre_heure AS session_nombre_heure,
    sc.type_session,
    sc.etat_session,
    s.nom AS salle_nom,
    s.numero AS salle_numero,
    s.nombre_places AS salle_nombre_places,
    c.libelle AS cours_libelle,
    m.libelle AS module_libelle,
    cl.libelle AS classe_libelle
FROM
    etudiants e
JOIN
    inscriptions i ON e.id = i.id_etudiant
JOIN
    classes cl ON i.id_classe = cl.id
JOIN
    cours_classes cc ON cl.id = cc.id_classe
JOIN
    cours c ON cc.id_cours = c.id
JOIN
    modules m ON c.id_module = m.id
JOIN
    session_cours sc ON c.id = sc.id_cours
JOIN
    salles s ON sc.id_salle = s.id
WHERE
    e.id = ?"; 


        return $this->database->prepare($sql, [$id]);
    }



    public function getEtudiantById($id)
{
    $sql = "SELECT e.id, e.matricule, u.nom, u.prenom, u.email, u.telephone,
                   c.libelle as classe, c.filiere, c.niveau
            FROM etudiants e
            JOIN utilisateurs u ON e.id = u.id
            JOIN inscriptions i ON e.id = i.id_etudiant
            JOIN classes c ON i.id_classe = c.id
            WHERE e.id = ?";
    
    $params = [$id];
    
    try {
        $result = $this->database->prepare($sql, $params, 'Apps\\App\\Entity\\Etudiant', true);
        
        if (!$result) {
            throw new \Exception("Aucun étudiant trouvé avec l'ID: $id");
        }
        
        return $result;
    } catch (\PDOException $e) {
        // Log l'erreur ou gérez-la comme vous le souhaitez
        error_log("Erreur lors de la récupération de l'étudiant: " . $e->getMessage());
        throw new \Exception("Une erreur est survenue lors de la récupération des informations de l'étudiant.");
    }
}
}

