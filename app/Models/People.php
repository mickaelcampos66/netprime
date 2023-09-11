<?php 

namespace App\Models;

use PDO;
use App\Utils\Database;

class People
{
    /**
     * Propriétés de la classe People
     */
    private $id;
    private $name;
    private $picture_url;

    /**
     * Méthodes de la classe People
     */

    /**
    * Méthode permettant de récupérer un objet de type People d'après son ID
    *
    * @param int $id ID de la personne à trouver
    * @return People
    */
    public function find($id)
    {
        // Si l'id n'existe pas, on arrête tout
        if($id === null) {
            return false;
        }

        $pdo = Database::getPDO();

       
        $sql = "SELECT * FROM `people`
        WHERE `id` = " . $id;

        $pdoStatement = $pdo->query($sql);
        $people = $pdoStatement->fetchObject(People::class);

        return $people;
    }

    /**
     * Méthode permettant de récupérer tous les films réalisés par la personne courante.
     *
     * @return Movie[]
     */
    public function getMoviesDirected()
    {
     
        $pdo = Database::getPDO();

        // Je fais ma requete SQL récupérant tous les films dont le réalisateur est la personne courante
        $sql = "SELECT * FROM `movies`
        WHERE `director_id` = " . $this->id;

        $pdoStatement = $pdo->query($sql);
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * Méthode permettant de récupérer tous les films composés par la personne courante.
     *
     * @return Movie[]
     */
    public function getMoviesComposed()
    {

        $pdo = Database::getPDO();

     
        $sql = "SELECT * FROM `movies`
            WHERE `composer_id` = " . $this->id;

        // Je la transmets à la BDD via PDO
        $pdoStatement = $pdo->query($sql);
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * Méthode permettant de récupérer tous les films joués par la personne courante.
     *
     * @return Movie[]
     */
    public function getMoviesPlayed()
    {
        
        $pdo = Database::getPDO();

       
        $sql = "SELECT * FROM `movies`
            INNER JOIN `movie_actors` ON `movies`.`id` = `movie_actors`.`movie_id`
            WHERE `movie_actors`.`actor_id` = " . $this->id;

 
        $pdoStatement = $pdo->query($sql);
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * Méthode général l'url complète vers l'image d'une personne
     *
     * @return string
     */
    public function getPicture()
    {
        return  "https://image.tmdb.org/t/p/original" . $this->picture_url; 
    }

    /**
     * Getters et setters
     */ 


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of picture_url
     */ 
    public function getPictureUrl()
    {
        return $this->picture_url;
    }



    /**
     * Set the value of picture_url
     *
     * @return  self
     */ 
    public function setPictureUrl($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
}