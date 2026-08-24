<?php
namespace App\Model\DTO;

class ProduitDTO
{

    public function __construct(
        public readonly string $libelle,
        public readonly float $prix_vente,
        public readonly int $stock_initial
    ) {
    }
}
