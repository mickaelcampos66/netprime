<?php 



require __DIR__.'/../vendor/autoload.php';

// Gestion des routes
$router = new AltoRouter();

$router->setBasePath($_SERVER['BASE_URI']);

$router->map(
    'GET',  
    '/',
    [    
        'controller' => 'MainController',
        'method' => 'homeAction'
    ],
    'home'
);


// Creation routes
$router->map(
    'GET',
    '/results',
    [
        'controller' => 'MainController',
        'method' => 'searchAction'
    ],
    'search'
);

// Route pour la page de détail d'un film
$router->map(
    'GET',
    '/movie/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'movieAction'
    ],
    'movie'
);


$router->map(
    'GET',
    '/director/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'directorAction'
    ],
    'director'
);


$router->map(
    'GET',
    '/composer/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'composerAction'
    ],
    'composer'
);

$router->map(
    'GET',
    '/actor/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'actorAction'
    ],
    'actor'
);


$match = $router->match();


if($match !== false) {
  
   
    $controllerToUse = 'App\Controllers\\' . $match['target']['controller'];

    $methodToUse = $match['target']['method'];
    $params = $match['params'];
    $controller = new $controllerToUse();
    $controller->$methodToUse($params);

} else {
    echo "Erreur 404 - la page n'existe pas";
}