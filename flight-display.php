<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/flightHelper.php'); ?>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM flights WHERE flight_id='" . $_GET['flight_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted a flight.", MESSAGE_TYPE_SUCCESS);
        header("Location:flight-display.php");
        exit();
    }
}

if (isset($_POST['submitted'])) {

    if (isset($_POST['searchKey'])) {
        $searchKey = $_POST['searchKey'];
    }

    $flightData = flightHelper::searchFlight($searchKey);
} else {
    $flightData = flightHelper::selectAll();
}
?>
<?php $pageTitle = "Flight Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="flight-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Flight :</label>
                <input type="text" id="searchKey" name="searchKey" class="form-control" value="<?php echo isset($_POST['searchKey']) ? $_POST['searchKey'] : "" ?>" maxlength="30" placeholder="Search"/>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-success my-btn">Search</button>
                <?php
                $link = "print_flight.php";

                if (isset($_POST['searchKey'])) {
                    $link.="?searchKey=" . $_POST['searchKey'];
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-success my-btn">Print</a>
            </div>

        </form>
        <br/>

        <table id="flight-table">
            <thead>
            <th>Flight Name</th>
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($flightData as $row) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>                        
                        <td class="action-column">
                            <a href="flights.php?flight_id=<?php echo $row['flight_id'];?>">Edit</a>
                            <a href="flights.php?flight_id=<?php echo $row['flight_id'];?>&action=delete" class="delete-link">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#flight-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });

        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the flight?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>