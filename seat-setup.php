<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/scheduleHelper.php'); ?>

<?php $pageTitle="Seat Setup"; ?>

<?php include('includes/header.php'); ?>

<?php
if (isset($_POST['submitted'])) {
//*********************************************************************
    //Filling Data
    $seat_id = autoID::getAutoID('seats', 'seat_id', 'SET', 6);
    $schedule_id = $_POST['schedule_id'];
    $seattype_id = $_POST['seattype_id'];
    $no_of_seat = $_POST['no_of_seat'];
    $price = $_POST['price'];
    //*********************************************************************
    $seatExists = checkSeatExists($schedule_id, $seattype_id);

    if ($seatExists == true) {
        updateSeats($schedule_id, $seattype_id, $no_of_seat, $price);
    } else {
        saveSeats($seat_id, $schedule_id, $seattype_id, $no_of_seat, $price);
    }
    //*********************************************************************
    messageHelper::setMessage("You have successfully save the Seat Type.", MESSAGE_TYPE_SUCCESS);
    header("Location:seat-setup.php?schedule_id=" . $schedule_id);
    exit();
} else {
    $schedule_id = $_GET['schedule_id'];
}

function checkSeatExists($schedule_id, $seattype_id) {
    $sql = "SELECT * FROM seats " .
            "WHERE schedule_id='" . $schedule_id . "' " .
            "AND seattype_id='" . $seattype_id . "' " .
            "ORDER BY seat_id";
    $result = mysql_query($sql) or die(mysql_error());

    $noOfRows = mysql_num_rows($result);

    if ($noOfRows == 0) {
        return false;
    } else {
        return true;
    }
}

function updateSeats($schedule_id, $seattype_id, $no_of_seat, $price) {
    //"seats" Table Update
    $seatUpdate_sql = "UPDATE " .
            "seats " .
            "SET no_of_seat=" . $no_of_seat . ", " .
            "price=" . $price . " " .
            "WHERE schedule_id='" . $schedule_id . "' " .
            "AND seattype_id='" . $seattype_id . "'";

    mysql_query($seatUpdate_sql) or die(mysql_error());
}

function saveSeats($seat_id, $schedule_id, $seattype_id, $no_of_seat, $price) {
    //"seats" Table Insert
    $seatInsert_sql = "INSERT INTO " .
            "seats(seat_id,schedule_id,seattype_id,no_of_seat,price) " .
            "VALUES('$seat_id','$schedule_id','$seattype_id',$no_of_seat,$price)";

    mysql_query($seatInsert_sql) or die(mysql_error());
}
?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <form role="form" id="seat_setup" name="seat_setup" action="seat-setup.php" method="post" class="form-horizontal">

            <input type="hidden" id="schedule_id" name="schedule_id" value="<?php echo $schedule_id; ?>" />

            <?php
            $scheduleData=  scheduleHelper::getScheduleByScheduleID($schedule_id);
            ?>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Route</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $scheduleData[0]['route_title']; ?></p>                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Flight</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $scheduleData[0]['flight_name']; ?></p>                    
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-3 control-label">Seat Type :</div>
                <div class="col-sm-9">
                    <?php
                    $sql = "SELECT seattype_id,title FROM seat_types " .
                            "ORDER BY title";
                    $result = mysql_query($sql) or die(mysql_error());
                    ?>
                    <select id="seattype_id" name="seattype_id" class="chosen-select">
                        <?php while ($row = mysql_fetch_array($result)) { ?>
                            <option value="<?php echo $row['seattype_id']; ?>"><?php echo $row['title']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>          

            <div class="form-group">
                <div class="col-sm-3 control-label">No of seats (Available) :</div>
                <div class="col-sm-9">
                    <input type="text" id="no_of_seat" name="no_of_seat" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Price :</div>
                <div class="col-sm-9">
                    <input type="text" id="price" name="price" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>                        
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Seats</h3>
  </div>
  <div class="panel-body">
    <table id="seat-table">
            <thead>
            <th>Seat Type</th>
            <th>No of Seat</th>
            <th>Price</th>
            </thead>
            <tbody>
                <?php
                $scheduleData=  scheduleHelper::getSeatsInScheduleByScheduleID($schedule_id);
                ?>
                <?php foreach ($scheduleData as $row) { ?>
                    <tr>
                        <td><?php echo $row['seattype_title']; ?></td>
                        <td><?php echo $row['no_of_seat']; ?></td>
                        <td class="price-column"><?php echo $row['price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "100%"}); 
        
        $("#seat_setup").validate({
            rules: {
                no_of_seat: 
                    {
                    required: true,
                    number: true,
                    min: 1
                }, 
                price: 
                    {
                    required: true,
                    number: true,
                    min: 1.0
                },   
            },
            //set messages to appear inline
            messages: 
                {
                no_of_seat: 
                    {
                    required: "Please Enter Number of Seats (Available).",
                    number: "Please enter valid number for Number of Seats (Available).",
                },   
                price: 
                    {
                    required: "Please Enter Price.",
                    number: "Please enter valid number for Price.",
                }, 
            }
        });
    });
</script>

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
        
        $('#seattype_id').change(function(){
            retrieveSeatInfo();
        });
        
        retrieveSeatInfo();
    });
    
    function retrieveSeatInfo(){
        var schedule_id=$('#schedule_id').val();
        var seattype_id=$('#seattype_id').val();
        
        $.ajax({
            url: "ajax_getseat.php?schedule_id=" + schedule_id + "&seattype_id=" + seattype_id,
            type: "POST",
            dataType: "json",
            //data: $('#passcode_form').serialize(),
            cache:false,
            success: function(result){ 
                if (result.success==true){
                    $('#no_of_seat').val(result.data.no_of_seat);
                    $('#price').val(result.data.price);
                }else{
                    $('#no_of_seat').val('');
                    $('#price').val('');
                }            
            },
            error: function(error){
                console.log("ERROR","Error occured while sending request.","warning",0);    
                //console.log(error);
            }
        });
    }
</script>

<?php include('includes/footer.php'); ?>
