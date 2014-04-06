<?php
class seatHelper{
    public static function getAvailableNoOfSeatsBySeatID($seat_id) {
        $available_seats = 0;

        $sql = "SELECT no_of_seat-booked_seat As available_seats " .
                "FROM seats " .
                "WHERE seat_id='" . $seat_id . "' " .
                "ORDER BY seat_id";
        $result = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
            $available_seats=$row['available_seats'];
        }
        
        return $available_seats;
    }
    
    public static function isSeatOKtoBook($seat_id,$no_of_seat_to_book){
        $available_seats=  seatHelper::getAvailableNoOfSeatsBySeatID($seat_id);
        
        if ($no_of_seat_to_book>$available_seats){
            return false;
        }else{
            return true;
        }
    }
    
    public static function updateBookedSeat($seat_id,$no_of_seat_to_book) {
        $sql = "UPDATE seats " .
                "SET booked_seat=booked_seat+" . (int)$no_of_seat_to_book . " " .
                "WHERE seat_id='" . $seat_id . "' ";
        
        mysql_query($sql) or die(mysql_error());

        return true;
    }
}
?>
