<?php
/**
 * Created by PhpStorm.
 * User: TechWhizz
 * Calculate the the price for a movie ticket based  on day of the week
 */

//Context
class MovieStrategyContext {
    private $oStrategy = NULL;
    private $iActualTicketRate = 250;
    private static $tStrategyContext;

    public function __construct($tStrategyContext) {
        static::$tStrategyContext = $tStrategyContext;
        switch ($tStrategyContext)
        {
            case "sunday":
                $this->oStrategy = new NoDiscountStrategy();
                break;
            case "monday":
                $this->oStrategy = new WeekdayDiscountStrategy();
                break;
            case "tuesday":
                $this->oStrategy = new WeekdayDiscountStrategy();
                break;
            case "wednesday":
                $this->oStrategy = new WeekdayDiscountStrategy();
                break;
            case "thursday":
                $this->oStrategy = new WeekdayDiscountStrategy();
                break;
            case "friday":
                $this->oStrategy = new WeekdayDiscountStrategy();
                break;
            case "saturday":
                $this->oStrategy = new WeekendDiscountStrategy();
                break;
            default:
                echo ("Invalid Day");
                break;
        }
    }
    public function GetStrategyDiscount() {
        $iDiscount = $this->oStrategy->GetDiscountedBill($this->iActualTicketRate);
        echo "Your movie ticket price on ". static::$tStrategyContext . " is : " . $iDiscount . "/-<br/>";

    }
}

//Interface
interface iMovieDiscountStrategyInterface {
    public function GetDiscountedBill($iBillAmount);
}

//StrategyContext1 : Weekday Discount
class WeekdayDiscountStrategy implements iMovieDiscountStrategyInterface
{
        public function GetDiscountedBill($iBillAmount)
        {
            return $iBillAmount - ($iBillAmount * 4 / 100);
        }
}

//StrategyContext2 : Weekend Discount
class WeekendDiscountStrategy implements iMovieDiscountStrategyInterface
{
    public function GetDiscountedBill($iBillAmount)
    {
        return $iBillAmount - ($iBillAmount * 2 / 100);
    }
}

//StrategyContext3 : No Discount
class NoDiscountStrategy implements iMovieDiscountStrategyInterface
{
        public function GetDiscountedBill($iBillAmount)
        {
            return $iBillAmount; // No Discount
        }
}

/* Calculate movie price on Sunday */
$oDiscountContext = new MovieStrategyContext('sunday');
$oDiscountContext->GetStrategyDiscount();

/* Calculate movie price on monday */
$oDiscountContext = new MovieStrategyContext('monday');
$oDiscountContext->GetStrategyDiscount();

/* Calculate movie price on saturday */
$oDiscountContext = new MovieStrategyContext('saturday');
$oDiscountContext->GetStrategyDiscount();



