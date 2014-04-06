<?php include('includes/includefiles.php'); ?>

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}


$objShoppingCart = new ShoppingCart();

//var_dump($objShoppingCart->getShoppingCart());
if ($action == 'add2cart') {
    $schedule_id = $_GET['schedule_id'];
    $seat_id = $_GET['seat_id'];
    $seattype_id = $_GET['seattype_id'];
    $seat_type = $_GET['seat_type'];
    $price = $_GET['price'];

    if ($objShoppingCart->insert($schedule_id, $seat_id, $seattype_id, $seat_type, $price) == 1) {
        messageHelper::setMessage('Seat is successfully added to the booking.', MESSAGE_TYPE_SUCCESS);
    } else {
        messageHelper::setMessage('Error occured while adding seat to the booking.', MESSAGE_TYPE_ERROR);
    }
}

if ($action == 'clear') {
    $objShoppingCart->clear();
    messageHelper::setMessage('Booking is cleared.', MESSAGE_TYPE_INFO);
}

if ($action == 'remove') {
    $seat_id = $_GET['seat_id'];
    $objShoppingCart->remove($seat_id);
    messageHelper::setMessage('Seat is successfully removed from the booking.', MESSAGE_TYPE_INFO);
}
?>

<?php $pageTitle = "Booking (Summary)"; ?>

<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">   
</style>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="booking.php" class="btn btn-warning">Go to Booking Page</a>
        <a href="pre-checkout.php" class="btn btn-primary">Check Out</a>
        <a href="addSeat.php?action=clear" class="btn btn-danger">Clear</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">&nbsp;</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">        
    </div>
    <div class="panel-body">
        <table id="seat_table">
            <thead>
                <tr>
                    <th class="title-column">Seat ID</th>
                    <th class="title-column">Route</th>
                    <th class="artist-column">Departure Date Time</th>
                    <th class="price-column">Arrival Date Time</th>                   
                    <th class="title-column">Seat Type</th>
                    <th class="artist-column">No of Seat (To Book)</th>
                    <th class="price-column">Price</th>
                    <th class="download-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objShoppingCart->getShoppingCart() as $row) { ?>
                    <tr id="<?php echo $row['seat_id']; ?>">
                        <td class="title-column"><?php echo $row['seat_id']; ?></td>
                        <td class="title-column"><?php echo $row['route_title']; ?></td>
                        <td class="artist-column"><?php echo $row['departure_datetime']; ?></td>
                        <td class="price-column"><?php echo $row['arrival_datetime']; ?></td>                              
                        <td class="title-column"><?php echo $row['seat_type']; ?></td>
                        <td class="artist-column"><?php echo $row['no_of_seat_to_book']; ?></td>
                        <td class="price-column"><?php echo $row['price']; ?></td>                                
                        <td class="remove-column">
                            <a href="addSeat.php?seat_id=<?php echo $row['seat_id']; ?>&action=remove"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                <?php } ?>                            
            </tbody>
        </table>
        <br/>
        <p class="text-right"><b>Sub Total : </b><?php echo $objShoppingCart->getSubTotal(); ?></p>
    </div>
</div>                          

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#seat_table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bPaginate": false
        } );
    });
</script>

<?php include('includes/footer.php'); ?>
