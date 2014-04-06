<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/seatHelper.php'); ?>

<?php
$objShoppingCart = new ShoppingCart();
$shoppingCartData = $objShoppingCart->getShoppingCart();

$error = false;

if (count($shoppingCartData) == 0) {
    $error = true;
    $message = 'There is no item in shopping cart. Please Try again.';
    messageHelper::setMessage($message, MESSAGE_TYPE_ERROR);
} else {
    //Checking available Seats
    foreach ($shoppingCartData as $index => $shoppingCartItem) {
        $seat_id = $shoppingCartItem['seat_id'];
        $no_of_seat_to_book = $shoppingCartItem['no_of_seat_to_book'];

        if (seatHelper::isSeatOKtoBook($seat_id, $no_of_seat_to_book) == false) {
            $error = true;
            $message = "Not enough seat for seat id : " . $seat_id;
            messageHelper::setMessage($message, MESSAGE_TYPE_ERROR);
            break;
        }
    }
}
?>
<?php include('includes/header.php'); ?>
<br/>
<?php if ($error == true) { ?>
    <a href="addSeat.php" class="btn btn-default btn-primary btn-block">
        Return to Shopping Cart Page
    </a> 
<?php } else { ?>
    <a href="checkout.php" class="btn btn-default btn-primary btn-block">
        Proceed to Check Out
    </a> 
<?php } ?>

<?php include('includes/footer.php'); ?>
