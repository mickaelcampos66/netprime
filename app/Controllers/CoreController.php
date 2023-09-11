<?php

namespace App\Controllers;


class CoreController {

    /**
     * Fonction qui se charge d'afficher une page donnée
     *
     * @param string $viewName Nom du template de page à afficher
     * @param array $viewData Tableau contenant les différentes informations qu'on veut passer à notre vue
     * @return void
     */

    public function show($viewName, array $viewData = [])
    {
       
        global $router;
        
        $absoluteUrl = $_SERVER['BASE_URI'];
        var_dump($absoluteUrl);
        extract($viewData);

        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
    
}