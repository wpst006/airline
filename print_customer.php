<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/customerHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header

        $this->Cell(30, 7, 'Customer ID', 1);
        $this->Cell(30, 7, 'Name', 1);
        $this->Cell(20, 7, 'Gender', 1);
        $this->Cell(25, 7, 'DOB', 1);
        $this->Cell(20, 7, 'NRC No', 1);
        $this->Cell(100, 7, 'Contact Info', 1);

        $this->Ln();
        // Data
        foreach ($data as $row) {

            $this->SetFont('Times', '', 12);
            $this->Cell(30,35, $row['customer_id'], 1);
            $this->Cell(30,35, $row['name'], 1);
            $this->Cell(20, 35, $row['gender'], 1);
            $this->Cell(25, 35, $row['DOB'], 1);
            $this->Cell(20, 35, $row['nrc_no'], 1);
            $this->MultiCell(100, 7, $row['address'], 1);
            //$this->Ln();
        }
    }

}

//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $flightData=  customerHelper::searchCustomer($_GET['searchKey']);
}else{
    $flightData= customerHelper::selectAll();
}
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Customer Report', 0, 1, 'C');

$pdf->Ln();

// Column headings
//$header = array('Package','Duration','No of People','Price');
$header=array();

foreach ($flightData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);
    
    $name= $value['lastname'] . ", " . $value['firstname'];    
    $address= "Phone No : " . $value['phone_no'] . "\n" .
            "Street : " . $value['street'] . "\n" .
            "City : " . $value['city'] . "\n" .
            "Country : " . $value['country'] . "\n" .
            "Post Code : " . $value['post_code'];
    
    $data[] = array(
        'customer_id' => $value['customer_id'],
        'name' => $name,
        'gender' => $value['gender'],
        'DOB' =>  substr($value['DOB'], 0,10) ,
        'nrc_no' => $value['nrc_no'],
        'address' =>$address       
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>