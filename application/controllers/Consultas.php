<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultas extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Events_model');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Pgsql');
    }
    
    //================ FUNCION QUE CONSULTA SI YA EXISTE UN USUARIO REGISTRADO ===============//   
    public function existe_usuario()
    {
        
        $usuario = $_POST['usuario'];
        if ($usuario == "") {
            exit();
        }
        $consultar_usuario = $this->Consultas_usuarios_model->existe_usuario2($usuario);
        if ($consultar_usuario[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN NRO DE CEDULA REGISTRADO ===============   
    public function existe_cedula()
    {
        
        $cedula = $_POST['cedula'];
        if ($cedula == "") {
            exit();
        }
        
        $consultar_cedula = $this->Consultas_usuarios_model->existe_usuario($cedula);
        if ($consultar_cedula[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    //============ CARGAMOS TODOS LOS DATOS DEL USUARIO POR EL ID -TABLA  T_USUARIOS ========//
    public function consultar_usuario_id($id)
    {
        $data = $this->Events_model->get_id($id);
        
        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    
    
    
    //========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO =========   
    public function existe_correo()
    {
        
        $correo = $_POST['correo'];
        if ($correo == "") {
            exit();
        }
        
        $consultar_correo = $this->Consultas_usuarios_model->existe_correo($correo);
        if ($consultar_correo[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    //CONSULTAMOS LA CLAVE ANTERIOS PARA CUANDO SE VAYA A MODIFICAR
    function consultar_clave_anterior()
    {
        extract($_POST);
        
        $arrayData    = array();
        $arrayData[0] = $clave_anterior;
        $arrayData[1] = mb_strtoupper($cedula2, 'UTF-8');
        
        $arrayData = $this->security->xss_clean($arrayData); //Para evitar la inyeccion de codogo sql malicioso
        $clave     = $this->Pgsql->SELECTPLSQL('existe_clave', $arrayData);
        
        if ($clave[0][0] == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    // CARGAMOS TODOS LOS DATOS DEL USUARIO -TABLA  T_USUARIOS
    function consultar_usuario_cedula()
    {
        extract($_POST);
        
        $arrayData   = array();
        $arrayData[] = $cedula;
        
        $consultaPersona    = $this->Pgsql->SELECTPLSQL('consultar_usuario_cedula', $arrayData);
        $data['id_usuario'] = $consultaPersona[0][0];
        $data['cedula']     = $consultaPersona[0][1];
        $data['nombres']    = $consultaPersona[0][2];
        $data['apellidos']  = $consultaPersona[0][3];
        $data['correo']     = $consultaPersona[0][4];
        $data['usuario']    = $consultaPersona[0][5];
        $data['estatus']    = $consultaPersona[0][6];
        $data['rol']        = $consultaPersona[0][7];
        echo json_encode(array(
            'data' => $data
        ));
    }
    
    //========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO =========   
    
    function existe_correo_cedula()
    {
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        if ($correo == "") {
            exit();
        }
        $arrayData        = array();
        $arrayData[0]     = $cedula;
        $arrayData[1]     = mb_strtoupper($correo, 'UTF-8');
        $consultar_correo = $this->Pgsql->SELECTPLSQL('existe_correo_cedula', $arrayData);
        if ($consultar_correo[0][0] != 0) {
            echo 0;
        } else {
            $arrayData        = array();
            $arrayData[0]     = mb_strtoupper($correo, 'UTF-8');
            $consultar_correo = $this->Pgsql->SELECTPLSQL('existe_correo', $arrayData);
            if ($consultar_correo[0][0] != 0) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    
    //========== FUNCION QUE CONSULTA SI EXISTE UNA CUENTA DE CORREO ASOCIADA A UN USUARIO =========   
    
    function existe_usuario_cedula()
    {
        $cedula  = $_POST['cedula'];
        $usuario = $_POST['usuario'];
        if ($usuario == "") {
            exit();
        }
        $arrayData        = array();
        $arrayData[0]     = $cedula;
        $arrayData[1]     = mb_strtoupper($usuario, 'UTF-8');
        $consultar_correo = $this->Pgsql->SELECTPLSQL('existe_usuario_cedula', $arrayData);
        if ($consultar_correo[0][0] != 0) {
            echo 0;
        } else {
            $arrayData        = array();
            $arrayData[0]     = mb_strtoupper($usuario, 'UTF-8');
            $consultar_correo = $this->Pgsql->SELECTPLSQL('existe_usuario', $arrayData);
            if ($consultar_correo[0][0] != 0) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    
}