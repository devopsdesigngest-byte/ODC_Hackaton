<?php 

class ModePaiement {
    private int $id; 
    private string $libelle;  

    public function getLibelle(): string {
        return $this->libelle;
    }
}
