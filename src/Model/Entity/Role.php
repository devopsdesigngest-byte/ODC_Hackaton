<?php
namespace App\Model\Entity;

class Role {
    private int $id;
    private string $nom_role;
    private array $utilisateurs = [];

    public function __construct(int $id, string $nom_role = 'Admin Boutique'){
        $this->id = $id;
        $this->nom_role = $nom_role;
        $this->utilisateurs = [];
    }

    public function getId() : int {
        return $this->id;
    }
    public function setId(int $id) : void {
        if($id > 0)
            $this->id = $id;
    }

    public function getUtilisateurs() : array {
        return $this->utilisateurs;
    }

    public function getNomRole() : string {
        return $this->nom_role;
    }
    public function setNomRole(string $nom_role) : void {
        if($nom_role == 'Admin Boutique' || $nom_role == 'Chargé de Vente' || $nom_role == 'Chargé de Stock' || $nom_role == 'Inventaire')
            $this->nom_role = $nom_role;
    }
    
}