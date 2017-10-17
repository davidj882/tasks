<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// shared_options : highcharts global settings, like interface or language
$config['shared_options'] = array(
	'chart' => array(
		'backgroundColor' => array(
			'linearGradient' => array(0, 0, 500, 500),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(240, 240, 255)')
			)
		),
		'shadow' => true
	),
	'lang' => array(
		'contextButtonTitle' => "Chart context menu",
		'decimalPoint' => ".",
		'downloadJPEG' => "Descargar como imagen JPEG",
		'downloadPDF' => "Descargar como documento PDF",
		'downloadPNG' => "Descargar como imagen PNG",
		'downloadSVG' => "Descargar en vector SVG",
		'drillUpText' => "Regresar a {series.name}",
		'invalidDate' => "",
		'loading' => "Cargando...",
		'months' => array("Enero" , "Febrero" , "Marzo" , "Abril" , "Mayo" , "Junio" , "Julio" , "Agosto" , "Septiembre" , "Octubre" , "Noviembre" , "Diciembre"),
		'noData' => "No hay datos para mostrar",
		'numericSymbolMagnitude' => 1000,
		'numericSymbols' => array("k" , "M" , "G" , "T" , "P" , "E"),
		'printChart' => "Imprimir gráfica",
		'resetZoom' => "Restablecer zoom",
		'resetZoomTitle' => "Restablecer nivel de zoom 1: 1",
		'shortMonths' => array("Ene" , "Feb" , "Mar" , "Abr" , "May" , "Jun" , "Jul" , "Ago" , "Sep" , "Oct" , "Nov" , "Dic"),
		'shortWeekdays' => "undefined",
		'thousandsSep' => " ",
		'weekdays' => array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"),
	)
);

// Template Example
$config['chart_template'] = array(
	'chart' => array(
		'renderTo' => 'graph',
		'defaultSeriesType' => 'column',
		'backgroundColor' => array(
			'linearGradient' => array(0, 500, 0, 0),
			'stops' => array(
				array(0, 'rgb(255, 255, 255)'),
				array(1, 'rgb(190, 200, 255)')
			)
		),
     ),
     'colors' => array(
     	 '#ED561B', '#50B432'
     ),
     'credits' => array(
     	'enabled'=> true,
     	'text'	=> 'highcharts library on GitHub',
		'href' => 'https://github.com/ronan-gloo/codeigniter-highcharts-library'
     ),
     'title' => array(
		'text' => 'Template from config file'
     ),
     'legend' => array(
     	'enabled' => false
     ),
    'yAxis' => array(
		'title' => array(
			'text' => 'population'
		)
	),
	'xAxis' => array(
		'title' => array(
			'text' => 'Countries'
		)
	),
	'tooltip' => array(
		'shared' => true
	)
);