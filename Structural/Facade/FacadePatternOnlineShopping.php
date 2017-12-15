<?php

//Shopping cart Facade
class OnlineShoppingFacade
{
    public function PurchaseOnlineProducts($aPurchaseItems)
    {
        $oShoppingCart = new ShoppingCart();
        //Carry out automatic addTocart from the purchase list items for the Demo
        foreach ($aPurchaseItems as $aPurchaseItem)
        {
            $iProductId = $aPurchaseItem['iProductId'];
            $iItemQty = $aPurchaseItem['iItemQty'];
            $iPrice = $aPurchaseItem['iPrice'];
            $oShoppingCart->AddProductToShoppingCart($iProductId, $iPrice, $iItemQty);
        }
        //Complete your order
        $oOrder = new Order();
        $oOrder->PlaceOrder();

        /** Print Invoice */
        $oInvoiceManager = new InvoiceManager();
        $oInvoiceManager->PrintInvoice($oShoppingCart::$oShoppingCartItems);
    }
}

//Shoppingcart add to cart
class ShoppingCart
{
    public static $oShoppingCartItems = null;

    public function AddProductToShoppingCart($iProductId, $iRate, $iQty)
    {
                $oCart = new Cart();
                $oCart->iProductId = $iProductId;
                $oCart->iProductRate = $iRate;
                $oCart->iProductQty = $iQty;
                $oCart->iProductTotalAmount = $iQty * $iRate;

                static::$oShoppingCartItems[] = $oCart;
    }
}


//Cart class defines shopping cart properties
class Cart
{
    public $iProductId;
    public $iProductRate;
    public $iProductQty;
    public $iProductTotalAmount;
}


//get Order Details
class Order
{
    public function PlaceOrder()
    {
        echo "Your Cart<br/>---------<br/>";
        echo "Customer name<br/>";
    }
}

//Invoice printing manager
class InvoiceManager {
    public function PrintInvoice($oShoppingCart)
    {
        echo ("-------------------------------------------------------------------------------------------------------------<br/>");
        echo ("Invoice<br/>");
        echo ("-------------------------------------------------------------------------------------------------------------<br/>");
        $iCartTotal = 0;
        foreach ($oShoppingCart as  $ocart)
        {
            //print_r($ocart);
            echo ("ProductId: " . $ocart->iProductId . ", Product Rate:" . $ocart->iProductRate . ", Product Qty:" . $ocart->iProductQty . ", Product Amount:" . $ocart->iProductTotalAmount);
            echo "<br/>";
            $iCartTotal += $ocart->iProductTotalAmount;
        }
        echo ("-------------------------------------------------------------------------------------------------------------<br/>");
        echo ("Total Amount: " + $iCartTotal ."/-");
        echo ("<br/>-------------------------------------------------------------------------------------------------------------<br/>");

        }
}


// adding 2 items to purchase list
$aPurchaseItems = array(
                        array(
                            "iProductId" => 1,
                            "tItemName" => "Book1",
                            "iItemQty" => 2,
                            "iPrice" => 50
                        ),
                        array(
                            "iProductId" => 2,
                            "tItemName" => "Calculator1",
                            "iItemQty" => 1,
                            "iPrice" => 100
                        )
                    );

//Call facade to initiate cart
$oOnlineShoppingFacade = new OnlineShoppingFacade();
$oOnlineShoppingFacade->PurchaseOnlineProducts($aPurchaseItems);

?>
