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

}
?>