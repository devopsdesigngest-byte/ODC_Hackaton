<?php 
require_once (PATHBASE."/app/models/client.model.php");
require_once (PATHBASE."/app/models/dette.model.php");


function listerDette() : void {
    // $dettesRestantes = getDettesRestants();
    $paiements = getAllPaiement();
    require_once (PATHBASE."/app/view/listerDettes.html.php");
}

function enregistrerDette() : void{
    // $allClients = getAllClients();
    // saveDette($_POST);
    $_POST['ref'] = "ddfgg";
    $_POST['client_id'] = (int)$_POST['client_id'];
    $_POST['montant_restant'] = 0;
        
    

    header("Location: http://localhost:8000/");
    exit;
        
}

function enregisterReglement() : void {
    $dettes = getAllDettes() ?? [];
    updateDette(_POST);
}
