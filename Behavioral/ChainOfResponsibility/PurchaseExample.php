<?php

/* Example for Chain Of Responsibility */

// Handler Abstract
abstract class Approver
{
    protected $successor;

    public function setSuccessor($successor)
    {
        $this->successor = $successor;
    }

    abstract public function processRequest($purchase);
}

// Concrete handlers
class Director extends Approver
{
    public function processRequest($purchase)
    {
        if ($purchase->amount < 10000.0)
        {
            
            echo "<br/> Director approved request #". $purchase->number ." of amounr " . $purchase->amount;
        }
        else if ($this->successor != null)
        {
            $this->successor->ProcessRequest($purchase);
        }
    }
}

class President extends Approver
{
    public function processRequest($purchase)
    {
        if ($purchase->amount < 100000.0)
        {            

            echo "<br/> President approved request # ".$purchase->number." of amount ". $purchase->amount." Purchase amount between 25000 and 100000";
        }
        else
        {
            echo "<br/> President not approved request # ".$purchase->number." of amount ". $purchase->amount." Requires an executive meeting! - Reason for not approval Amount > 100000";
        }
    }
}

class VicePresident extends Approver
{
    public function processRequest($purchase)
    {
        if ($purchase->amount < 25000.0)
        {            
            
            echo "<br/> President approved request # ".$purchase->number." of amount ". $purchase->amount." Purchase Amount between 10000 and 25000";

        }
        else if ($this->successor != null)
        {
            $this->successor->processRequest($purchase);
        }
    }
}

// Purchase class
class Purchase
{
    public $number;
    public $amount;
    public $purpose;

    // Constructor
    public function __construct($number, $amount, $purpose)
    {
        $this->number = $number;
        $this->amount = $amount;
        $this->purpose = $purpose;
    }


    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

// Implementation
$director = new Director();
$vicePresident = new VicePresident();
$president = new President();

$director->setSuccessor($vicePresident);
$vicePresident->setSuccessor($president);

// Generate and process purchase requests
$p = new Purchase(2034, 350.00, "Office Chair");
$director->processRequest($p);

$p = new Purchase(2036, 21000, "Purchase Printer");
$director->processRequest($p);
$p = new Purchase(2035, 32590.10, "Purchase Server");
$director->processRequest($p);

$p = new Purchase(2037, 122100.00, "Purchase new office space");
$director->processRequest($p);

?>

