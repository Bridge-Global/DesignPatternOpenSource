<?php
/**
*	Proxy (Structural Design Pattern)
*	Code to describe how the proxy design pattern works.
*  
*/
// Create an interface to hold certain methods
interface IGetATMData {    
	public function GetATMCash();
	public function GetATMStatus();
}

// ATMServer class has it's own methods
class ATMServer implements IGetATMData {
    
	private $atmCash = 100;
	private $atmStatus = 1;
	
	public function GetATMCash() {
		return $this->atmCash;
	}

	public function GetATMStatus() {
		return $this->atmStatus;
	}

	public function SetATMCash($value) {
		$this->atmCash = $value;
	}

	public function SetATMStatus($status) {
		$this->atmStatus = $status;
	}
}
 
// Class for Remote Proxy
class ATMProxyRemote implements IGetATMData {
	public function GetATMCash() {
		$ATMServer = new ATMServer();
		return $ATMServer->GetATMCash();
	}

	public function GetATMStatus() {
		$ATMServer = new ATMServer();
		return $ATMServer->GetATMStatus();
	}
} 

// Class for Protection Proxy
class ATMProxyProtection implements IGetATMData {
	public function GetATMCash() {	
		if (date("D") == "Mon") {		
			$ATMServer = new ATMServer();
			return $ATMServer->GetATMCash();
		} else {
			echo "<br>You can access ATM Cash service only on Monday.";
		}
	}

	public function GetATMStatus() {	
		if (date("D") == "Sat") {
			$ATMServer = new ATMServer();
			return $ATMServer->GetATMStatus();
		} else {
			echo "<br>You can access ATM Status service only on Saturday.";
		}
	}
}

// Class for Virtual Proxy
class ATMProxyVirtual implements IGetATMData {
	private $cachedATMCash = 5000; // in reality this will be taken from caching service
	private $cachedATMStatus = 2; // in reality this will be taken from caching service
	
	public function GetATMCash() {
		return $this->cachedATMCash;
	}

	public function GetATMStatus() {
		return $this->cachedATMStatus;
	}
}

// The Proxy design pattern limits access to just the methods you want made accessible in another class.
echo "1) Remote Proxy Example - Not exposing all the data/methods of the real object ";
echo "<br>------------------------";
$atmProxyData1 = new ATMProxyRemote(); // since we are using proxy class, we can only get the atm data. Its looks like actual object

echo "<br>ATM Cash: " . $atmProxyData1->GetATMCash();
echo "<br>ATM Status: " . $atmProxyData1->GetATMStatus();

echo "<br><br>2) Protection Proxy Example - control the client call by applying rules inside the proxy class";
echo "<br>------------------------";
$atmProxyData2 = new ATMProxyProtection();

echo "<br>ATM Cash: " . $atmProxyData2->GetATMCash();
echo "<br>ATM Status: " . $atmProxyData2->GetATMStatus();

echo "<br><br>3) Virtual Proxy Example - Not uses the real subject(object) because it will be costly";
echo "<br>------------------------";

$atmProxyData3 = new ATMProxyVirtual();
echo "<br>ATM Cash: " . $atmProxyData3->GetATMCash();
echo "<br>ATM Status: " . $atmProxyData3->GetATMStatus();


?>
