<?php
/*
* Example for Abstract Factory design pattern
*/
// Abstract Products
abstract class Car {	
	abstract public function getInfo();
}

abstract class Bus {
	abstract public function getInfo();
}

// Concrete Products
class VolvoCar extends Car {
	public function getInfo() {
		echo "<br/>This is a volvo car";
	}
}

class MercedezCar extends Car {
	public function getInfo() {
		echo "<br/>This is a mercedez car";
	}
}

class VolvoBus extends Bus {
	public function getInfo() {
		echo "<br/>This is a volvo bus";
	}
}

class MercedezBus extends Bus {
	public function getInfo() {
		echo "<br/>This is a mercedez bus";
	}
}

// Abstract Factory

abstract class AutomobileFactory {
	abstract protected function makeCar();
	abstract protected function makeBus();
	
}

// Concrete factories which creates objects of concrete products
class VolvoFactory extends AutomobileFactory {
	function makeCar() {
		echo "<br/><br/> Making a Volvo car";
		return new VolvoCar();
	}
	
	function makeBus() {
		echo "<br/><br/> Making a Volvo bus";
		return new VolvoBus();
	}
}

class MercedezFactory extends AutomobileFactory {
	function makeCar() {
		echo "<br/><br/> Making a Mercedez car";
		return new MercedezCar();
	}
	
	function makeBus() {
		echo "<br/><br/> Making a Mercedez bus";
		return new MercedezBus();
	}
}

// Usage

$volvoFactory = new VolvoFactory();
$volvoCar = $volvoFactory->makeCar();
$volvoBus = $volvoFactory->makeBus();

echo $volvoCar->getInfo();
echo $volvoBus->getInfo();

$mercedezFactory = new MercedezFactory();
$mercedezCar = $mercedezFactory->makeCar();
$mercedezBus = $mercedezFactory->makeBus();

echo $mercedezCar->getInfo();
echo $mercedezBus->getInfo();

?>



