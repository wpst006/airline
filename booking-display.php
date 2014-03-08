<?php include('includes/includefiles.php'); ?>
<?php $pageTitle = "Booking Display"; ?>
<?php include('includes/header.php'); ?>
<?php require_once ('includes/bookingHelper.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<style>
    .my-search-panel{

    }    

    .my-btn{
        width:150px;
    }    

    .form-inline .form-group{
        margin-bottom:10px;
    }

    .btn-row{
        clear: both;
        margin-top: 10px;
        width: 100%;
    }
</style>

<?php
$customer = null;
$fromDate = null;
$toDate = null;

if (isset($_POST['submitted'])) {

    if (isset($_POST['chkCustomerFilter'])) {
        if (isset($_POST['customer'])) {
            $customer = $_POST['customer'];
        }
    }

    if (isset($_POST['chkDateFilter'])) {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
    }

    $bookingData = bookingHelper::getBooking($fromDate, $toDate, $customer);
} else {
    $bookingData = bookingHelper::getBooking();
}
?>

<div class="panel panel-default my-search-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">
        <form class="form-inline" id="search" name="search" action="booking-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="" for="">From Date</label>
                <div class='input-group date' id='datetimepicker1'>                   
                    <input type='text' id="fromDate" name="fromDate" class="form-control" data-format="YYYY-MM-DD" value="<?php echo (isset($fromDate)) ? $fromDate : date('Y-m-d', time()); ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>                        
                </div>
            </div>
            <div class="form-group">
                <label class="" for="">To Date</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' id="toDate" name="toDate" class="form-control" data-format="YYYY-MM-DD" value="<?php echo (isset($toDate)) ? $toDate : date('Y-m-d', time()); ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#fromDate').datetimepicker({
                        pickTime: false
                    });
                    $('#toDate').datetimepicker({
                        pickTime: false
                    });
                });
            </script>
            <div class="form-group">
                <label class="" for="exampleInputEmail2">Customer :</label>
                <input type="text" id="customer" name="customer" class="form-control" value="<?php echo (isset($_POST['chkCustomerFilter']) && isset($_POST['customer'])) ? $_POST['customer'] : "" ?>" maxlength="30"/>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="chkDateFilter" name="chkDateFilter" <?php echo (isset($_POST['chkDateFilter'])) ? "checked" : "" ?>> Apply Date Filter
                </label>
                <label>
                    <input type="checkbox" id="chkCustomerFilter" name="chkCustomerFilter" <?php echo (isset($_POST['chkCustomerFilter'])) ? "checked" : "" ?>> Apply Customer Filter
                </label>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-primary my-btn">Search</button>        
                <?php
                $link = "print_bookingDisplay.php";

                if (isset($customer) || isset($fromDate) || isset($toDate)) {
                    $link.="?";
                }

                if (isset($customer)) {

                    $link.="customer=" . $customer;
                }

                if (isset($fromDate) && isset($toDate)) {
                    if ($link[strlen($link) - 1] != "?") {
                        $link.="&";
                    }
                    $link.="fromDate=" . $fromDate . "&toDate=" . $toDate;
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-info my-btn">Print</a>
            </div>

        </form>
        <br/>

        <table id="booking-table">
            <thead>
            <th>Booking ID</th>
            <th>Date</th>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Total</th>            
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($bookingData as $row) { ?>
                    <tr>                        
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['bookingdate']; ?></td>
                        <td><?php echo $row['customer_id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['total']; ?></td>                       
                        <td class="action-column"><a href="booking-detail-display.php?booking_id=<?php echo $row['booking_id']; ?>">Details</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#booking-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });                       
    });
</script>

<?php include('includes/footer.php'); ?>
