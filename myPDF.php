<?php
require('fpdf/fpdf.php');

class myPDF extends FPDF {

    // Page header
    function Header() {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 16);
        // Move to the right
        //$this->Cell(80);
        // Title
        //$this->Cell(30, 10, 'Air Line', 0, 0, 'C');
        $this->Cell(0, 10, 'Comfy Online Air Ticket Control System', 0, 0, 'C');
        // Line break
        $this->Ln();
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
?>