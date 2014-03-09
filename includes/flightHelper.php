<?php
class flightHelper {

    public static function getFlightNameByFligthID($flight_id) {
        $name = null;

        $sql = "SELECT name " .
                "FROM flights " .
                "WHERE flight_id='" . $flight_id . "' " .
                "ORDER BY name";
        $result = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
            $name=$row['name'];
        }
        
        return $name;
    }
    
    public static function getFlightByFligthID($flight_id) {       

        $sql = "SELECT * " .
                "FROM flights " .
                "WHERE flight_id='" . $flight_id . "' " .
                "ORDER BY name";
        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[]=array(
                'name'=>$row['name'],
                'remark'=>$row['remark']
            );
        }
        
        return $output;
    }

    public static function selectAll() {

        $sql = "SELECT * " .
                "FROM flights " .
                "ORDER BY name";
        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[]=array(
                'flight_id'=>$row['flight_id'],
                'name'=>$row['name'],
                'remark'=>$row['remark']
            );
        }
        
        return $output;
    }
    
    

}
?>