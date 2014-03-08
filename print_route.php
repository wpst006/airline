<?php

require('includes/includefiles.php');
require('myPDF.php');
require('includes/routeHelper.php');

class routePDF extends myPDF {

    // Simple table
    function BasicTable($header, $data) {
        $this->SetFont('Times', 'B', 12);
        // Header
        $this->Cell(75, 7, 'Title', 1);
        $this->Cell(25, 7, 'Duration', 1);
        $this->Cell(75, 7, 'Remark', 1);
        $this->Ln();
        // Data        
        foreach ($data as $row) {
            $this->SetFont('Times', '', 12);
            $this->Cell(75, 7, $row['title'], 1);
            $this->Cell(25, 7, $row['duration'], 1);
            $this->Cell(75, 7, $row['remark'], 1);
            $this->Ln();
        }
    }

}

// Instanciation of inherited class
$pdf = new routePDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Routes Report', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$routeData = routeHelper::selectAll();

// Column headings
$header = array('Title','Duration','Remark');

foreach ($routeData as $key => $value) {
    $data[] = array('title'=>$value['title'],
        'duration'=>$value['hour'] . ':' . $value['min'],
        'remark'=>$value['remark']);
}

$pdf->BasicTable($header, $data);
$pdf->Output();
?>