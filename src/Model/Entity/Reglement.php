<?php

require_once "Dette.php";
require_once "ModePaiement.php";

class Reglement {
    private int $id;
    private DateTime $date_reglement;
    private float $montant_verse;

    private Dette $dette;
    private ModePaiement $modePaiement;

    public function __construct(int $id, DateTime $date_reglement, float $montant_verse, Dette $dette, ModePaiement $modePaiement) {
        $this->id = $id;
        $this->date_reglement = $date_reglement;
        $this->montant_verse = $montant_verse;
        $this->dette = $dette;
        $this->modePaiement = $modePaiement;
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getDateReglement() : DateTime {
        return $this->date_reglement;
    }

    public function setDateReglement(DateTime $date_reglement) : void {
        $this->date_reglement = $date_reglement;
    }

    public function getMontantVerse() : float {
        return $this->montant_verse;
    }

    public function setMontantVerse(float $montant_verse) : void {
        $this->montant_verse = $montant_verse;
    }

    public function getDette() : Dette {
        return $this->dette;
    }

    public function setDette(Dette $dette) : void {
        $this->dette = $dette;
    }

    public function getModePaiement() : ModePaiement {
        return $this->modePaiement;
    }

    public function setModePaiement(ModePaiement $modePaiement) : void {
        $this->modePaiement = $modePaiement;
    }
}
