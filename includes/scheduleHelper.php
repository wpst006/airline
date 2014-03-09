<?php
class scheduleHelper{
    public static function getSeatsInScheduleByScheduleID($schdule_id){
        $sql = "SELECT seats.*,seat_types.title AS 'seattype_title' FROM seats " .
                        "INNER JOIN seat_types " .
                        "ON seats.seattype_id=seat_types.seattype_id " .
                        "WHERE schedule_id='" . $schdule_id . "' " .
                        "ORDER BY seat_id";
                //print_r($sql);exit();
        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'seat_id'=>$row['seat_id'],
                'seattype_id'=>$row['seattype_id'],
                'schedule_id'=>$row['schedule_id'],
                'seattype_title'=>$row['seattype_title'],
                'no_of_seat'=>$row['no_of_seat'],
                'price'=>$row['price'],                
            );
        }
        
        return $output;
    }
    
    public static function getScheduleByScheduleID($schdule_id){
        $sql = "SELECT schedules.*,flights.*,routes.* " .
                "FROM schedules " .
                        "INNER JOIN flights " .
                        "ON schedules.flight_id=flights.flight_id " .
                        "INNER JOIN routes " .
                        "ON schedules.route_id=routes.route_id " .
                        "WHERE schedules.schedule_id='" . $schdule_id . "' " .
                        "AND schedules.active=1 " .
                        "ORDER BY schedule_id";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'schedule_id'=>$row['schedule_id'],
                'flight_id'=>$row['flight_id'],
                'flight_name'=>$row['name'],
                'route_id'=>$row['route_id'],
                'route_title'=>$row['title'],
                'departure_datetime'=>$row['departure_datetime'],
                'arrival_datetime'=>$row['arrival_datetime'],
                'departure_airport'=>$row['departure_airport'],
                'arrival_airport'=>$row['arrival_airport'],                  
                'active'=>$row['active'],
                'remark'=>$row['remark'],
                'hour'=>$row['hour'],                
                'min'=>$row['min'],                
            );
        }
        
        return $output;
    }
    
    public static function getSchedulesByRouteIDAndFlightID($route_id,$flight_id){
        $sql = "SELECT schedules.*,flights.*,routes.* " .
                "FROM schedules " .
                        "INNER JOIN flights " .
                        "ON schedules.flight_id=flights.flight_id " .
                        "INNER JOIN routes " .
                        "ON schedules.route_id=routes.route_id " .
                        "WHERE schedules.route_id='" . $route_id . "' " .
                        "AND schedules.flight_id='" . $flight_id . "' " .
                        "AND schedules.active=1 " .
                        "ORDER BY schedule_id";

        $result = mysql_query($sql) or die(mysql_error());
        
        $output=array(); 
        
        if (mysql_num_rows($result)==0){
            return $output;
        }
                                        
        while ($row = mysql_fetch_array($result)){
            $output[]=array(
                'schedule_id'=>$row['schedule_id'],
                'flight_id'=>$row['flight_id'],
                'flight_name'=>$row['name'],
                'route_id'=>$row['route_id'],
                'route_title'=>$row['title'],
                'departure_datetime'=>$row['departure_datetime'],
                'arrival_datetime'=>$row['arrival_datetime'],
                'departure_airport'=>$row['departure_airport'],
                'arrival_airport'=>$row['arrival_airport'],                  
                'active'=>$row['active'],
                'remark'=>$row['remark'],
                'hour'=>$row['hour'],                
                'min'=>$row['min'],                
            );
        }
        
        return $output;
    }
}

