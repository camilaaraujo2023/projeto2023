<?php
// Include the FPDF library
require('fpdf/fpdf.php');

// Get users data (replace this with your actual data retrieval logic)
$usersData = array(
    array('Username1', 'Password1', 'Name1', 'Mother Name1', 'Phone1', 'Date1', 'CPF1', 'Cellphone1', 'Gender1', 'Address1', 'Profile1'),
    array('Username2', 'Password2', 'Name2', 'Mother Name2', 'Phone2', 'Date2', 'CPF2', 'Cellphone2', 'Gender2', 'Address2', 'Profile2'),
    // Add more rows as needed
);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 14);

// Add a title
$pdf->Cell(40, 10, 'User Data');

// Line break
$pdf->Ln(10);

// Set font for the table
$pdf->SetFont('Arial', '', 12);

// Add a table header
$pdf->Cell(20, 10, 'Username', 1);
$pdf->Cell(30, 10, 'Password', 1);
$pdf->Cell(30, 10, 'Name', 1);
$pdf->Cell(30, 10, 'Mother Name', 1);
$pdf->Cell(20, 10, 'Phone', 1);
$pdf->Cell(20, 10, 'Date', 1);
$pdf->Cell(20, 10, 'CPF', 1);
$pdf->Cell(25, 10, 'Cellphone', 1);
$pdf->Cell(20, 10, 'Gender', 1);
$pdf->Cell(40, 10, 'Address', 1);
$pdf->Cell(30, 10, 'Profile', 1);

// Line break
$pdf->Ln();

// Add user data to the table
foreach ($usersData as $userData) {
    foreach ($userData as $value) {
        $pdf->Cell(20, 10, $value, 1);
    }
    $pdf->Ln();
}

// Output the PDF to the browser
$pdf->Output();
?>