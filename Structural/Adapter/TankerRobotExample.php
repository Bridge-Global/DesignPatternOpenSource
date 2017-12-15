<?php
/*
* Example for Adapter pattern
*/
interface iEnemyAttacker {
	public function fireWeapon();
    public function driveForward();
    public function assignDriver($driver);
}

class EnemyTank implements iEnemyAttacker
{
	public function fireWeapon()
	{
		echo "<br/>Enemy tank fired shots";
	}

	public function driveForward()
	{
		echo "<br/>Enemy Tank is moving forward";
	}

	public function assignDriver($driver)
	{
		echo "<br/>Driver $driver is driving the enemy tank ";
	}
}

// Adaptee Class

class EnemyRobot {
	public function smashWithHands()
	{
		echo "<br/>Enemy robot is causing damage with its hands";
	}

	public function walkForward()
	{
		echo "<br/>Enemy robot walks forward";
	}

	public function reactToHuman($driver)
	{
		echo "<br/>Enemy robot tramps on $driver";
	}
}

// Adapter class
class EnemyRobotAttacker implements iEnemyAttacker {
	
	private $oRobot;
	
	public function __construct($robot) {
		$this->oRobot = $robot;
	}
	
	public function fireWeapon()
	{
		$this->oRobot->smashWithHands();
	}

	public function driveForward()
	{
		$this->oRobot->walkForward();
	}

	public function assignDriver($driver)
	{
		$this->oRobot->reactToHuman($driver);
	}
}


echo "<br/>Tank<br/>...........<br/>";
$tank = new EnemyTank();
$tank->fireWeapon();
$tank->driveForward();
$tank->assignDriver("Fred");

/*echo "<br/><br/>Robot <br/>";
$robot = new EnemyRobot();
$robot->smashWithHands();
$robot->walkForward();
$robot->reactToHuman("Fred");*/

//Adapter

echo "<br/><br/> Robot Adapter <br/>................. <br/>";
$robot = new EnemyRobot();
$enemyRobot = new EnemyRobotAttacker($robot);
echo "fireWeapon: ";
$enemyRobot->fireWeapon();
echo "<br/><br/>driveForward: ";
$enemyRobot->driveForward();
echo "<br/><br/>assignDriver: ";
$enemyRobot->assignDriver("Fred");




?>
