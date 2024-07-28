<?php
namespace Apps\App\Entity;

use Apps\Core\Entity\Entity;

class Session_coursEntity extends Entity {
    protected int $id;
    protected string $date;
    protected string $heure_debut ;
    protected string $heure_fon;
    protected int $nombre_heure;
    protected string $type_session;
    protected string $etat_session;
    protected int $id_cours;
    protected int $id_salle;

   
    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}