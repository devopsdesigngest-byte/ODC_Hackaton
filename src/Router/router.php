<?php

class router {
    private array $router;
    private string $uri;

    public function __construct() {
        $this->router = [
            '/lister/vente' => [
                'controller' => 'POSController',
                'action' => 'showVue'
            ],
            '/supprimer/ligne/panier' => [
                'controller' => 'POSController',
                'action' => 'supprimerLigne'
            ],
            '/ajouter/vente' => [
                'controller' => 'POSController',
                'action' => 'ajouterVente'
            ]
        ];
    }

    public function router() : void {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = $this->router[$this->uri]; 

        $controller = $route['controller'];
        $action = $route['action'];

        $path = dirname(__DIR__) . "/Controller/$controller.php";

        if (file_exists($path)) {
            require_once $path;
            $newIns = new $controller(); 
            $newIns->$action();
        } else {
            die("Erreur fichier");
        }
    }
}