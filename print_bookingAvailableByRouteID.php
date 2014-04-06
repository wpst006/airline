<?php

require_once('includes/includefiles.php');
require_once('myPDF.php');
require_once('includes/routeHelper.php');
require_once('includes/scheduleHelper.php');

class bookingAvailableByRouteID extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(60, 7, 'Departure Date Time', 1);
        $this->Cell(60, 7, 'Arrival Date Time', 1);
        $this->Cell(60, 7, 'Departure Airport', 1);
        $this->Cell(60, 7, 'Arrival Airport', 1);
        
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(60, 7, $row['departure_datetime'], 1);
            $this->Cell(60, 7, $row['arrival_datetime'], 1);
            $this->Cell(60, 7, $row['departure_airport'], 1);
            $this->Cell(60, 7, $row['arrival_airport'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new bookingAvailableByRouteID("L");   //Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$route_id = $_GET['route_id'];

$flightData = routeHelper::getRouteByRouteID($route_id);

$pdf->Cell(0, 10, $flightData[0]['title'], 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$flightData = routeHelper::getFlightsByRouteID($route_id);
// Column headings
$header = array('Departure Date Time', 'Arrival Date Time', 'Departure Airport', 'Arrival Airport');

foreach ($flightData as $bookingKey => $bookingValue) {
    
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 10, $bookingValue['name'], 0, 1);

    $scheduleData = scheduleHelper::getSchedulesByRouteIDAndFlightID($route_id, $bookingValue['flight_id']);
    foreach ($scheduleData as $scheduleKey => $scheduleValue) {
        $data[] = array('departure_datetime' => $scheduleValue['departure_datetime'],
            'arrival_datetime' => $scheduleValue['arrival_datetime'],
            'departure_airport' => $scheduleValue['departure_airport'],
            'arrival_airport' => $scheduleValue['arrival_airport'],
        );
    }

    $pdf->BasicTable($header, $data);
    $pdf->Ln();
}

$pdf->Output();
?>