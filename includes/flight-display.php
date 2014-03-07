<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Flights</h3>
  </div>
  <div class="panel-body">
    <table id="flight-table">
            <thead>
            <th>Flight Name</th>
            <th></th>
            </thead>
            <tbody>
                <?php
                $routeData= flightHelper::selectAll();
                ?>
                <?php foreach ($routeData as $row) { ?>
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
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );
        
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