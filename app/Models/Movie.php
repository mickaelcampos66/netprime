<?php 

namespace App\Models;

use PDO;
use App\Utils\Database;

class Movie {

    /** 
     * Propriétés de la classe Movie
     */
    private $id;
    private $title; 
    private $synopsis;
    private $release_date;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;


    /** 
     * Méthodes de la classe Movie
     */


     /**
     * Méthode permettant de récupérer un objet de type Movie d'après son ID
     *
     * @param int $id ID du film à trouver
     * @return Movie
     */
    public function find($id)
    {
        // On se connecte à la BDD à l'aide de notre outil Database. Celui-ci nous renvoie une instance de PDO connectée à la BDD.
        $pdo = Database::getPDO();
            
        // Je fais ma requete SQL
        $sql = "SELECT * FROM `movies`
        WHERE `id` = " . $id;

        $pdoStatement = $pdo->query($sql);
        $movie = $pdoStatement->fetchObject(Movie::class);

        return $movie;
    }

    /**
     * Méthode permettant de récupérer un objet de type Movie d'après son titre
     *
     * @param string $title Titre ou morceau du titre du film à trouver
     * @return Movie[]
     */
    public function searchByTitle($search)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `movies`
        WHERE `title` LIKE '%" . $search . "%'";

        $pdoStatement = $pdo->query($sql);
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }
    
    /**
     * Méthode permettant de récupérer un objet de type People représentant le réalisateur du film
     * 
     * @return People
     */
    public function getDirector()
    {
        $director = new People();
        $director = $director->find($this->director_id);

        return $director;
    }

    /**
     * Méthode permettant de récupérer un objet de type People représentant le compositeur du film
     * 
     * @return People
     */
    public function getComposer()
    {
        $composer = new People();
        $composer = $composer->find($this->composer_id);

        return $composer;
    }

    /** 
     * Méthode permettant de récupérer une liste d'ojbets de type People représentant les acteurs du film
     *
     * @return People[]
     */
    public function getActors()
    {
        $pdo = Database::getPDO();

        $sql = "SELECT `people`.*
        FROM `people`
        JOIN `movie_actors` ON `people`.`id` = `movie_actors`.`actor_id`
        WHERE `movie_id` = " . $this->id;

        $pdoStatement = $pdo->query($sql);
        $actors = $pdoStatement->fetchAll(PDO::FETCH_CLASS, People::class);

        return $actors;
    }


    /**
     * Méthode permettant de récupérer l'année du film d'après sa date de sortie
    */
    public function getYear()
    {
        $year = date('Y', strtotime($this->release_date));

        return $year;
    }

    /**
     * Méthode générant une URL pour afficher le poster du film
     */ 
    public function getPoster()
    {
        return "https://image.tmdb.org/t/p/original" . $this->poster_url;
    }


    /**
     * Méthode générant une URL pour afficher l'image de fond du film
     */
    public function getBackground()
    {
        return "https://image.tmdb.org/t/p/original". $this->background_url;
    }

    /**
     * Getters et setters
     */
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set the value of synopsis
     *
     * @return  self
     */ 
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get the value of release_date
     */ 
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setReleaseDate($releaseDate)
    {
        $this->release_date = $releaseDate;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of poster_url
     */ 
    public function getPosterUrl()
    {
        return  $this->poster_url;
    }

    /**
     * Set the value of poster_url
     *
     * @return  self
     */ 
    public function setPosterUrl($posterUrl)
    {
        $this->poster_url = $posterUrl;

        return $this;
    }

    /**
     * Get the value of background_url
     */
    public function getBackgroundUrl()
    {
        return $this->background_url;
    }

    /**
     * Set the value of background_url
     *
     * @return  self
     */ 
    public function setBackgroundUrl($backgroundUrl)
    {
        $this->background_url = $backgroundUrl;

        return $this;
    }

    /**
     * Get the value of director_id
     */ 
    public function getDirectorId()
    {
        return $this->director_id;
    }

    /**
     * Set the value of director_id
     *
     * @return  self
     */ 
    public function setDirectorId($directorId)
    {
        $this->director_id = $directorId;

        return $this;
    }

    /**
     * Get the value of composer_id
     */ 
    public function getComposerId()
    {
        return $this->composer_id;
    }

    /**
     * Set the value of composer_id
     *
     * @return  self
     */ 
    public function setComposerId($composerId)
    {
        $this->composer_id = $composerId;

        return $this;
    }
}
