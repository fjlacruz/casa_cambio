<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configuraciones extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Configuraciones_model');
        $this->load->model('Transferencias_model');
        $this->load->library('Configemail');
    }

    //Funcion para consultar la tasa del dia 
    public function tasa()
    {
        extract($_POST);

        $vars =  $this->Configuraciones_model->consultar_tasa($id_pais);
        echo json_encode($vars);
    }
    //Funcion para actualizar la tasa

    public function actualizar_tasa_dia()
    {
        extract($_POST);
        $actualizacion = $this->Configuraciones_model->act_tasa($valor_tasa, $id_pais);
        
        $nom_pais = $this->Configuraciones_model->info_pais($id_pais);
        foreach($nom_pais as $nombre){
            $nombre_pais=$nombre->nombre_pais;
        }
        $correos = $this->Configuraciones_model->consultar_correos();
        foreach($correos as $destinatarios){
            $correo= $destinatarios->correo;
            
        $msje = "Estimado usuario la tasa de cambio desde  " . $nombre_pais . " a VENEZUELA se ha actualizado a <strong>" . $valor_tasa . " </strong></br>";
        $pie="Para mayor informacion ingrese a www.idsistemas15.com   9 64174727";
        
         $bancos=$this->Configuraciones_model->bancos_todos_inf();
         foreach($bancos as $banc){
             $banco=$banc->nombre_banco;
              $bancos= $banco.'<br>';
         }
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Actualizacion de tasa...!!!');
        $this->email->message($msje.'<br><br>'.$pie);
        $this->email->send();
        }
    }
    
    
    public function prueba()
    {
        
       $bancos=$this->Configuraciones_model->bancos_todos_inf();
         foreach($bancos as $banc){
             $banco=$banc->nombre_banco;
              //$bancos= $banco.'<br>';
             
             $tabla="<table border='0' align='center'>
              <tr style='background-color: #1697d1;'>
               <td><font color='white'>".$banco."</font></td>
            </tr>
            </table>";
            echo $tabla;
         }
         
    }

    public function bancos()
    {
        $arrayData = array();

        $vars['resultados'] =  $this->Configuraciones_model->bancos_todos();
        //print_r($vars);//exit;
        $this->load->view('tabla_bancos', $vars);
    }
    public function bancos_info()
    {
        $arrayData = array();

        $vars['resultados'] =  $this->Configuraciones_model->bancos_todos_inf();
        //print_r($vars);//exit;
        $this->load->view('tabla_bancos_info', $vars);
    }
    public function activar_banco($id_banco)
    {
        $this->Configuraciones_model->act_banc($id_banco);
        echo json_encode(array("status" => TRUE));
    }

    public function desactivar_banco($id_banco)
    {
        $this->Configuraciones_model->desac_banc($id_banco);
        echo json_encode(array("status" => TRUE));
    }

    public function consultar_banco_id($id)
    {
        $data = $this->Configuraciones_model->get_id($id);

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }

    public function actualizar_banco()
    {
        // Si el banco existe lo actualiza
        $id_banco = $this->input->post('id_banco');
        if ($id_banco != '') {
            $param['id_banco'] = $this->input->post('id_banco');
            $param['nombre_banco'] = strtoupper($this->input->post('nombre_banco'));

            $datos = $this->Configuraciones_model->upd_banco($param);
            $this->Configuraciones_model->eliminar_duplicados();
            echo json_encode($datos);
            // Si no existe el banco lo agrega 
        } else {
            extract($_POST);

            $arrayData = array(
                'nombre_banco' => strtoupper($nombre_banco),
            );
            
            $this->Configuraciones_model->guardar_banco($arrayData);
            $this->Configuraciones_model->eliminar_duplicados();
        }
    }
    //Funcion para eliminar registros de bancos duplicados
    public function eliminar_duplicados()
    {
        $data = $this->Configuraciones_model->eliminar_duplicados();

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    public function paises()
    {
        $arrayData = array();

        $vars['resultados'] =  $this->Configuraciones_model->paises_todos();
        //print_r($vars);exit;
        $this->load->view('tabla_paises', $vars);
    }

    public function activar_pais($id_pais)
    {
        $this->Configuraciones_model->act_pais($id_pais);
        echo json_encode(array("status" => TRUE));
    }

    public function desactivar_pais($id_pais)
    {
        $this->Configuraciones_model->desac_pais($id_pais);
        echo json_encode(array("status" => TRUE));
    }

    public function consultar_pais_id($id)
    {
        $data = $this->Configuraciones_model->get_id_pais($id);

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    public function actualizar_pais()
    {

        $id_pais = $this->input->post('id_pais');
        if ($id_pais != '') {
            $param['id_pais'] = $this->input->post('id_pais');
            $param['nombre_pais'] = strtoupper($this->input->post('nombre_pais'));

            $datos = $this->Configuraciones_model->upd_pais($param);
            $this->Configuraciones_model->eliminar_duplicados_paises();
            echo json_encode($datos);
        } else {
            extract($_POST);

            $arrayData = array(
                'nombre_pais' => strtoupper($nombre_pais),
            );
            $this->Configuraciones_model->guardar_pais($arrayData);
            $eliminar = $this->Configuraciones_model->eliminar_duplicados_paises();
        }
    }

    public function eliminar_banco($id_banco)
    {
        $this->Configuraciones_model->delete_banco($id_banco);
        echo json_encode(array("status" => TRUE));
    }

    public function eliminar_pais($id_pais)
    {
        $this->Configuraciones_model->delete_pais($id_pais);
        echo json_encode(array("status" => TRUE));
    }
    public function leerSelect()
    {
        $vars['paises'] = $this->Configuraciones_model->paises_todos_select();
        $this->load->view('salect_pais_view', $vars);
    }
    
    public function caja()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        
        $vars['resultados'] =  $this->Configuraciones_model->bancos_todos2();
        $this->load->view('caja',$vars);
    }
    
    public function lista_cajas()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        
        $arrayData = array();
        $cajas['cajas'] =  $this->Configuraciones_model->consultar_caja();
        $this->load->view('tabla_cajas',$cajas);
    }
        public function registrar_caja()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        $correo = $variablesSesion['correo'];
        
        extract($_POST);
        
        $caja_banco=$this->Configuraciones_model->consultar_banco_caja($id_banco);
        
        $arrayData = array(
            'id_banco' => $id_banco,
            'monto_apertura' => $monto_apertura,
            'id_usuario' => $id_usuario,
        );
        
        if($caja_banco==0){
            
        $this->Configuraciones_model->guardar_caja($arrayData);
        $this->Configuraciones_model->upd_caja_estatus($id_banco);
            
        }else{
            $this->Configuraciones_model->upd_caja($id_banco,$monto_apertura);
        }

         /*$msje = "Reciba un cordial saludo sr(a), ha registrado un nuevo destinatario en su directorio de cuentas del sistema.</br>
         Destinatario Registrado:" . $nombres_apellidos . "</b>";
        
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Registro de Cuenta');
        $this->email->message($msje);
        $this->email->send();*/

    }
    
     public function consultar_monto_apertura()
    {
        extract($_POST);

        $vars=$this->Configuraciones_model->consultar_monto_aper($id_banco);
              //$this->Configuraciones_model->consultar_monto_apertura($id_banco);
        echo json_encode($vars);
    }
    
    public function consultar_caja_ab()
    {
        extract($_POST);

        $vars=$this->Configuraciones_model->caja_abierta($id_banco);
        echo json_encode($vars);
    }
    
}