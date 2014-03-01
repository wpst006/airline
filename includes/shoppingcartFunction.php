<?php require_once ('includes/scheduleHelper.php'); ?>
<?php

class ShoppingCart {

    //Constructor
    public function _construct() {
        if (!isset($_SESSION['shoppingcart'])) {
            //Creating Session "Array"
            $_SESSION['shoppingcart'] = array();
        }
    }

    function getShoppingCart(){
        return $_SESSION['shoppingcart'];
    }
    
    /**
     * 
     * return values
     * 0 - Error
     * 1 - Success
     * 2 - Duplicated
     */
    function insert($schedule_id,$seat_id,$seattype_id,$seat_type,$price) {
        
        $scheduleData=  scheduleHelper::getScheduleByScheduleID($schedule_id);
        
        //var_dump($scheduleData);
        //Function Call to check
        //If the "Item" already existed in "Session"
        $index = $this->indexOf($seat_id);

        //index=1 means "Item" is not existed in "Session"
        if ($index == -1) {            
            $_SESSION['shoppingcart'][]=array('schedule_id'=>$schedule_id,
                                        'route_title'=>$scheduleData[0]['route_title'],
                                        'departure_datetime'=>$scheduleData[0]['departure_datetime'],
                                        'arrival_datetime'=>$scheduleData[0]['arrival_datetime'],
                                        'departure_airport'=>$scheduleData[0]['departure_airport'],
                                        'arrival_airport'=>$scheduleData[0]['arrival_airport'],
                                        'seat_id'=>$seat_id,
                                        'seattype_id'=>$seattype_id,
                                        'seat_type'=>$seat_type,
                                        'no_of_seat_to_book'=>1,
                                        'price'=>$price); 

            return 1;
        } else {
            $existingQty=$_SESSION['shoppingcart'][$index]['no_of_seat_to_book'];
            $existingQty++;
            $_SESSION['shoppingcart'][$index]['no_of_seat_to_book']=$existingQty;
            return 1;
        }
        
        return 0;
    }

    function remove($itemID) {
        $index = $this->indexOf($itemID);

        if ($index > -1) {
            unset($_SESSION['shoppingcart'][$index]);
        }        
    }

    function clear() {
        $_SESSION['shoppingcart'] = array();
    }

    //function to find the index of an item in the shopping cart
    //if "Item" is found, return "Item" Index in the shopping cart
    //if "Item" is not found, return "-1"
    function indexOf($seat_id) {
        //var_dump($_SESSION['shoppingcart']);exit();
        if (!isset($_SESSION['shoppingcart']))
            return -1;

        $size = count($_SESSION['shoppingcart']);

        if ($size == 0)
            return -1;

        foreach ($_SESSION['shoppingcart'] as $key=>$value){
            if ($seat_id==$value['seat_id']){
                return $key;
            }
        }

        return -1;
    }
    
    function getSubTotal(){
        if (!isset($_SESSION['shoppingcart']))
            return 0.00;

        $size = count($_SESSION['shoppingcart']);

        if ($size == 0)
            return 0.00;

        $subTotal=0.00;
        
        foreach ($_SESSION['shoppingcart'] as $key=>$value){
            $subTotal+=(float)$value['price'];
        }

        return number_format((float)$subTotal, 2, '.', '');
    }

}

?>