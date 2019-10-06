<?php

    class Pokemon
    {
        public $name;
        public $health;
        protected $hp;
        public $attacks;

        function __construct($pokemon) {
            $this ->name = $pokemon ['name'];
            $this ->health = $pokemon['health'];
            $this ->attacks = $pokemon['attacks'];


            $this ->hp = $this->health ;



        }
        public function attack($target, $attack){
            $target->takeDamage($attack['damage']);

        }

        public function takeDamage($amount){
            $newHp = $this->hp - $amount ;
            if ($newHp <= 0){
            //    you died
            echo $this->name . 'has been defeated ' ;
            echo '<a href="index.php?reset=1">New Game</a>';
            die ;
            }
            $this ->hp =$newHp;
        }
        public function getHP(){
            return $this ->hp;
        }
    }



 ?>
