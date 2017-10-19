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
	}

	public function project_data($project_id)
	{
		/*
			* PROYECT DATA
		*/

			$this->load->model('Project_model');
			$project_data = $this->Project_model->get_project($project_id);

			$project_name 	= utf8_decode($project_data['name']);
			$description 	= utf8_decode(strip_tags($project_data['description']));
			$ranges_limits 	= utf8_decode(strip_tags($project_data['ranges']));
			$specifications = utf8_decode(strip_tags($project_data['specifications']));

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
				$this->pdf->MultiCell(0, 4, $value['text'], 0, 'J');
				$this->pdf->Ln(10);
			}
			
			$this->pdf->Output($project_name.'.pdf', 'D');
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
}

/* End of file Make_pdf.php */
/* Location: ./application/controllers/Make_pdf.php */