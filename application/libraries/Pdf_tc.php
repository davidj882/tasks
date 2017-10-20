<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/tcpdf/tcpdf.php";

class Pdf_tc extends TCPDF
{
	public $path_osB;
	public $path_osI;
	public $path_osR;
	public $opensans_B;
	public $opensans_I;
	public $opensans_R;

    function __construct()
    {
        parent::__construct();
        // Set font
        $this->path_osB 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Bold.ttf";
        $this->path_osI 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Italic.ttf";
        $this->path_osR 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Regular.ttf";
        $this->opensans_B = TCPDF_FONTS::addTTFfont($this->path_osB, 'TrueTypeUnicode', '', 96);
        $this->opensans_I = TCPDF_FONTS::addTTFfont($this->path_osI, 'TrueTypeUnicode', '', 96);
        $this->opensans_R = TCPDF_FONTS::addTTFfont($this->path_osR, 'TrueTypeUnicode', '', 96);
    }

    //Page header
    public function Header() {
        // Logo
        $image_file = site_url('assets/img/reports/header.png');
        //$this->Image($image_file, 0, 0, 209.75, 'PNG', '', '', 'N', true, 300,'', false, false);
        $this->Image($image_file, 0, 0, 209.75, '', '', '', '', false, 300);
    }

    // Page footer
    public function Footer() {
    	$image_file = site_url('assets/img/reports/footer.png');
        $this->Image($image_file, 0, 257, 209.75, '', '', '', '', false, 300);
        // Position at 15 mm from bottom
        $this->SetY(-6);
        // Set font
        $this->SetTextColor(255,255,255);
        $this->SetFont($this->opensans_R, '', 9, '', false);
        // Page number
        $text_footer = 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages();
        $this->Cell(0, 0, $text_footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

/* End of file Pdf_tc.php */
/* Location: ./application/libraries/Pdf_tc.php */