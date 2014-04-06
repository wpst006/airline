<?php

require('includes/includefiles.php');
require('myPDF.php');
require('includes/flightHelper.php');

class routePDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(75, 7, 'Flight ID', 1);
        $this->Cell(75, 7, 'Name', 1);
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 7, $row['flight_id'], 1);
            $this->Cell(75, 7, $row['name'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new routePDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Flight Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
//***************************************************************************************************************
if (isset($_GET['searchKey'])){
    $flightData= flightHelper::searchFlight($_GET['searchKey']);
}else{
    $flightData= flightHelper::selectAll();
}
//***************************************************************************************************************

// Column headings
$header = array('Title','Duration','Remark');

foreach ($flightData as $key => $value) {
    $data[] = array('flight_id'=>$value['flight_id'],        
        'name'=>$value['name']);
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>