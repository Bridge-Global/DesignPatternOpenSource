<?php

// The 'Subject' abstract class
abstract class Stock
{
    public $symbol;
    public $price;
    public $investors = array();

    public function __set($name, $value)
    {
        $this->price = $value;
        $this->Notify();
    }

// Constructor
    public function __construct($symbol, $price)
    {
        $this->symbol = $symbol;
        $this->price = $price;
    }

    public function Attach(IInvestor $investor)
    {
        $this->investors[] = $investor;
    }

    public function Detach(IInvestor $investor)
    {
        foreach ($this->investors as $key => $value) {
            if ($value == $investor) {
                unset($this->investors[$key]);
            }
        }
    }

    public function Notify()
    {
        foreach ($this->investors as $investor) {
            $investor->Update($this);
        }
        echo "</br>";
    }

}

// The 'ConcreteSubject' class
class IBM extends Stock
{
    // Constructor
    public function __construct($symbol, $price)
    {
        $this->symbol = $symbol;
        $this->price = $price;
    }
}

// The 'Observer' interface
interface IInvestor
{
    public function Update($stock);
}

// The 'ConcreteObserver' class
class Investor implements IInvestor
{
    private $name;
    private $stock;

    // Constructor
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function Update($stock)
    {
        echo "Notified " . $this->name . " of " . $stock->symbol . "'s change to " . (float)$stock->price . "</br>";
    }
}

// Create IBM stock and attach investors
$ibm = new IBM("IBM", 120.00);
$ibm->Attach(new Investor("Sorros"));
$ibm->Attach(new Investor("Berkshire"));

// Fluctuating prices will notify investors
$ibm->Price = 120;
$ibm->Price = 121;
$ibm->Price = 122;
$ibm->Price = 123;
?>