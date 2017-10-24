<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Make_pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		(!isset($_SESSION)) ? session_start() : '';
	        
	    if (!$this->session->userdata('username')) {
	        redirect('login');
	    }
	}

	/**
		* USE FPDF LIBRARY
		* EASY, NOT FUNCTIONAL
		* NOT USE HTML SOURCE
		* USE IN CASE PLAIN TEXT
	*/
	public function project_data_core($project_id)
	{
		/*
			* Se manda el pdf al navegador
			*
			* $this->pdf->Output(nombredelarchivo, destino);
			*
			* I = Muestra el pdf en el navegador
			* D = Envia el pdf para descarga
			*
		*/
	    $this->load->library('Pdf');

		/*
			* PROYECT DATA
		*/
			$this->load->model('Project_model');
			$project_data = $this->Project_model->get_project($project_id);

			$project_name 	= utf8_decode($project_data['name']);
			$description 	= utf8_decode($project_data['description']);
			$ranges_limits 	= utf8_decode($project_data['ranges']);
			$specifications = utf8_decode($project_data['specifications']);

			$project_texts = array( 
								array(
									'id' => 'desc', 
									'name' => utf8_decode('Descripción'), 
									'text' => $description, 
								),
								array(
									'id' => 'spc', 
									'name' => utf8_decode('Especificaciones'), 
									'text' => $specifications, 
								),
								array(
									'id' => 'ranges', 
									'name' => utf8_decode('Alcances y limitaciones'), 
									'text' => $ranges_limits, 
								)
							);

		/*
			* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			* heredó todos las variables y métodos de fpdf
		*/
			$this->pdf = new PDF();
			// Nombre del Reporte
			$this->pdf->setNameReport($project_name);

			// aslkdj
			$this->pdf->SetAutoPageBreak(true, 60);
			// Agregamos una página
			$this->pdf->AddPage('P', 'Letter');
			// Define el alias para el número de página que se imprimirá en el pie
			$this->pdf->AliasNbPages();

		/* 
			* Se define el titulo, márgenes izquierdo, derecho y
			* el color de relleno predeterminado
		*/
			$this->pdf->SetTitle($project_name);
			$this->pdf->SetLeftMargin(25);
			$this->pdf->SetRightMargin(25);
			$this->pdf->SetFillColor(129,129,129);

			// Se define el formato de fuente: OpenSans, Regular, tamaño 9

		/*
			* TEXT BUCLE
		*/
			foreach ($project_texts as $key => $value) {
				$this->pdf->SetTextColor(49,155,87);
				$this->pdf->SetFont('OpenSans', 'B', 16);
				$this->pdf->Cell(0, 4, $value['name'], 0, 'J');
				$this->pdf->Ln(7);
				$this->pdf->SetTextColor(53,54,56);
				$this->pdf->SetFont('OpenSans', '', 9);
				// $this->pdf->MultiCell(0, 4, $value['text'], 0, 'J');
				$this->pdf->WriteHTML($value['text']);
				$this->pdf->Ln(10);
			}
			
			$this->pdf->Output($project_name.'.pdf', 'I');
	}

	/**
		* USE TCPDF LIBRARY
		* NOT EASY, BUT FUNCTIONAL
		* USE HTML SOURCE
	*/
	public function project_data($project_id)
	{
		/*
			* PROYECT DATA
		*/
			$this->load->model('Project_model');
			$project_data = $this->Project_model->get_project($project_id);

			$project_name 	= $project_data['name'];
			$description 	= $project_data['description'];
			$ranges_limits 	= $project_data['ranges'];
			$specifications = $project_data['specifications'];

			$project_texts = array( 
								array(
									'id' => 'desc', 
									'name' => 'Descripción', 
									'text' => $description, 
								),
								array(
									'id' => 'spc', 
									'name' => 'Especificaciones', 
									'text' => $specifications, 
								),
								array(
									'id' => 'ranges', 
									'name' => 'Alcances y limitaciones', 
									'text' => $ranges_limits, 
								)
							);

			$this->load->library('Pdf_tc');

			// FONTS
			$path_osB 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Bold.ttf";
	        $path_osI 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Italic.ttf";
	        $path_osR 	= APPPATH."/third_party/tcpdf/fonts_custome/OpenSans-Regular.ttf";
	        $opensans_B = TCPDF_FONTS::addTTFfont($path_osB, 'TrueTypeUnicode', '', 96);
	        $opensans_I = TCPDF_FONTS::addTTFfont($path_osI, 'TrueTypeUnicode', '', 96);
	        $opensans_R = TCPDF_FONTS::addTTFfont($path_osR, 'TrueTypeUnicode', '', 96);

			$this->pdf = new Pdf_tc('P', 'mm', 'Letter', true, 'UTF-8', false);
			// MARGINS
			$this->pdf->SetMargins(15, 55, 15, true);
			// add a page
			$this->pdf->AddPage();

			// SET font
			$this->pdf->SetTextColor(31,49,91);
			$this->pdf->SetFont($opensans_B, '', 30, '', false);
        	// Title --- Project Name - Report Title
        	$this->pdf->Cell(0, 0, $project_name, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        	$this->pdf->Ln(15);

			/*
				* TEXT BUCLE
			*/	
			
			foreach ($project_texts as $key => $value) {
				$this->pdf->SetTextColor(49,155,87);
				$this->pdf->SetFont($opensans_B, '', 16, '', false);
				$this->pdf->Cell(0, 0, $value['name'], 0, 'J');
				$this->pdf->Ln(10);
				$this->pdf->SetTextColor(53,54,56);
				$this->pdf->SetFont($opensans_R, '', 9, '', false);
				// output the HTML content
				$this->pdf->writeHTML($value['text'], true, false, true, true, 'J');
				$this->pdf->Ln(15);
			}

			

			// reset pointer to the last page
			$this->pdf->lastPage();

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			$file_name = $this->clean_string($project_name).'.pdf';

			// test custom bullet points for list
			$this->pdf->Output($file_name, 'D');
	}

	public function demo()
  	{
		// Se carga el modelo alumno
		$this->load->model('alumno_modelo');
		// Se carga la libreria fpdf
		$this->load->library('pdf');

		// Se obtienen los alumnos de la base de datos
		$alumnos = $this->alumno_modelo->obtenerListaAlumnos();

		// Creacion del PDF

		/*
		 * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
		 * heredó todos las variables y métodos de fpdf
		 */
		$this->pdf = new Pdf();
		// Agregamos una página
		$this->pdf->AddPage();
		// Define el alias para el número de página que se imprimirá en el pie
		$this->pdf->AliasNbPages();

		/* Se define el titulo, márgenes izquierdo, derecho y
		 * el color de relleno predeterminado
		 */
		$this->pdf->SetTitle("Lista de alumnos");
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(200,200,200);

		// Se define el formato de fuente: Arial, negritas, tamaño 9
		$this->pdf->SetFont('Arial', 'B', 9);
		/*
		 * TITULOS DE COLUMNAS
		 *
		 * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
		 */

		$this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
		$this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
		$this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
		$this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
		$this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
		$this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
		$this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
		$this->pdf->Ln(7);
		// La variable $x se utiliza para mostrar un número consecutivo
		$x = 1;
		foreach ($alumnos as $alumno) {
			// se imprime el numero actual y despues se incrementa el valor de $x en uno
			$this->pdf->Cell(15,5,$x++,'BL',0,'C',0);
			// Se imprimen los datos de cada alumno
			$this->pdf->Cell(25,5,$alumno->paterno,'B',0,'L',0);
			$this->pdf->Cell(25,5,$alumno->materno,'B',0,'L',0);
			$this->pdf->Cell(25,5,$alumno->nombre,'B',0,'L',0);
			$this->pdf->Cell(40,5,$alumno->fec_nac,'B',0,'C',0);
			$this->pdf->Cell(25,5,$alumno->grado,'B',0,'L',0);
			$this->pdf->Cell(25,5,$alumno->grupo,'BR',0,'C',0);
			//Se agrega un salto de linea
			$this->pdf->Ln(5);
		}
		/*
		 * Se manda el pdf al navegador
		 *
		 * $this->pdf->Output(nombredelarchivo, destino);
		 *
		 * I = Muestra el pdf en el navegador
		 * D = Envia el pdf para descarga
		 *
		 */
		$this->pdf->Output("Lista de alumnos.pdf", 'I');
	}

	public function clean_string($string)
	{
	 
	    $string = trim($string);
	 
	    $string = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $string
	    );
	 
	    $string = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C',),
	        $string
	    );
	 
	    //Esta parte se encarga de eliminar cualquier caracter extraño
	    $string = str_replace(
	        array("\"", "¨", "º", "-", "~",
	             "#", "@", "|", "!", '"',
	             "·", "$", "%", "&", "/",
	             "(", ")", "?", "'", "¡",
	             "¿", "[", "^", "<code>", "]",
	             "+", "}", "{", "¨", "´",
	             ">", "< ", ";", ",", ":",
	             ".", " "),
	        '_',
	        $string
	    );
	 
	 
	    return $string;
	}
}

/* End of file Make_pdf.php */
/* Location: ./application/controllers/Make_pdf.php */