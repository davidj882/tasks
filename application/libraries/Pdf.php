<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf_html.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF_HTML
{
    public $name_report;

    public function __construct()
    {
        parent::__construct();

        $this->AddFont('OpenSans','','OpenSans-Regular.php');
        $this->AddFont('OpenSans','I','OpenSans-Italic.php');
        $this->AddFont('OpenSans','B','OpenSans-Bold.php');
    }

    // El encabezado del PDF
    public function Header()
    {
        $logo = site_url('assets/img/reports/header.png');
        $this->Image($logo, 0, 0, 216);
        $this->SetTextColor(31,49,91);
        $this->SetFont('OpenSans','B',30);
        $this->Ln(45);
        $this->Cell(0,10,$this->name_report,0,0,'C');
        $this->Ln(10);
        $this->SetFont('OpenSans','',16);
        $this->SetTextColor(129,129,129);
        $this->Cell(0,10,'PROYECTO',0,0,'C');
        $this->Ln(20);
    }

    // El pie del pdf
    public function Footer()
    {
        $logo = site_url('assets/img/reports/footer.png');
        $this->Image($logo, 0, 192, 216);
        if ($this->PageNo() > 0) {
            $this->SetY(-12);
            $this->SetTextColor(255,255,255);
            $this->SetFont('OpenSans', '',8);
            $this->Cell(0,10,utf8_decode('Pág. ').$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    public function setNameReport($name_report){
        $this->name_report = $name_report;
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
