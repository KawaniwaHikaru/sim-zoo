<?php

require_once('Animal.php');

class Zoo {

	// private variables
    private $animals;
    private $hour;

    // 
    public static $animalTypes = ['Monkey', 'Giraffe', 'Elephant'];


    public function __construct() {

        $this->hour = 0;

    	// 3 types of animal
        for($i = 0; $i < 3; $i++) {

        	$animal = self::$animalTypes[$i];

        	// 5 animals each
        	for ($j = 0; $j < 5; $j ++)

        		$this->animals[] = new $animal;
        }

    }

    public function nextHour() {
        $this->hour++;

        foreach($this->animals as $k => &$animal) {

            $animal->starve();
        }
    }

    public function feed() {

    	// 3 types of animals
        for($i = 0; $i < 3; $i++) {

        	// generate a fodder for each type of animal
			$fodder = rand(0,25) / 100;
        	
        	// 5 animals each
        	for ($j = 0; $j < 5; $j ++)

        		$this->animals[$i*5+$j]->feed($fodder);
        }
    }

    public function getAnimals() {
        return $this->animals;
    }

    public function getHour() {
        return $this->hour;
    }

}