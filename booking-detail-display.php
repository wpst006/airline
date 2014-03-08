<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/bookingHelper.php'); ?>

<?php $pageTitle = "Booking Detail Display"; ?>

<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Booking Detail</h3>
    </div>
    <div class="panel-body">

        <form role="form" id="seat_setup" name="seat_setup" action="seat-setup.php" method="post" class="form-horizontal">

            <?php
            $booking_id = $_GET['booking_id'];
            $bookingData = bookingHelper::getBookingByBookingID($booking_id);
            $bookingDetailData = bookingHelper::getBookingDetailsByBookingID($booking_id);
            ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Booking ID</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['booking_id']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Booking Date</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['bookingdate']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Customer ID</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['customer_id']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">First Name</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['firstname']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Last Name</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['lastname']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Total</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $bookingData[0]['total']; ?></p>
                </div>
            </div>

        </form>

        <table id="seat-table">
            <thead>
            <th>Flight Info</th>
            <th>Seat</th>
            <th>No of tickets</th>
            <th>Price</th>
            </thead>
            <tbody>
                <?php foreach ($bookingDetailData as $row) { ?>
                    <tr>
                        <td>
                            <?php 
                            $cellText="<b>Route : </b>" . $row['route_title'] . "<br/>"; 
                            $cellText.="<b>Flight Name : </b>" . $row['flight_name'] . "<br/>"; 
                            $cellText.="<b>Departure Date Time : </b>" . $row['departure_datetime'] . "<br/>";
                            $cellText.="<b>Arrival Date Time : </b>" . $row['arrival_datetime'] . "<br/>";
                            $cellText.="<b>Departure Airport : </b>" . $row['departure_airport'] . "<br/>";
                            $cellText.="<b>Arrival Airport : </b>" . $row['arrival_airport'];
                            echo $cellText;
                            ?>
                        </td>
                        <td><?php echo $row['seat_title']; ?></td>
                        <td><?php echo $row['no_of_seats']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br/>
        <a href="print_bookingDetailDisplay.php?booking_id=<?php echo $_GET['booking_id']; ?>" class="btn btn-default btn-info my-btn pull-right btn-block">Print</a>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#seat-table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );

    });
</script>

<?php include('includes/footer.php'); ?>
