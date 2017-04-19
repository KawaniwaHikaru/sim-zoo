<?php
require_once('Names.php');

/**
* Basic class for Animal
*/
abstract class Animal
{
    private $hp;
    private $state;
    private $name;

    // constant state
    const ALIVE = 'alive';
    const DEAD = 'dead';

    public function __construct() {
        $this->hp = 100.0;
        $this->state = Animal::ALIVE;
        $this->name = NameFactory::getRandomName();
    }

    // params
    // $perc the percentage in health increase, float
    public function feed($perc) {

        if ($this->state == Animal::DEAD) return;

        // The health of the respective animals is to be increased by the
        // specified percentage of their current health. eg, hp+= hp * 0.20
        $this->hp += $this->hp * $perc;

        //Health should be capped at 100%. we pick the minimal of 100.0 or lower value
        if ($this->hp > 100.0) $this->hp = 100.0;
    }

    // params
    // $rand is a random number between 0 and 20
    public function starve() {

        if ($this->state == Animal::DEAD) return;

        //a random value between 0 and 20 is to be generated for each animal.
        //This value should be passed to the appropriate animal, whose health is then reduced by that percentage of their current health.
        $rand = rand(0,20);
        $this->hp *= (100 - $rand) / 100;
    }

    /* Getter functions */
    public function getHP() {
        return $this->hp;
    }

    public function getState() {
        return $this->state;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return get_class($this);
    }

    public function isDead() {
        return $this->state == ANIMAL::DEAD;
    }

    public function stateChange($newState) {
        $this->state = $newState;
    }
}

class Monkey extends Animal {

    // When a Monkey has a health below 30%, or a Giraffe below 50%, it is pronounced dead straight away. 
    const FLATLINE = 30;

    public function starve() {

        // call base class to reduce health
        parent::starve();

        if($this->getHP() < self::FLATLINE) {
            $this->stateChange(Animal::DEAD);
        }
    }
}

class Giraffe extends Animal {

    // When a Monkey has a health below 30%, or a Giraffe below 50%, it is pronounced dead straight away. 
    const FLATLINE = 50;

    public function starve() {

        // call base class to reduce health
        parent::starve();

        if($this->getHP() < self::FLATLINE) {
            $this->stateChange(Animal::DEAD);
        }
    }
}

class Elephant extends Animal {

    // When an Elephant has a health below 70% it cannot walk.
    // If its health does not return above 70% once the subsequent hour has elapsed, it is pronounced dead.
    const FLATLINE = 70;
    const IMMOBILE = 'immobile';

    // overwriting feed
    public function feed($perc) {
        parent::feed($perc);

        if ($this->getState() == Animal::DEAD) return;

        // if we are immobile and our HP is now greater then 70%, we are alive
        if ($this->getState() == self::IMMOBILE) {

            if ($this->getHP() >= self::FLATLINE)
                $this->stateChange(Animal::ALIVE); // revive this elephant
            // else 
            //     $this->stateChange(Animal::DEAD);  // too late, this animal is still dead
            // after reviewing the requirement, it seems like feeding would not lapse hours
        }
    }

    public function starve() {
        parent::starve();

        if ($this->getState() == Animal::DEAD) return;


        // If its health does not return above 70% once the subsequent hour has elapsed, it is pronounced dead.
        if ($this->getState() == self::IMMOBILE)
            $this->stateChange(Animal::DEAD);

        else if ($this->getHP() < self::FLATLINE) {
            $this->stateChange(self::IMMOBILE);
        }
    }
}
