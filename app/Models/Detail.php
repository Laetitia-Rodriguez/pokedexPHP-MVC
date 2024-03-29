<?php

namespace Pokedex\Models;

use \PDO;

class Detail extends CoreModel {
    private $id;
    private $nom;
    private $pv;
    private $attaque;
    private $defense;
    private $attaque_spe;
    private $defense_spe;
    private $vitesse;
    private $numero;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of pv
     */ 
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * Set the value of pv
     *
     * @return  self
     */ 
    public function setPv($pv)
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * Get the value of attaque
     */ 
    public function getAttaque()
    {
        return $this->attaque;
    }

    /**
     * Set the value of attaque
     *
     * @return  self
     */ 
    public function setAttaque($attaque)
    {
        $this->attaque = $attaque;

        return $this;
    }

    /**
     * Get the value of defense
     */ 
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set the value of defense
     *
     * @return  self
     */ 
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get the value of attaque_spe
     */ 
    public function getAttaque_spe()
    {
        return $this->attaque_spe;
    }

    /**
     * Set the value of attaque_spe
     *
     * @return  self
     */ 
    public function setAttaque_spe($attaque_spe)
    {
        $this->attaque_spe = $attaque_spe;

        return $this;
    }

    /**
     * Get the value of defense_spe
     */ 
    public function getDefense_spe()
    {
        return $this->defense_spe;
    }

    /**
     * Set the value of defense_spe
     *
     * @return  self
     */ 
    public function setDefense_spe($defense_spe)
    {
        $this->defense_spe = $defense_spe;

        return $this;
    }

    /**
     * Get the value of vitesse
     */ 
    public function getVitesse()
    {
        return $this->vitesse;
    }

    /**
     * Set the value of vitesse
     *
     * @return  self
     */ 
    public function setVitesse($vitesse)
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    // Function to get all the pokemons
    public static function findAll() {

        $sql = "SELECT * FROM pokemon ORDER BY numero";

        // Connexion to the BDD via PDO et function getPDO from CoreModel
        $pdo = self::getPDO();

        $pdoStatement = $pdo->query($sql);

        $pokemons =$pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $pokemons;

    }


    // Function to get a pokemon by "numero"
    public static function find($pokemon) {

        $sql = "SELECT * FROM pokemon WHERE numero = ?";

        // Connexion to the BDD via PDO et function getPDO from CoreModel
        $pdo = self::getPDO();

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute(array($pokemon['numero']));

        $pokemon =$pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $pokemon;

    }

    // Function to get the name and color's type for one pokemon
    // with the junction table "pokemon_type"
    public static function getType($pokemon) {

        $sql = "SELECT 
        `type`.* 
        FROM `pokemon_type`
        INNER JOIN `type` ON `type`.`id` = `type_id`
        WHERE pokemon_type.pokemon_numero = ?";

        // Connexion to the BDD via PDO et function getPDO from CoreModel
        $pdo = self::getPDO();

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute(array($pokemon['numero']));

        $types = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $types;

    }
}