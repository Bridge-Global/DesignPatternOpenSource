<?php 
	/* Abstract Factory Example - Animal World*/{
   
    abstract class ContinentFactory //Abstract factory
    {
        abstract public function createVictim();
        abstract public function createHunter();
    }
	
	// Concrete factory 1
	class AfricaFactory extends ContinentFactory //Concrete Factory
    {
        
        public function createVictim() //Factory Method
        {
            return new Rabbit();
        }
        
        public function createHunter() //Factory Method
        {
            return new Lion();
        }
    }
	
	// Concrete factory2
	class AmericaFactory extends ContinentFactory //Concrete Factory
    {
        
        public function createVictim() //Factory Method
        {
             return new Deer();
        }
        
        public function createHunter() //Factory Method
        {
            return new Wolf();
        }
    }
	
	// Hunter - Abstract class
	abstract class Hunter //Abstract product
    {
		abstract public function eatVictim($victim);
    }
	
	// Victim - Abstract class
	abstract class Victim //Abstract product
    {
        public $name;		
		
		public function __set($name, $value) {
			$this->$name = $value;
		}
		public function __get($name) {
			return $this->$name;
		}
    }
	
	// Concrete classes for Hunter and Victim
	class Lion extends Hunter 
    {
        public function eatVictim($victim)
        {
            
			echo "<br/>Lion eats " .$victim->name;
        }
    }
	
	class Wolf extends Hunter 
    {
        public function eatVictim($victim)
        {
            
			echo "<br/>Wolf eats " .$victim->name;
        }
    }
	
	class Deer extends Victim 
    {
		public $name = 'Deer';
	}
	
	class Rabbit extends Victim 
    {
		public $name = 'Rabbit';
	}
	
	// Animal World
	class AnimalWorld
    {
        public $victim;
        public $hunter;

        // Constructor
        public function __construct($factory)
        {
            // Here another factory is deciding who is Hunter and who is victim
            $this->hunter = $factory->createHunter();
            $this->victim = $factory->createVictim();
        }

        public function runFoodChain()
        {
            $this->hunter->eatVictim($this->victim);
        }
    }
	
	// Implementation
	
	// Create and run the African animal world
	echo "<br/>Animal World";
	echo "<br/>Food Chain - Africa";
	echo "<br/>----------------------------------------";

	$africa = new AfricaFactory();
	$world = new AnimalWorld($africa);
	$world->runFoodChain();

	echo "<br/><br/>";

	echo "<br/>Food Chain - America";
	echo "<br/>----------------------------------------";

	// Create and run the American animal world
	$america = new AmericaFactory();
	$world = new AnimalWorld($america);
	$world->runFoodChain();

}

?>