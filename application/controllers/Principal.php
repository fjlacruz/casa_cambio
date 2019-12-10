<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Configuraciones_model');
        $this->load->library('Configemail');
        $this->load->library('user_agent');
    }

    public function index()
    {

        redirect('principal/inicio', 'refresh');
    }

    function inicio()
    {
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
    }

    function login()
    {
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');

        if (isset($_POST['usuario'])) {

            //Recogemos las variables 'usuario' y 'contrasena'
            $usuario = $this->input->post('usuario');
            $clave   = md5($this->input->post('clave'));

            $arrayValidar   = array();
            $arrayValidar[] = $usuario;
            $arrayValidar[] = $clave;

            // cargamos el modelo para verificar el usuario/contraseña
            // si el usuario y contraseña son correctos
            $consultarUsuario = $this->Consultas_usuarios_model->consultar_usuario($usuario, $clave);

            if ($consultarUsuario == "") {
                $consultarUsuario[0] = "";
            }

            if (isset($consultarUsuario[0])) {
                //Creamos las variables de Sesión
                $datasession = array(
                    'nombres' => $consultarUsuario[0]->nombres,
                    'apellidos' => $consultarUsuario[0]->apellidos,
                    'rol' => $consultarUsuario[0]->rol,
                    'id_usuario' => $consultarUsuario[0]->id_usuario,
                    'usuario' => $consultarUsuario[0]->usuario,
                    'correo' => $consultarUsuario[0]->correo,
                    'telefono' => $consultarUsuario[0]->telefono
                );

                $this->session->set_userdata('usuario', $datasession);
                $variablesSesion = $this->session->userdata('usuario');
                //print_r($variablesSesion);
                echo json_encode($variablesSesion);
                exit;
                //redirect('principal/bienvenida2', 'refresh');
            } else {
                echo 0;
                exit;
            }
        } else {
            echo 0;
            exit;
        }
    }

    // MENSAJE QUE APARECE CUANDO SE CIERRA EL SISTEMA POR INACTIVIDAD
    function session()
    {

        $this->session->set_flashdata('info', '<div class="alert alert-info alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-info"></i> <strong>Informacion! </strong>Sesion Cerrada por Inactividad....!!!</div>');
        redirect('principal/inicio', 'refresh');
    }

    // PAGINA CUANDO INICIAMOS SESION
    function dashboard()
    {
        $arrayData = array();

        $vars['paises'] =  $this->Configuraciones_model->paises_todos();
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('dashboard', $vars);
        $this->load->view('plantillas/footer');
    }

    //FUNCION PARA EL REGISTRO DE USUARIOS
    public function registrar_usuario()
    {

        extract($_POST);

        $arrayData = array(
            'nombres' => strtoupper($nombres),
            'apellidos' => strtoupper($apellidos),
            'correo' => strtoupper($correo),
            'usuario' => strtoupper($usuario_registro),
            'clave' => md5($clave),
            'telefono' => $telefono,
            'rut_pasaporte' => $rut_pasaporte

            //'ip'=>$this->getRealIP();             
        );
        $this->Consultas_usuarios_model->usuarios_guardar($arrayData);
        
        $msje = "Bienvenido(a) " . $nombres . " se ha registrado exitosamente en la plataforma de idsistemas15.com para cambios en linea.</br>
         Para ingresar a palicacion dirijase a idsistemas15.com  9 64174727</b>";
        
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Registro de Usuario');
        $this->email->message($msje);
        $this->email->send();
    }

    // Función logout. Elimina las variables de sesión y redirige al controlador principal

    function logout()
    {
        $this->session->sess_destroy();
        redirect('principal/inicio', 'refresh');
    }

    ///CLAVES DE USUARIO recibe el tama�o de la clave
    function generarClaveAleatoria($tamanio)
    {
        $chars        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength  = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $tamanio; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }

    // CONSULTAMOS SI EXISTE EL CORREO 
    function consultar_correo()
    {
        extract($_POST);

        $consultarUsuario = $this->Consultas_usuarios_model->existe_correo($correo);

        if ($consultarUsuario[0] != '0') {
            echo 1;
        } else {
            echo 2;
        }
    }

    // ENVIAMOS LA CONTRASEÑA ALEATORIA, AL CORREO REGISTRADO
    function recuperarClave()
    {
        extract($_POST);
       

        $claveNueva = $this->generarClaveAleatoria(8);
        print_r($claveNueva);
        $correo = $this->input->post('correo_recuperar');
        $clave  = md5($claveNueva);

        $this->Consultas_usuarios_model->actualizar_contrasenia($correo, $clave);

        $msje = "Reciba un cordial saludo sr(a)  ud, a solicitado sus datos de acceso al sistema. 
    A continuacion los <b>datos de ingreso</b>: <br>

    Clave: <b>" . $claveNueva . "</b>";

        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Recuperación de Contraseña');
        $this->email->message($msje);
        $this->email->message($msje);
        $this->email->send();
    }
}
