<?php

namespace Pokedex\Models;

use \PDO;

class Type extends CoreModel
{
    private $id;
    private $name;
    private $color;

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
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    // Function to get all the types
    public static function findAllType()
    {
        $sql = "SELECT * FROM `type` ORDER BY `id`";

        // Connexion to the BDD via PDO et function getPDO from CoreModel
        $pdo = self::getPDO();

        $pdoStatement = $pdo->query($sql);

        $types = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $types;
    }

    // Function to get all the pokemons with a specific type
    public static function findAllByType($types)
    {
        $sql = "SELECT 
        `pokemon`.*
        FROM `pokemon_type`
        INNER JOIN `pokemon` ON `pokemon`.`numero` = `pokemon_numero`
        WHERE `pokemon_type`.`type_id` = ?
        ORDER BY `type_id";

        // Connexion to the BDD via PDO et function getPDO from CoreModel
        $pdo = self::getPDO();

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute(array($types['id']));

        $pokemons = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $pokemons;
    }


}