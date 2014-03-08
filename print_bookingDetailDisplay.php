<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/bookingHelper.php');

class printPDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        
        $this->Cell(50, 7, 'Seat', 1);
        $this->Cell(50, 7, 'No of Tickets', 1);
        $this->Cell(50, 7, 'Price', 1);
        $this->Cell(100, 7, 'Flight Info', 1);

        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(50,42, $row['seat_title'], 1);
            $this->Cell(50, 42, $row['no_of_seats'], 1);
            $this->Cell(50, 42, $row['price'], 1);  
            $this->MultiCell(100, 7, $row['flight_info'], 1);
                      
            //$this->Ln();
        }
    }

}

//***************************************************************************************************************
$booking_id = $_GET['booking_id'];
$bookingData = bookingHelper::getBookingByBookingID($booking_id);
$bookingDetailData = bookingHelper::getBookingDetailsByBookingID($booking_id);
//***************************************************************************************************************
// Instanciation of inherited class
$pdf = new printPDF("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(0, 10, 'Bookings Report', 0, 1, 'C');

$pdf->Ln();

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Booking ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['booking_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Booking Date :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['bookingdate'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Customer ID :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['customer_id'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'First Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['firstname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Last Name :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 7, $bookingData[0]['lastname'], 0, 1, 'L');

$pdf->Cell(80);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 7, 'Total :', 0, 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50,7, $bookingData[0]['total'], 0, 1, 'L');

$pdf->Ln();
// Column headings
$header = array('Flight Info', 'Seat', 'No of Tickets', 'Price');

foreach ($bookingDetailData as $key => $value) {

    $pdf->SetFont('Times', 'B', 12);
    $cellText = "Route : " . $value['route_title'] . "\n";
    $cellText.="Flight Name : " . $value['flight_name']. "\n";
    $cellText.="Departure Date Time : " . $value['departure_datetime']. "\n";
    $cellText.="Arrival Date Time : " . $value['arrival_datetime']. "\n";
    $cellText.="Departure Airport : " . $value['departure_airport']. "\n";
    $cellText.="Arrival Airport : " . $value['arrival_airport'];

    $data[] = array(
        'flight_info' => $cellText,
        'seat_title' => $value['seat_title'],
        'no_of_seats' => $value['no_of_seats'],
        'price' => $value['price'],
    );
}

$pdf->BasicTable($header, $data);
$pdf->Ln();
$pdf->Output();
?>