<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class customerHelper{
    public static function selectAll() {
        $sql = "SELECT * " .
                "FROM customers " .
                "ORDER BY customer_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'customer_id' => $row['customer_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'gender' => $row['gender'],
                'DOB' => $row['DOB'],
                'nrc_no' => $row['nrc_no'],
                'phone_no' => $row['phone_no'],
                'street' => $row['street'],
                'city' => $row['city'],
                'country' => $row['country'],
                'post_code' => $row['post_code'],
            );
        }

        return $output;
    }

    public static function searchCustomer($searchKey) {
        $sql = "SELECT * " .
                "FROM customers " .
                "WHERE customer_id LIKE '%" . $searchKey . "%' " .
                "OR firstname LIKE '%" . $searchKey . "%' " .
                "OR lastname LIKE '%" . $searchKey . "%' " .
                "ORDER BY customers.customer_id";

        $result = mysql_query($sql) or die(mysql_error());

        $output=array();
        
        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'customer_id' => $row['customer_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'gender' => $row['gender'],
                'DOB' => $row['DOB'],
                'nrc_no' => $row['nrc_no'],
                'phone_no' => $row['phone_no'],
                'street' => $row['street'],
                'city' => $row['city'],
                'country' => $row['country'],
                'post_code' => $row['post_code'],
            );
        }

        return $output;
    }
}
?>
