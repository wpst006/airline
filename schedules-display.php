<?php include('includes/includefiles.php'); ?>
<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    
<div class="row">
    <div class="col-md-12">
        <table id="schedule-table">
            <thead>
            <th>Schedule ID</th>
            <th>Flight ID</th>
            <th>Route ID</th>
            <th>Departure Date Time</th>
            <th>Arrival Date Time</th>
            <th>Departure Airport</th>
            <th>Arrival Airport</th>
            <th></th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT schedules.* " .
                        "FROM schedules " .
                        "ORDER BY schedule_id";
                //print_r($sql);exit();
                $result = mysql_query($sql) or die(mysql_error());
                ?>
                <?php while ($row = mysql_fetch_array($result)) { ?>
                    <tr>                        
                        <td><?php echo $row['schedule_id']; ?></td>
                        <td><?php echo $row['flight_id']; ?></td>
                        <td><?php echo $row['route_id']; ?></td>
                        <td><?php echo $row['departure_datetime']; ?></td>
                        <td><?php echo $row['arrival_datetime']; ?></td>
                        <td><?php echo $row['departure_airport']; ?></td>
                        <td><?php echo $row['arrival_airport']; ?></td>
                        <td><a href="seat-setup.php?schedule_id=<?php echo $row['schedule_id']; ?>">Add Seats</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#schedule-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
        });                       
    });
</script>

<?php include('includes/footer.php'); ?>
