<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Movie;
use App\Models\People;

class MainController extends CoreController {

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function homeAction()
    {
        $this->show('home');
    }

    /**
     * Méthode qui se charge d'afficher la page de résultats de recherche
     *
     * @return void
     */
    public function searchAction()
    {
        // On récupère la valeur du champ de recherche
        $search = filter_input(INPUT_GET, 'search');

        
        $movieModel = new Movie();
        $movies = $movieModel->searchByTitle($search);

        $title = "Résultats de recherche pour :";

        $this->show('result', [
            'movies' => $movies,
            'search' => $search,
            'title' => $title
        ]);
    }


    /**
     * Méthode qui se charge d'afficher la page de détail d'un film
     *
     * @return void
     */
    public function movieAction($urlParams)
    {
        // On récupère l'id du film
        $id = $urlParams['id'];

        // On récupère le film correspondant à l'id
        $movieModel = new Movie();
        $movie = $movieModel->find($id);

        // On récupère le réalisateur du film
        $director = $movie->getDirector();

        // On récupère le compositeur du film
        $composer = $movie->getComposer();

        // Bonus : on récupère les acteurs du film
        $actors = $movie->getActors();



        // On passe les données à la vue
        $this->show('movie', [
            'movie' => $movie,
            'director' => $director,
            'composer' => $composer,
            'actors' => $actors
        ]);
    }

    /**
     * Méthode qui affiche tous les films d'un réalisateur
     * 
     * @param array $urlParams
     * @return void
     */
    public function directorAction($urlParams)
    {
        // On récupère l'id du réalisateur
        $id = $urlParams['id'];

        // On récupère le réalisateur correspondant à l'id
        $peopleModel = new People();
        $director = $peopleModel->find($id);

        // On récupère les films du réalisateur
        $movies = $director->getMoviesDirected();

        // On génère le titre de la page
        $title = "Films réalisés par ";

        // On range le nom dans une variable $search pour l'utiliser dans le titre de la page
        $search = $director->getName();

        // On passe les données à la vue
        // Comme l'agencement est le même que la page de résultats, on réutilise la vue result
        $this->show('result', [
            'director' => $director,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }

    /**
     * Méthode qui affiche tous les films d'un compositeur
     * 
     * @param array $urlParams
     * @return void
     */

    public function composerAction($urlParams)
    {
        // On récupère l'id du compositeur
        $id = $urlParams['id'];

        // On récupère le compositeur correspondant à l'id
        $peopleModel = new People();
        $composer = $peopleModel->find($id);

        // On récupère les films du compositeur
        $movies = $composer->getMoviesComposed();

        // On génère le titre de la page
        $title = "Films composés par ";

        // On range le nom dans une variable $search pour l'utiliser dans le titre de la page
        $search = $composer->getName();

        // On passe les données à la vue
        // Comme l'agencement est le même que la page de résultats, on réutilise la vue result
        $this->show('result', [
            'composer' => $composer,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }

    /**
     * Méthode qui affiche tous les films d'un acteur
     * 
     * @param array $urlParams
     * @return void
     */

    public function actorAction($urlParams)
    {
        // On récupère l'id de l'acteur
        $id = $urlParams['id'];

        // On récupère l'acteur correspondant à l'id
        $peopleModel = new People();
        $actor = $peopleModel->find($id);

        // On récupère les films de l'acteur
        $movies = $actor->getMoviesPlayed();

        // On génère le titre de la page
        $title = "Films joués par ";

        // On range le nom dans une variable $search pour l'utiliser dans le titre de la page
        $search = $actor->getName();

        // On passe les données à la vue
        // Comme l'agencement est le même que la page de résultats, on réutilise la vue result
        $this->show('result', [
            'actor' => $actor,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }


}