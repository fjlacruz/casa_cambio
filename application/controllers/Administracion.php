<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

//dsistem_javier   idsistem_casa_cambio   ZYM;5,=;q2N#    ;aKiFhoMsQzG
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    

class Administracion extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Events_model');
        $this->load->library('parser');
    }

     public function tabla() {
        $arrayData = array();

        $vars['resultados'] =  $this->Consultas_usuarios_model->usuarios_todos();
        $this->load->view('administracion/tabla', $vars);
    }

    public function usuarios() {

        $arrayData = array();
        
        $data_roles['roles'] = $this->Consultas_usuarios_model->get_roles();
        //$vars['resultados'] =  $this->Consultas_usuarios_model->usuarios_todos();
      
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/tabla_usuarios',$data_roles);
        $this->load->view('plantillas/footer');

    }

    //=========================== FUNCION PARA ACTUALIZAR EL ROL Y ESTATUS =================================================       

    public function actualizar_usuario() {

        $param['id'] = $this->input->post('id');
        $param['usuario'] = strtoupper($this->input->post('usuario_modal'));
        $param['correo'] = strtoupper($this->input->post('correo_modal'));
        $param['estatus'] = $this->input->post('estatus_modal');
        $param['rol'] = $this->input->post('rol_modal');
        $param['id_comunidad'] = $this->input->post('id_comunidad_modal');

        $datos = $this->Events_model->upd($param);
        echo json_encode($datos);
        
    }
//============== FUNCION QUE INSERTA LOS DATOS EN LA BASE DE DATOS ===============        
  public function registrar_usuario(){
 
        extract($_POST); 

         $arrayData = array(
            'nombres'=>strtoupper($nombres),
            'apellidos'=>strtoupper($apellidos),
            'correo'=>strtoupper($correo),
            'usuario'=>strtoupper($usuario),
            'clave'=>md5($clave),
            'telefono'=>$telefono,

              //'ip'=>$this->getRealIP();             
        );
       $this->Consultas_usuarios_model->usuarios_guardar($arrayData);     
     }  

//===== funcion para obtener la ip del usuario ========///
    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

    public function cambiar_a_admin($id_usuario)
	{
		$this->Events_model->cambiar_adm($id_usuario);
		echo json_encode(array("status" => TRUE));
    }

    public function cambiar_a_sol($id_usuario)
	{
		$this->Events_model->cambiar_sol($id_usuario);
		echo json_encode(array("status" => TRUE));
    }
    
    public function cambiar_usuario_adm($id_usuario)
	{
        extract($_POST);
		$this->Events_model->actualizar_tipo_usuario($id_usuario);
		//echo json_encode(array("status" => TRUE));
	}
//================== FUNCION QUE CONSULTA TODOS LOS DATOS DE LA TABLA =============
    public function usuarioModificar() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];

        $data = array(
        'id_usuario' => $id_usuario
         );
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->parser->parse('administracion/usuarioModificar',$data);
        $this->load->view('plantillas/footer');
    }
    
    


  //========== FUNCION PARA CONSULTAR DTOS DE USUARIO POR CEDULA DE LA VARIABLE DE SESION ========  
    function buscar_usuario() {
        extract($_POST);

        $cedula = $this->input->post('id_usuario');
        $data = $this->Consultas_usuarios_model->buscar_usuario($id_usuario);
        echo '{"data": ' . json_encode($data) . '}';
        
    }
    
//================== FUNCION QUE ACTUALIZA LA CONTRASE�A =============
    public function contrasenna_actualizar() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        extract($_POST);

        $this->Consultas_usuarios_model->actualizar_contrasenia2($id_usuario,md5($clave));
    }

//================== FUNCION QUE ACTUALIZA EL CORREO =============
    function actualizarUsuario() {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        extract($_POST);
       // print_r($_POST);
        //exit;

        $this->Consultas_usuarios_model->modificar_usuario_cedula($id_usuario,$correo,$usuario,$nombres,$apellidos,$telefono,$rut_pasaporte);
    }

//========== FUNCION QUE CONSULTA SI YA EXISTE UN NUMERO DE CEDULA REGISTRADO =========   
    public function consultar_usuario() {

        $cedula = $_POST['cedula'];
        if ($cedula == "") {
            exit();
        }

        $consultar_cedula = $this->Consultas_usuarios_model->existe_usuario($cedula);
        if ($consultar_cedula[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

//========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO =========   
    public function consultar_correo2() {

        $correo = $_POST['correo'];
        if ($correo == "") {
            exit();
        }

        $consultar_correo = $this->Consultas_usuarios_model->existe_correo($correo);
        if ($consultar_correo[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO PARA RECUPERAR CLAVE =========   
    public function consultar_correo_recuprar() {

        $correo = $_POST['correo_recuperar'];
        if ($correo == "") {
            exit();
        }

        $consultar_correo = $this->Consultas_usuarios_model->existe_correo_recuperar($correo);
        if ($consultar_correo[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
//========== FUNCION QUE CONSULTA SI YA EXISTE UN USUARIO REGISTRADO ===============   
    public function consultar_usuario2() {

        $usuario = $_POST['usuario'];
        if ($usuario == "") {
            exit();
        }
        $consultar_usuario = $this->Consultas_usuarios_model->existe_usuario2($usuario);
        if ($consultar_usuario[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

//=========================== FUNCION PARA ACTUALIZAR EL ROL Y ESTATUS =================================================       

 public function actualizar_estatus() {

        extract($_POST);

        $this->Consultas_usuarios_model->modificar_usuario($rol,$estatus,$id);
    }

    public function contar_usuarios()
    {
        $cantidad=$this->Consultas_usuarios_model->contar_usuarios();
       
        foreach ($cantidad as $resultado) { 
            echo $resultado->cantidad;
        }
    }


}
