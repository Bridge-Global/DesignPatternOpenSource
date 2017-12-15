<?php
/**
*	Singleton (Creational Design Pattern)
*	Code to describe how the Singleton design pattern works.
*  
*/

// Create the interface ILoggerInterface
interface ILoggerInterface {
	public function LogEntry($logData);
}
// Create class Logger which implements the ILoggerInterface
class Logger implements ILoggerInterface {	
	private static $mLogger;

	// the constructor. usually public, this time it is private to ensure 
	// no one except this class can use it.
	private function __construct() {}

	// the public Instance property everyone uses to access the Logger
	public static function getLoggerInstance() {
		
		// If this is the first time we're referring to the
		// singleton object, the private variable will be null.		
		if (!self::$mLogger) {
			self::$mLogger = new self();
		}				
		return self::$mLogger;		
	}

	public function LogEntry($logData) {		
		echo $logData;		
	}

	private function __clone() {
        // Disable cloning
    }
}

// Singleton design pattern creates only one (singleton) object of a particular class ever.

$log1 = Logger::getLoggerInstance();
$log2 = Logger::getLoggerInstance();
$log1->LogEntry('Logging the first object'); //singleton instance
echo "<br>";
$log2->LogEntry('Logging the second object'); //singleton instance
var_dump($log1 === $log2); // Return true
            

?>
