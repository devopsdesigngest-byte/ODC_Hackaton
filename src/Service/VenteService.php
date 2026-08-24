<?php

// use App\Core\Database;

// require_once dirname(__DIR__) . "/Core/Database.php";
// require_once dirname(__DIR__) . "/Model/Repository/ProduitRepository.php";
// require_once dirname(__DIR__) . "/Model/Repository/CommandeRepository.php";

// class VenteService {

//     public static function enregistrerVente(int $clientId, int $utilisateurId, int $modePaiementId, float $montantAvance, array $lignes) : int {
//         Database::beginTransaction();

//         try {
//             $montantTotal = 0;

//             foreach ($lignes as $ligne) {
//                 $montantTotal += $ligne['sousTotal'];
//             }

//             $commandeId = CommandeRepository::saveCommande($montantTotal, $montantAvance, $clientId, $utilisateurId, $modePaiementId);

//             foreach ($lignes as $ligne) {
//                 CommandeRepository::saveLigneCommande($ligne['quantite'], $ligne['prixUnitaire'], $ligne['sousTotal'], $commandeId, $ligne['produitId']);
//                 ProduitRepository::diminuerStock($ligne['produitId'], $ligne['quantite']);
//             }

//             $montantRestant = $montantTotal - $montantAvance;

//             if ($montantRestant > 0) {
//                 CommandeRepository::saveDette($montantTotal, $montantRestant, null, 'Non solde', $commandeId);
//             }

//             Database::commit();

//             return $commandeId;

//         } catch (Exception $e) {
//             Database::rollback();
//             throw $e;
//         }
//     }
// }

// use App\Core\Database;

// require_once dirname(__DIR__) . "/Core/Database.php";
// require_once dirname(__DIR__) . "/Model/Repository/ProduitRepository.php";
// require_once dirname(__DIR__) . "/Model/Repository/CommandeRepository.php";

// class VenteService {
//     private Database $database;
//     private ProduitRepository $produitRepository;
//     private CommandeRepository $commandeRepository;

//     public function __construct() {
//         $this->database = Database::getInstance();
//         $this->produitRepository = new ProduitRepository();
//         $this->commandeRepository = new CommandeRepository();
//     }

//     public function enregistrerVente(int $clientId, int $utilisateurId, int $modePaiementId, float $montantAvance, array $lignes) : int {
//         $this->database->beginTransaction();
//         try {
//             $montantTotal = 0;
//             foreach ($lignes as $ligne) {
//                 $montantTotal += $ligne['sousTotal'];
//             }
//             $commandeId = $this->commandeRepository->saveCommande($montantTotal, $montantAvance, $clientId, $utilisateurId, $modePaiementId);
//             foreach ($lignes as $ligne) {
//                 $this->commandeRepository->saveLigneCommande($ligne['quantite'], $ligne['prixUnitaire'], $ligne['sousTotal'], $commandeId, $ligne['produitId']);
//                 $this->produitRepository->diminuerStock($ligne['produitId'], $ligne['quantite']);
//             }
//             $montantRestant = $montantTotal - $montantAvance;
//             if ($montantRestant > 0) 
//                 $this->commandeRepository->saveDette($montantTotal, $montantRestant, null, 'Non solde', $commandeId);
//                 $this->database->commit();
//             return $commandeId;
//         } catch (Exception $e) {
//             $this->database->rollback();
//             throw $e;
//         }
//     }
// }