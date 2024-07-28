<?php
namespace Apps\App\Entity;

use Apps\Core\Entity\Entity;

class CoursEntity extends Entity {
    protected int $id;
    protected string $id_module;
    protected string $id_professeur;
    protected string $id_semestre;
    protected int $nombre_heure_global;
    protected string $semestre;
    protected string $module;
    protected string $classe;
    protected string $professeur;
   
   
    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}