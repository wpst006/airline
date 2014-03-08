<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/bookingHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(50, 7, 'Booking ID', 1);
        $this->Cell(50, 7, 'Date', 1);
        $this->Cell(50, 7, 'Customer ID', 1);
        $this->Cell(50, 7, 'First Name', 1);
        $this->Cell(50, 7, 'Last Name', 1);
        $this->Cell(30, 7, 'Total', 1);
        
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50, 7, $row['booking_id'], 1);
            $this->Cell(50, 7, $row['bookingdate'], 1);
            $this->Cell(50, 7, $row['customer_id'], 1);
            $this->Cell(50, 7, $row['firstname'], 1);
            $this->Cell(50, 7, $row['lastname'], 1);
            $this->Cell(30, 7, $row['total'], 1);
            $this->Ln();
        }
    }
}

//***************************************************************************************************************
$customer = null;
$fromDate = null;
$toDate = null;

if (isset($_GET['customer'])) {
    $customer = $_GET['customer'];
}

if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
}
//***************************************************************************************************************
$bookingData = bookingHelper::getBooking($fromDate, $toDate, $customer);

// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Bookings Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

// Column headings
$header = array('Booking ID', 'Date', 'Customer ID', 'First Name', 'Last Name', 'Total');

foreach ($bookingData as $bookingKey => $bookingValue) {

    $pdf->SetFont('Times', 'B', 14);

    $data[] = array(
        'booking_id' => $bookingValue['booking_id'],
        'bookingdate' => $bookingValue['bookingdate'],
        'customer_id' => $bookingValue['customer_id'],
        'firstname' => $bookingValue['firstname'],
        'lastname' => $bookingValue['lastname'],
        'total' => $bookingValue['total'],
    );    
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>