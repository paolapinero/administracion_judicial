<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'libraries/excel_lib/PHPExcel.php';
include_once APPPATH . 'libraries/excel_lib/PHPExcel/IOFactory.php';
class Fichas extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->library('javascript');
    $this->load->library('session');
		$this->load->library('parser');
		$this->load->model('Usuario');
		$this->load->model('Demandado');
    $this->load->model('Subestado');
    $this->load->model('Abogado');
    $this->load->model('Estado');
    $this->load->model('Ficha');
    $this->load->model('Garantia');
    $this->load->model('TipoDocumento');
    $this->load->model('Sucursal');
    $this->load->model('Demandante');
    $this->load->model('Moneda');
    $this->load->model('MyModel');
	}

  function index(){
    //$this->init();
    $fichas = $this->Ficha->getFichas();
    $data['fichas'] = $fichas;
    $this->load->view('Fichas/index',$data);
    //var_dump($fichas[0]);
  }

  function seleccionar_demandante_importar() {
      $demandantes = $this->Demandante->buscar_select();
      $this->load->view();
  }
	
  function campos_excel(){
    $campos_disponibles = array(
        'demandando_id' => 'RUT DEMANDADO',
        'tribunal_id' => 'TRIBUNAL',
        'rol' => 'ROL',
        'abogado_id' => 'ABOGADO INTERNO',
        'fecha_ingreso_distribucion' => 'FECHA DE INGRESO A DISTRIBUCIÓN',
        'fecha_ingreso_tribunal' => 'FECHA DE INGRESO A TRIBUNAL',
        'procurador_id' => 'PROCURADOR',
        'numero_operacion' => 'NUM DE OPERACIÓN',
        'tipo_documento_id' => 'TIPO DE DOCUMENTO',
        'garantia_id' => 'GARANTIA',
        'deuda' => 'DEUDA',
        'detalle_deuda' => 'DETALLE DEUDA',
        'sucursal_id' => 'SUCURSAL',
        'numero_ficha_externo' =>  'NÚMERO DE FICHA DEL CLIENTE',
        'fecha_entrega_abogado' => 'FECHA DE ENTREGA A ABOGADO'
      );
      $data['campos_disponibles'] = $campos_disponibles;
      $demandantes = $this->Demandante->buscar_select();
      $data['demandantes'] = $demandantes;
      $this->load->view('Fichas/campos_excel',$data);
  }

  function importar_fichas2(){
    ini_set("memory_limit","300000000000M");
        //$this->init();
    $this->load->library('excel');
    $seleccionados = $this->input->post('seleccionados');
    $process = $this->input->post('process');
    $demandantes = $this->Demandante->buscar_select();
        $data['demandantes'] = $demandantes;
    if ($process) {
        
    } 
    $this->load->view('Fichas/importar_fichas',$data);
  }

	function importar_fichas(){
        ini_set("memory_limit","300000000000M");
        //$this->init();
        $this->load->library('excel');
		    $process = $this->input->post('process');

        $has_error = false;
        $th_error = false;
        $pagina = 0;
        if($process && !empty($_FILES['file']['name'])){
            if ($this->input->post('demandante_id') == 28) {
            //Cargar PHPExcel library 
        	  $name   = $_FILES['file']['name'];
            $tname  = $_FILES['file']['tmp_name'];
           	$objPHPExcel = PHPExcel_IOFactory::load($tname);
            $fichas = array();
            $data = array();

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                
                if($pagina == 0){
                    $pagina++;                        
                    foreach ($worksheet->getRowIterator() as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE); // Loop all cells, even if it is not set
                    
                        if ($row->getRowIndex()>1 ) {
                            $i = 0;
                            $j = 0;
                            foreach ($cellIterator as $cell) {
                                switch ($i) {
                                    case 0:
                                      $nombre_cliente = $cell->getCalculatedValue();
                                      break;
                                    case 1:
                                      $num_operacion = $cell->getCalculatedValue();
                                      break;
                                    case 2:
                                      $detalle_producto = $cell->getCalculatedValue();
                                      break;
                                    case 3:
                                      $producto = $cell->getCalculatedValue();
                                      break;
                                    case 4:
                                      $rut_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 7:
                                      $moneda = $cell->getCalculatedValue();
                                      break;
                                    case 8:
                                      $deuda_original = $cell->getCalculatedValue();
                                      break;
                                    case 9:
                                      $deuda_demanda = $cell->getCalculatedValue();
                                      break; 
                                    case 10:
                                   	 	$deuda_UF = $cell->getCalculatedValue();
                                    	break;
                                    case 11:
                                      $direccion_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 12:
                                   	 	$ciudad_demandado = $cell->getCalculatedValue();
                                    	break;
                                    case 13:
                                   	 	$comuna_demandado = $cell->getCalculatedValue();
                                    	break;
                                    case 14:
                                        $fecha_curse_cdto = $cell->getCalculatedValue();
                                        break;
                                    case 15:
                                   	 	$numero_cuotas = $cell->getCalculatedValue();
                                    	break;
                                    case 16:
                                      $tasa_cdto = $cell->getCalculatedValue();
                                      break;
                                    case 17:
                                   	 	$monto_cuota = $cell->getCalculatedValue();
                                    	break;
                                    case 18:
                                   	 	$ultima_cuota = $cell->getCalculatedValue();
                                    	break;
                                    case 19:
                                      $fecha_vcto_1_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 20:
                                      $fecha_vcto_ult_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 21:
                                      $nro_1_cta_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 22:
                                      $fecha_vcto_1_cuota_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 23:
                                      $demandante = $cell->getCalculatedValue();
                                      break;  
                                    case 31:
                                   	 	$cod_sucursal = $cell->getCalculatedValue();
                                    	break;
                                    case 32:
                                   	 	$nombre_sucursal = $cell->getCalculatedValue();
                                    	break;
                                    case 33:
                                   	 	$zona_sucursal = $cell->getCalculatedValue();
                                    	break;
                                    case 34:
                                   	 	$territorial_sucursal = $cell->getCalculatedValue();
                                    	break;
                                    case 35:
                                      $num_ficha_cliente = $cell->getCalculatedValue();
                                      break;
                                    default:
                                      break;
                                }
                                $i++;
                            }
                            //Busco id del demandado
                           	$demandado = $this->Demandado->buscar(array('rut' => trim($rut_demandado, 0)));
                            if (empty($demandado)) {
                                //Tengo que guardar en la tabla demandado
                                $nuevo_demandado = array(
                                  'rut' => trim($rut_demandado, 0),
                                  'nombre' => $nombre_cliente
                                );
                                $demandado_id = $this->Demandado->agregar($nuevo_demandado);  

                            } else {
                              $demandado_id = $demandado[0]['id'];
                            }

                            //Buscar producto
                            $tipo_documento = $this->TipoDocumento->buscar(array('documento' => $producto, 'detalle' => $detalle_producto));
                            if (empty($tipo_documento)) {    
                                $nuevo_documento = array(
                                    'documento' => $producto,
                                    'detalle' => $detalle_producto,
                                    'active' => 'S',
                                  );
                                $tipo_documento_id = $this->TipoDocumento->agregar($nuevo_documento);
                            } else {
                              $tipo_documento_id  = $tipo_documento[0]['id'];
                            }

                            //Busco moneda
                            $moneda_b = $this->Moneda->buscar(array('moneda' => $moneda));
                            if (empty($moneda_b)) {    
                                $nueva_moneda = array(
                                    'moneda' => $moneda,
                                  );
                                $moneda_id = $this->Moneda->agregar($nueva_moneda);
                            } else {
                              $moneda_id  = $moneda_b[0]['id'];
                            }

                            //Direccion demandado
                            //Busco la comuna
                            $this->db->select('demandados_direccion.*, comunas.*');
                            $this->db->from('demandados_direccion');
                            $this->db->join('comunas','comunaS.id = demandados_direccion.comuna_id');
                            $this->db->where(array(
                                'demandados_direccion.direccion' => $direccion_demandado,
                                'demandados_direccion.demandado_id' => $demandado_id,
                                'comunas.comuna' => $comuna_demandado
                            ));
                            $es_metropolitana = 'N';
                            $etapa_id= 8; 
                            $query = $this->db->get();
                            $existe_direccion = $query->result_array();
                            if (empty($existe_direccion)) {
                                $comuna = $this->MyModel->buscar_model('comunas',array('LEFT(comuna,15)' => $comuna_demandado));
                                if (empty($comuna[0])) {
                                    print_r('No se puede cargar el archivo ya que la comuna '.$comuna_demandado.' no existe');die();                                
                                    }
                                if ($comuna[0]['region'] == 13) {
                                    $es_metropolitana = 'S';
                                    $etapa_id = 1;
                                }
                                //TODAS LAS COMUNAS DEBEN EXISTIR
                                $comuna_id = $comuna[0]['id'];
                                $this->MyModel->agregar_model('demandados_direccion',array(
                                    'demandado_id' => $demandado_id,
                                    'comuna_id' => $comuna_id,
                                    'direccion' => $direccion_demandado,
                                    'ciudad' => $ciudad_demandado
                                ));
                            } else {
                              if ($existe_direccion[0]['region'] == 13) {
                                  $es_metropolitana = 'S';
                                  $etapa_id = 1;
                              }
                            }
                            //Buscar sucursal
                            $sucursal = $this->Sucursal->buscar(array('sucursal' => $nombre_sucursal, 'demandante_id' => $this->input->post('demandante_id')));
                            if (empty($sucursal)) {    
                                $nueva_sucursal = array(
                                    'codigo' => $cod_sucursal,
                                    'zona' => $zona_sucursal,
                                    'territorial' => $territorial_sucursal, 
                                    'sucursal' => $nombre_sucursal,
                                    'demandante_id' => $this->input->post('demandante_id')
                                  );
                                $sucursal_id = $this->Sucursal->agregar($nueva_sucursal);
                            } else {
                             $sucursal_id = $sucursal[0]['id'];
                             // print_r($sucursal);die();
                            }
                            //Verificar rol
                            //print_r($num_operacion);die();
                            $ficha = array(
                                'demandado_id' => $demandado_id,
                                'demandante_id' => $this->input->post('demandante_id'),
                                'fecha_asignacion' => $this->input->post('fecha_asignacion'),
                                'fecha_estado' => date('Y-m-d'),
                                'numero_operacion' => $num_operacion,
                                'tipo_documento_id' => $tipo_documento_id,
                                'deuda_original'=> $deuda_demanda,
                                'sucursal_id' => $sucursal_id,
                                'num_ficha_cliente' => $num_ficha_cliente,
                                'moneda_id' => $moneda_id,
                                'deuda_UF' => $deuda_UF,
                                'numero_cuotas' => $numero_cuotas,
                                'monto_cuotas' => $monto_cuota,
                                'ultima_cuota' => $ultima_cuota,
                                'es_metropolitana' => $es_metropolitana,
                                'etapa_id' => $etapa_id,
                                'fecha_vcto_1_cuota' => $fecha_vcto_1_cuota,
                                'fecha_vcto_ult_cuota' => $fecha_vcto_ult_cuota,
                                'nro_1_cta_morosa' => $nro_1_cta_morosa,
                                'fecha_vcto_1_cuota_morosa' => $fecha_vcto_1_cuota_morosa,
                                'fecha_curse_cdto' => $fecha_curse_cdto,
                                'tasa_cdto' => $tasa_cdto,
                                'clave' =>$this->input->post('demandante_id').'+'.$rut_demandado.'+'.$num_operacion
                            );
                            array_push($fichas, $ficha);
                            
                        }
                    }
                    
                    $data['fichas'] = $fichas;
                    // $data['empresas'] = $empresas;
                    $this->Ficha->insertar_fichas($fichas);
                }

            }
            //END ES ARCHIVO DEL BANCO SANTANDER
          } elseif ($this->input->post('demandante_id') == 19) { //Corpbanca 
            //END ES ARCHIVO CAE
            //Cargar PHPExcel library 
            $name   = $_FILES['file']['name'];
            $tname  = $_FILES['file']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($tname);
            $fichas = array();
            $data = array();
            //print_r('entro');
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
              //  print_r($pagina);
                $pagina++;
                if($pagina == 2){
                   // print_r($pagina);die();
                                            
                    foreach ($worksheet->getRowIterator() as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE); // Loop all cells, even if it is not set
                    
                        if ($row->getRowIndex()>1 ) {
                            $i = 0;
                            $j = 0;
                            foreach ($cellIterator as $cell) {
                             // print_r($i);
                                switch ($i) {
                                    case 0:
                                      $nombre_cliente = $cell->getCalculatedValue();
                                      break;
                                    case 1:
                                      $num_operacion = $cell->getCalculatedValue();
                                      break;
                                    case 2:
                                      $detalle_producto = $cell->getCalculatedValue();
                                      break;
                                    case 3:
                                      $producto = $cell->getCalculatedValue();
                                      break;
                                    case 4:
                                      $rut_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 7:
                                      $moneda = $cell->getCalculatedValue();
                                      break;
                                    case 9:
                                      $MONTO_A_DEMANDAR_TGR_UF = $cell->getCalculatedValue();
                                      break;
                                    case 10:
                                      $MONTO_A_DEMANDAR_BCO_UF = $cell->getCalculatedValue();
                                      break;
                                    case 11:
                                      $MONTO_A_DEMANDAR_IES1_UF = $cell->getCalculatedValue();
                                      break;
                                    case 12:
                                      $MONTO_A_DEMANDAR_IES2_UF = $cell->getCalculatedValue();
                                      break;
                                    case 13:
                                      $MONTO_A_DEMANDAR_IES3_UF = $cell->getCalculatedValue();
                                      break;
                                    case 14:
                                      $MONTO_A_DEMANDAR_IES4_UF = $cell->getCalculatedValue();
                                      break;
                                    case 15:
                                      $MONTO_A_DEMANDAR_IES5_UF = $cell->getCalculatedValue();
                                      break;
                                    case 16:
                                      $MONTO_A_DEMANDAR_TGR_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 17:
                                      $MONTO_A_DEMANDAR_BCO_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 18:
                                      $MONTO_A_DEMANDAR_IES1_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 19:
                                      $MONTO_A_DEMANDAR_IES2_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 20:
                                      $MONTO_A_DEMANDAR_IES3_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 21:
                                      $MONTO_A_DEMANDAR_IES4_PESOS = $cell->getCalculatedValue();
                                      break;
                                    case 22:
                                      $MONTO_A_DEMANDAR_IES5_PESOS = $cell->getCalculatedValue();
                                      break;
                                     case 23:
                                      $direccion_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 24:
                                      $ciudad_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 25:
                                      $comuna_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 26:
                                      $fecha_curse_cdto = $cell->getCalculatedValue();
                                      break;
                                    case 27:
                                      $numero_cuotas = $cell->getCalculatedValue();
                                      break;
                                    case 28:
                                      $tasa_cdto = $cell->getCalculatedValue();
                                      break;
                                    case 29:
                                      $monto_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 30:
                                      $ultima_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 31:
                                      $fecha_vcto_1_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 32:
                                      $fecha_vcto_ult_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 33:
                                      $nro_1_cta_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 34:
                                      $fecha_vcto_1_cuota_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 35:
                                      $demandante = $cell->getCalculatedValue();
                                      break;  
                                    default:
                                      break;
                                }
                                $i++;
                            }
                            $deuda_UF = $MONTO_A_DEMANDAR_IES5_UF+$MONTO_A_DEMANDAR_IES4_UF+$MONTO_A_DEMANDAR_IES3_UF+$MONTO_A_DEMANDAR_IES2_UF+$MONTO_A_DEMANDAR_IES1_UF+$MONTO_A_DEMANDAR_BCO_UF+$MONTO_A_DEMANDAR_TGR_UF;
                            $deuda_demanda = $MONTO_A_DEMANDAR_IES5_PESOS+$MONTO_A_DEMANDAR_IES4_PESOS+$MONTO_A_DEMANDAR_IES3_PESOS+$MONTO_A_DEMANDAR_IES2_PESOS+$MONTO_A_DEMANDAR_IES1_PESOS+$MONTO_A_DEMANDAR_BCO_PESOS+$MONTO_A_DEMANDAR_TGR_PESOS;
                            //Busco id del demandado
                            $demandado = $this->Demandado->buscar(array('rut' => trim($rut_demandado, 0)));
                            if (empty($demandado)) {
                                //Tengo que guardar en la tabla demandado
                                $nuevo_demandado = array(
                                  'rut' => trim($rut_demandado, 0),
                                  'nombre' => $nombre_cliente
                                );
                                //print_r($nuevo_demandado);die();
                                $demandado_id = $this->Demandado->agregar($nuevo_demandado);  

                            } else {
                              $demandado_id = $demandado[0]['id'];
                            }

                            //Buscar producto
                            $tipo_documento = $this->TipoDocumento->buscar(array('documento' => $producto, 'detalle' => $detalle_producto));
                            print_r($detalle_producto);
                            if (empty($tipo_documento)) {    
                                $nuevo_documento = array(
                                    'documento' => $producto,
                                    'detalle' => $detalle_producto,
                                    'active' => 'S',
                                  );
                                $tipo_documento_id = $this->TipoDocumento->agregar($nuevo_documento);
                            } else {
                              $tipo_documento_id  = $tipo_documento[0]['id'];
                            }

                            //Busco moneda
                            $moneda_b = $this->Moneda->buscar(array('moneda' => $moneda));
                            if (empty($moneda_b)) {    
                                $nueva_moneda = array(
                                    'moneda' => $moneda,
                                  );
                                $moneda_id = $this->Moneda->agregar($nueva_moneda);
                            } else {
                              $moneda_id  = $moneda_b[0]['id'];
                            }

                            //Direccion demandado
                            //Busco la comuna
                            $this->db->select('demandados_direccion.*, comunas.*');
                            $this->db->from('demandados_direccion');
                            $this->db->join('comunas','comunaS.id = demandados_direccion.comuna_id');
                            $this->db->where(array(
                                'demandados_direccion.direccion' => $direccion_demandado,
                                'demandados_direccion.demandado_id' => $demandado_id,
                                'comunas.comuna' => $comuna_demandado
                            ));
                            $es_metropolitana = 'N';
                            $etapa_id= 8; 
                            $query = $this->db->get();
                            $existe_direccion = $query->result_array();
                            if (empty($existe_direccion)) {
                                $comuna = $this->MyModel->buscar_model('comunas',array('comuna' => $comuna_demandado));
                                if (empty($comuna[0])) {
                                    print_r('No se puede cargar el archivo ya que la comuna '.$comuna_demandado.' no existe');die();                                
                                    }
                                if ($comuna[0]['region'] == 13) {
                                    $es_metropolitana = 'S';
                                    $etapa_id = 1;
                                }
                                //TODAS LAS COMUNAS DEBEN EXISTIR
                                $comuna_id = $comuna[0]['id'];
                                $this->MyModel->agregar_model('demandados_direccion',array(
                                    'demandado_id' => $demandado_id,
                                    'comuna_id' => $comuna_id,
                                    'direccion' => $direccion_demandado,
                                    'ciudad' => $ciudad_demandado
                                ));
                            } else {
                              if ($existe_direccion[0]['region'] == 13) {
                                  $es_metropolitana = 'S';
                                  $etapa_id = 1;
                              }
                            }
                            //Verificar rol
                            //print_r($num_operacion);die();
                            $ficha = array(
                                'demandado_id' => $demandado_id,
                                'demandante_id' => $this->input->post('demandante_id'),
                                'fecha_asignacion' => $this->input->post('fecha_asignacion'),
                                'fecha_estado' => date('Y-m-d'),
                                'numero_operacion' => $num_operacion,
                                'tipo_documento_id' => $tipo_documento_id,
                                'moneda_id' => $moneda_id,
                                'deuda_UF' => $deuda_UF,
                                'deuda_demanda' => $deuda_demanda,
                                'numero_cuotas' => $numero_cuotas,
                                'monto_cuotas' => $monto_cuota,
                                'ultima_cuota' => $ultima_cuota,
                                'es_metropolitana' => $es_metropolitana,
                                'etapa_id' => $etapa_id,
                                'fecha_vcto_1_cuota' => $fecha_vcto_1_cuota,
                                'fecha_vcto_ult_cuota' => $fecha_vcto_ult_cuota,
                                'nro_1_cta_morosa' => $nro_1_cta_morosa,
                                'fecha_vcto_1_cuota_morosa' => $fecha_vcto_1_cuota_morosa,
                                'fecha_curse_cdto' => $fecha_curse_cdto,
                                'clave' =>$this->input->post('demandante_id').'+'.$rut_demandado.'+'.$num_operacion
                            );
                            array_push($fichas, $ficha);
                            
                        }
                    }
                    
                    $data['fichas'] = $fichas;
                    // $data['empresas'] = $empresas;
                    $this->Ficha->insertar_fichas($fichas);
                }

            }
            //END ES ARCHIVO DE CORPBANCA
          } elseif ($this->input->post('demandante_id') == 32) { //Caja los andes
            //END ES ARCHIVO CAE
            //Cargar PHPExcel library 
            $name   = $_FILES['file']['name'];
            $tname  = $_FILES['file']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($tname);
            $fichas = array();
            $data = array();

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                
                if($pagina == 0){
                    $pagina++;                        
                    foreach ($worksheet->getRowIterator() as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE); // Loop all cells, even if it is not set
                    
                        if ($row->getRowIndex()>1 ) {
                            $i = 0;
                            $j = 0;
                            foreach ($cellIterator as $cell) {
                                switch ($i) {
                                    case 3:
                                      $nombres = $cell->getCalculatedValue();
                                      break;
                                    case 4:
                                      $apellido1 = $cell->getCalculatedValue();
                                      break;
                                    case 5:
                                      $apellido2 = $cell->getCalculatedValue();
                                      break;
                                    case 1:
                                      $num_operacion = $cell->getCalculatedValue();
                                      break;
                                    case 38:
                                      $producto = $cell->getCalculatedValue();
                                      break;
                                    case 1:
                                      $rut_demandado_s = $cell->getCalculatedValue();
                                      break;
                                    case 2:
                                      $verificador = $cell->getCalculatedValue();
                                      break;
                                    case 7:
                                      $moneda = $cell->getCalculatedValue();
                                      break;
                                    case 41:
                                      $deuda_demanda = $cell->getCalculatedValue();
                                      break; 
                                    case 10:
                                      $deuda_UF = $cell->getCalculatedValue();
                                      break;
                                    case 7:
                                      $direccion_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 16:
                                      $ciudad_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 9:
                                      $comuna_demandado = $cell->getCalculatedValue();
                                      break;
                                    case 18:
                                      $fecha_curse_cdto = $cell->getCalculatedValue();
                                      break;
                                    case 42:
                                      $numero_cuotas = $cell->getCalculatedValue();
                                      break;
                                    case 20:
                                      $tasa_cdto = $cell->getCalculatedValue();
                                      break;
                                    case 43:
                                      $monto_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 22:
                                      $ultima_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 44:
                                      $fecha_vcto_1_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 24:
                                      $fecha_vcto_ult_cuota = $cell->getCalculatedValue();
                                      break;
                                    case 25:
                                      $nro_1_cta_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 26:
                                      $fecha_vcto_1_cuota_morosa = $cell->getCalculatedValue();
                                      break;
                                    case 27:
                                      $demandante = $cell->getCalculatedValue();
                                      break;  
                                    default:
                                      break;
                                }
                                $i++;
                            }
                            $detalle_producto = 'Pagare';
                            $nombre_cliente = $nombres.' '.$apellido1.' '.$apellido2;
                            $rut_demandado = $rut_demandado_s.'-'.$verificador;
                            //Busco id del demandado
                            $demandado = $this->Demandado->buscar(array('rut' => trim($rut_demandado, 0)));
                            if (empty($demandado)) {
                                //Tengo que guardar en la tabla demandado
                                $nuevo_demandado = array(
                                  'rut' => trim($rut_demandado, 0),
                                  'nombre' => $nombre_cliente
                                );
                                //print_r($nuevo_demandado);die();
                                $demandado_id = $this->Demandado->agregar($nuevo_demandado);  

                            } else {
                              $demandado_id = $demandado[0]['id'];
                            }

                            //Buscar producto
                            $tipo_documento = $this->TipoDocumento->buscar(array('documento' => $producto, 'detalle' => $detalle_producto));
                            if (empty($tipo_documento)) {    
                                $nuevo_documento = array(
                                    'documento' => $producto,
                                    'detalle' => $detalle_producto,
                                    'active' => 'S',
                                  );
                                $tipo_documento_id = $this->TipoDocumento->agregar($nuevo_documento);
                            } else {
                              $tipo_documento_id  = $tipo_documento[0]['id'];
                            }

                            //Busco moneda
                            $moneda_b = $this->Moneda->buscar(array('moneda' => $moneda));
                            if (empty($moneda_b)) {    
                                $nueva_moneda = array(
                                    'moneda' => $moneda,
                                  );
                                $moneda_id = $this->Moneda->agregar($nueva_moneda);
                            } else {
                              $moneda_id  = $moneda_b[0]['id'];
                            }

                            //Direccion demandado
                            //Busco la comuna
                            $this->db->select('demandados_direccion.*, comunas.*');
                            $this->db->from('demandados_direccion');
                            $this->db->join('comunas','comunaS.id = demandados_direccion.comuna_id');
                            $this->db->where(array(
                                'demandados_direccion.direccion' => $direccion_demandado,
                                'demandados_direccion.demandado_id' => $demandado_id,
                                'comunas.comuna' => $comuna_demandado
                            ));
                            $es_metropolitana = 'N';
                            $etapa_id= 8; 
                            $query = $this->db->get();
                            $existe_direccion = $query->result_array();
                            if (empty($existe_direccion)) {
                                $comuna = $this->MyModel->buscar_model('comunas',array('comuna' => $comuna_demandado));
                                if (empty($comuna[0])) {
                                    print_r('No se puede cargar el archivo ya que la comuna '.$comuna_demandado.' no existe');die();          
                                    //Falta redireccionar a la vista de crear comunas                      
                                    }
                                if ($comuna[0]['region'] == 13) {
                                    $es_metropolitana = 'S';
                                    $etapa_id = 1;
                                }
                                //TODAS LAS COMUNAS DEBEN EXISTIR
                                $comuna_id = $comuna[0]['id'];
                                $this->MyModel->agregar_model('demandados_direccion',array(
                                    'demandado_id' => $demandado_id,
                                    'comuna_id' => $comuna_id,
                                    'direccion' => $direccion_demandado,
                                    'ciudad' => $ciudad_demandado
                                ));
                            } else {
                              if ($existe_direccion[0]['region'] == 13) {
                                  $es_metropolitana = 'S';
                                  $etapa_id = 1;
                              }
                            }
                            //Verificar rol
                            //print_r($num_operacion);die();
                            $ficha = array(
                                'demandado_id' => $demandado_id,
                                'demandante_id' => $this->input->post('demandante_id'),
                                'fecha_asignacion' => $this->input->post('fecha_asignacion'),
                                'fecha_estado' => date('Y-m-d'),
                                'numero_operacion' => $num_operacion,
                                'tipo_documento_id' => $tipo_documento_id,
                                'moneda_id' => $moneda_id,
                                'deuda_UF' => $deuda_UF,
                                'numero_cuotas' => $numero_cuotas,
                                'monto_cuotas' => $monto_cuota,
                                'ultima_cuota' => $ultima_cuota,
                                'es_metropolitana' => $es_metropolitana,
                                'etapa_id' => $etapa_id,
                                'fecha_vcto_1_cuota' => $fecha_vcto_1_cuota,
                                'fecha_vcto_ult_cuota' => $fecha_vcto_ult_cuota,
                                'nro_1_cta_morosa' => $nro_1_cta_morosa,
                                'fecha_vcto_1_cuota_morosa' => $fecha_vcto_1_cuota_morosa,
                                'fecha_curse_cdto' => $fecha_curse_cdto,
                                'clave' =>$this->input->post('demandante_id').'+'.$rut_demandado.'+'.$num_operacion
                            );
                            array_push($fichas, $ficha);
                            
                        }
                    }
                    
                    $data['fichas'] = $fichas;
                    // $data['empresas'] = $empresas;
                    $this->Ficha->insertar_fichas($fichas);
                }

            }
            //END ES ARCHIVO DE CAJA LOS ANDES
          }

        }//END HAY ARCHIVO PROCESS 

        $demandantes = $this->Demandante->buscar_select();
        $data['demandantes'] = $demandantes;
        $this->load->view('fichas/importar_fichas',$data);

    }

    function imprimir(){
        $this->load->library('Pdf'); 
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        $fichas = $this->Ficha->buscar_imprimir();
        foreach ($fichas as $f) {
            $res = Zend_Barcode::factory('code128', 'image',array('text'=>$f['clave']),array());
            $res = $res->draw();
            imagepng($res, './codigos/'.$f['clave'].'.png');
        }

        //$pdf->SetAuthor('Israel Parra');
       // $pdf->SetTitle('Ejemplo de provincías con TCPDF');
        //$pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $fichas = $this->Ficha->buscar_imprimir();
        //foreach($fichas as $fila)
        $i = 0;
        while($i<1)
        {
            $clave = $fichas[$i]['clave'];
            //
            //preparamos y maquetamos el contenido a crear
            $html = '';
            $html .= "<style type=text/css>";
            $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
            $html .= "td{background-color: #AAC7E3; color: #fff}";
            $html .= "</style>";
            $html .= '<img src="./codigos/'.$clave.'.png">';
        //generate barcode
            //$html .= Zend_Barcode::render('code128', 'image', array('text'=>$clave), array())->render();
            $style = array(
                'border' => true,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 4, // width of a single module in points
                'module_height' => 3 // height of a single module in points
            );

            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            //$pdf->Ln();
            //$pdf->Addpage();
            $i++;
        }
        
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Demandas.pdf");
        $pdf->Output($nombre_archivo, 'I');     
    }

}
?>