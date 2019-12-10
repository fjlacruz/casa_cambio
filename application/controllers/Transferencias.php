<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transferencias extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Transferencias_model');
        $this->load->library('Configemail');
    }

    public function inicio()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        $rol = $variablesSesion['rol'];

        $bancos['bancos'] =  $this->Transferencias_model->bancos_todos();
        $paises['paises'] =  $this->Transferencias_model->paises_todos();
    
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        if($rol==1){
            $this->load->view('transferencias_adm',$bancos+$paises);
        }else{
            $this->load->view('transferencias',$bancos+$paises);
        }
        
        $this->load->view('plantillas/footer');
    }

    public function tasas()
    {
        $tasas['tasas'] =    $this->Transferencias_model->tasas();
        $this->load->view('info_tasas',$tasas);
    }

    public function cuentas()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        $arrayData = array();
        $cuentas['cuentas'] =  $this->Transferencias_model->mis_cuentas($id_usuario);
        $this->load->view('tabla_cuentas',$cuentas);
    }
    public function solicitudes()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        
        $arrayData = array();
        $solicitudes['solicitudes'] =  $this->Transferencias_model->mis_solicitudes($id_usuario);
        //print_r($solicitudes);exit();
        $this->load->view('tabla_solicitudes',$solicitudes);
    }

    public function solicitudes_adm()
    {
        $arrayData = array();
        $solicitudes['solicitudes'] =  $this->Transferencias_model->lista_solicitudes();
        //print_r($solicitudes);exit();
        $this->load->view('tabla_solicitudes_adm',$solicitudes);
    }
    public function pagoEfectivo()
    {
        $arrayData = array();
        $paises['paises'] =  $this->Transferencias_model->paises_todos();
       
       $this->load->view('plantillas/administracion/header');
       $this->load->view('plantillas/menu');
       $this->load->view('pagos_efectivo',$paises);
    }

    public function consultarCuentas_efectivo()
    {
        $arrayData = array();
        extract($_POST);
       
        $pagosEfevtivo['pagosEfevtivo'] = $this->Transferencias_model->lista_cuentas_pago_efectivo($rut_pasaporte);
        //print_r($pagosEfevtivo);exit();
        $this->load->view('tabla_pagos_efectivo',$pagosEfevtivo);
    }

    public function rechazadas()
    {
        $arrayData = array();
       
       $this->load->view('plantillas/administracion/header');
       $this->load->view('plantillas/menu');
       $this->load->view('transferencias_rechazadas');
    }

    public function historico()
    {
        $arrayData = array();
       
       $this->load->view('plantillas/administracion/header');
       $this->load->view('plantillas/menu');
       $this->load->view('transferencias_historico');
    }

    public function estadisticas_historico()
    {
        $arrayData = array();
        extract($_POST);
       
        $solicitudes['solicitudes'] =  $this->Transferencias_model->lista_solicitudes_historico($anio,$mes);
        //print_r($solicitudes);exit();
        $this->load->view('tabla_solicitudes_historico',$solicitudes);
    }

    public function transferenciasRechazadas()
    {
        $arrayData = array();
        extract($_POST);
       
        $solicitudes['solicitudes'] =  $this->Transferencias_model->lista_solicitudes_rechazadas();
        //print_r($solicitudes);exit();
        $this->load->view('tabla_solicitudes_rechazadas',$solicitudes);
    }

    public function monto_historico()
    {
        $arrayData = array();
        extract($_POST);

        $monto=$this->Transferencias_model->monto_solicitudes_historico($anio,$mes);
       
        foreach ($monto as $resultado) { 
            echo $resultado->monto_total;
        }

    }

    public function consultar_cuenta_id($id)
    {
        $data = $this->Transferencias_model->get_id_cuenta($id);

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    public function actualizar_cuenta()
    {
            $param['id_cuenta'] = $this->input->post('id_cuenta');
            $param['id_banco_edit'] = strtoupper($this->input->post('id_banco_edit'));
            $param['tipo_cuenta_edit'] = strtoupper($this->input->post('tipo_cuenta_edit'));
            $param['identificacion_edit'] = strtoupper($this->input->post('identificacion_edit'));
            $param['cedula_titular_edit'] = strtoupper($this->input->post('cedula_titular_edit'));
            $param['nombres_apellidos_edit'] = strtoupper($this->input->post('nombres_apellidos_edit'));
            $param['email_edit'] = strtoupper($this->input->post('email_edit'));
            $param['nro_cuenta_edit'] = strtoupper($this->input->post('nro_cuenta_edit'));

            $datos = $this->Transferencias_model->upd_cuenta($param);
            echo json_encode($datos);
            // Si no existe el banco lo agrega 
    }

    public function eliminar_cuenta()
    {
        extract($_POST);
        $id_cuenta = $this->input->post('id_cuenta');
        $this->Transferencias_model->delete_cuenta($id_cuenta);
        echo json_encode(array("status" => TRUE));
    }


    public function paises()
    {
        $arrayData = array();
        $vars['resultados'] =  $this->Configuraciones_model->paises_todos();
        $this->load->view('tabla_paises', $vars);
    }

    public function registrar_cuenta()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        $correo = $variablesSesion['correo'];
        
        extract($_POST);

        $arrayData = array(
            'id_banco' => $id_banco,
            'tipo_cuenta' => strtoupper($tipo_cuenta),
            'nro_cuenta' => $nro_cuenta,
            'identificacion' => strtoupper($identificacion),
            'cedula_titular' => $cedula_titular,
            'nombres_apellidos' => strtoupper($nombres_apellidos),
            'email' => strtoupper($email),
            'id_usuario' => $id_usuario,
        );
        $this->Transferencias_model->guardar_cuenta($arrayData);
        
         $msje = "Reciba un cordial saludo sr(a), ha registrado un nuevo destinatario en su directorio de cuentas del sistema.</br>
         Destinatario Registrado:" . $nombres_apellidos . "</b>";
        
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Registro de Cuenta');
        $this->email->message($msje);
        $this->email->send();

    }
    public function registrar_solicitud()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = $variablesSesion['id_usuario'];
        $correo = $variablesSesion['correo'];
        extract($_POST);
        extract($_FILES);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);

        $arrayData = array(
            'id_cuenta' => $cuenta_id,
            'id_usuario' => $id_usuario,
            'id_pais' => $pais,
            'monto_pesos' => $monto,
            'tasa' => $valor,
            'monto_a_transferir' => $monto_a_transferir,
            'adjunto' => $adjunto,  
            'id_banco' => $banco_id,
            'tipo_operacion' => $tipo_operacion,
        );
        //insertamos los datos de la solicitud
        $this->Transferencias_model->guardar_solicitud($arrayData);
        
        
        // consultamos el ultimo id  para obtener el numero actual de referencia de la transferencia
        $max_id=$this->Transferencias_model->ultimo_id($id_usuario);
        foreach ($max_id as $resultado) { 
            $id= $resultado->id_ultimo;
        }
        //consultamos los datos de la cuanta a la que se le hace la solicitud de la transferencia
        $info_cuenta=$this->Transferencias_model->mis_cuentas_email($cuenta_id);
        foreach ($info_cuenta as $info) { 
            $nombres_apellidos= $info->nombres_apellidos;
            $identificacion= $info->identificacion;
            $cedula_titular= $info->cedula_titular;
            $nro_cuenta= $info->nro_cuenta;
            $tipo_cuenta= $info->tipo_cuenta;
            $nombre_banco= $info->nombre_banco;
            $fecha_registro= $info->fecha_registro;
        }
        
     
        $msje = "Reciba un cordial saludo sr(a), ha registrado una solicitud de transferencia por un 
        monto de: " . number_format($monto_a_transferir, 2, ',', '.') . " Bs</br> Nro de Referencia Reft-".$id." ";
        $tabla="<table border='0' align='center'>
              <tr style='background-color: #1697d1;'>
               <td colspan='2' align='center'><font color='white'>Datos Recibidos</font></td>
            
            </tr>
            <tr>
               <td>Destinatario</td>
               <td>".$nombres_apellidos."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
                <td>Cedula/Rif</td>
                <td>".$identificacion."-".$cedula_titular."</td>
            </tr>
            <tr>
               <td>Banco</td>
               <td>".$nombre_banco."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Nro Cuenta</td>
               <td>".$nro_cuenta."</td>
            </tr>
            <tr>
               <td>Tipo Cuenta</td>
                <td>".$tipo_cuenta."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Monto Transferido:</td>
                <td>".number_format($monto, 2, ',', '.')."</td>
            </tr>
            <tr>
              <td>Monto a Transferir (Bs):</td>
              <td>".number_format($monto_a_transferir, 2, ',', '.')."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Fecha:</td>
                <td>".$fecha_registro."</td>
            </tr>
            </table>";
         
        $pie="Para mayor informacion ingresa a: idsistemas15.com   9 6417 7427";
            
        // configuracion del envio de email de solicitud
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Solicitud de Transferencia');
        $this->email->message($msje.'<br><br>'.$tabla.'<br><br>'.$pie);
        $this->email->send();
        
    }


    public function registrar_solicitud_efectivo()
    {
        //$variablesSesion = $this->session->userdata('usuario');
        //$id_usuario = $variablesSesion['id_usuario'];
        $correo = $variablesSesion['correo'];
        extract($_POST);
        extract($_FILES);
        
        //$dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        //$adjunto     = base64_encode($dataAdjunto);

        $arrayData = array(
            'id_cuenta' => $cuenta_id,
            'id_usuario' => $id_usuario,
            'id_pais' => $pais,
            'monto_pesos' => $monto,
            'tasa' => $valor,
            'monto_a_transferir' => $monto_a_transferir,
            //'adjunto' => NULL,  
            'id_banco' => $banco_id,
            'tipo_operacion' => $tipo_operacion,
         
        );
        //insertamos los datos de la solicitud
        $this->Transferencias_model->guardar_solicitud_efectivo($arrayData);
        
        
        // consultamos el ultimo id  para obtener el numero actual de referencia de la transferencia
        $max_id=$this->Transferencias_model->ultimo_id($id_usuario);
        foreach ($max_id as $resultado) { 
            $id= $resultado->id_ultimo;
        }
        //consultamos los datos de la cuanta a la que se le hace la solicitud de la transferencia
        $info_cuenta=$this->Transferencias_model->mis_cuentas_email($cuenta_id);
        foreach ($info_cuenta as $info) { 
            $nombres_apellidos= $info->nombres_apellidos;
            $identificacion= $info->identificacion;
            $cedula_titular= $info->cedula_titular;
            $nro_cuenta= $info->nro_cuenta;
            $tipo_cuenta= $info->tipo_cuenta;
            $nombre_banco= $info->nombre_banco;
            $fecha_registro= $info->fecha_registro;
        }
        
     
        $msje = "Reciba un cordial saludo sr(a), ha registrado una solicitud de transferencia por un 
        monto de: " . number_format($monto_a_transferir, 2, ',', '.') . " Bs</br> Nro de Referencia Reft-".$id." ";
        $tabla="<table border='0' align='center'>
              <tr style='background-color: #1697d1;'>
               <td colspan='2' align='center'><font color='white'>Datos Recibidos</font></td>
            
            </tr>
            <tr>
               <td>Destinatario</td>
               <td>".$nombres_apellidos."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
                <td>Cedula/Rif</td>
                <td>".$identificacion."-".$cedula_titular."</td>
            </tr>
            <tr>
               <td>Banco</td>
               <td>".$nombre_banco."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Nro Cuenta</td>
               <td>".$nro_cuenta."</td>
            </tr>
            <tr>
               <td>Tipo Cuenta</td>
                <td>".$tipo_cuenta."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Monto Transferido:</td>
                <td>".number_format($monto, 2, ',', '.')."</td>
            </tr>
            <tr>
              <td>Monto a Transferir (Bs):</td>
              <td>".number_format($monto_a_transferir, 2, ',', '.')."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Fecha:</td>
                <td>".$fecha_registro."</td>
            </tr>
            </table>";
         
        $pie="Para mayor informacion ingresa a: idsistemas15.com   9 6417 7427";
            
        // configuracion del envio de email de solicitud
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Solicitud de Transferencia');
        $this->email->message($msje.'<br><br>'.$tabla.'<br><br>'.$pie);
        $this->email->send();
        
    }

    public function verAdjunto($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->getAdjunto($id_transferencia);
        if($adjunto ){
         $adjuntoId['transferencia_id'] = $this->Transferencias_model->getAdjuntoId($id_transferencia);
        $datos['datos'] = '<img class="img-responsive" width="600" height="800" src="data:image/pdf;base64,' . $adjunto . '"/>';

        file_put_contents('adjuntos.jpg', $adjunto);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('transferencias_adjunto', $datos + $adjuntoId);
        }else{
            echo '<br>';
            echo '<div class="alert alert-info">
                 <strong>Info!</strong> El pago se realizo en efectivo.
              </div>';
            exit;
        }
        

        
        
    }
    public function verAdjunto_historico($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->getAdjunto_historico($id_transferencia);
        $adjuntoId['transferencia_id'] = $this->Transferencias_model->getAdjuntoId($id_transferencia);
        $datos['datos'] = '<img class="img-responsive" width="600" height="800" src="data:image/pdf;base64,' . $adjunto . '"/>';

        
        file_put_contents('adjuntos.jpg', $adjunto);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('transferencias_adjunto', $datos + $adjuntoId);
    }

    public function verDetatlle_Solicitud($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->detalle_solicitud($id_transferencia);
        echo json_encode($adjunto); exit;
    }

    public function verDetatlle_Solicitud_historico($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->detalle_solicitud_historico($id_transferencia);
        echo json_encode($adjunto); exit;
    }

    public function verDetatlle_Solicitud_rechazada($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->detalle_solicitud_rechazada($id_transferencia);
        echo json_encode($adjunto); exit;
    }

    
    public function verAdjunto_respuesta($id_transferencia)
    {
       extract($_GET);
    
        $adjunto = $this->Transferencias_model->getAdjunto_resp($id_transferencia);
        $datos['datos'] = '<img class="img-responsive" width="600" height="800" src="data:image/pdf;base64,' . $adjunto . '"/>';
    
        file_put_contents('adjuntos.jpg', $adjunto);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('transferencias_adjunto', $datos);
    }


    public function procesar_solicitud()
    {
        extract($_POST);
        extract($_FILES);

        $dataAdjunto = file_get_contents($_FILES['adjunto_resp']['tmp_name']);
        $adjunto_resp     = base64_encode($dataAdjunto);

        $id_transferencia = $this->input->post('id_transferencia');
        $id_banco = $this->input->post('id_banco');
        $monto_a_transferir = $this->input->post('monto_a_transferir');
        
        $this->Transferencias_model->procesar_solicitud($id_transferencia,$adjunto_resp);
        
        //Actualizamos el saldo en caja
        $this->Transferencias_model->actualizar_caja($id_banco,$monto_a_transferir);
        
        $info_transferencia=$this->Transferencias_model->mis_solicitudes_email($id_transferencia);
        foreach ($info_transferencia as $info) { 
            $nombres_apellidos= $info->nombres_apellidos;
            $identificacion= $info->identificacion;
            $cedula_titular= $info->cedula_titular;
            $nro_cuenta= $info->nro_cuenta;
            $tipo_cuenta= $info->tipo_cuenta;
            $nombre_banco= $info->nombre_banco;
            $fecha_registro= $info->fecha_registro;
            $monto_pesos= $info->monto_pesos;
            $monto_a_transferir= $info->monto_a_transferir;
            $correo= $info->correo;
        }
        
        $tabla="<table border='0' align='center'>
              <tr style='background-color: #1697d1;'>
               <td colspan='2' align='center'><font color='white'>Datos Recibidos</font></td>
            
            </tr>
            <tr>
               <td>Destinatario</td>
               <td>".$nombres_apellidos."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
                <td>Cedula/Rif</td>
                <td>".$identificacion."-".$cedula_titular."</td>
            </tr>
            <tr>
               <td>Banco</td>
               <td>".$nombre_banco."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Nro Cuenta</td>
               <td>".$nro_cuenta."</td>
            </tr>
            <tr>
               <td>Tipo Cuenta</td>
                <td>".$tipo_cuenta."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Monto Transferido:</td>
                <td>".number_format($monto_pesos, 2, ',', '.')."</td>
            </tr>
            <tr>
              <td>Monto Transferido (Bs):</td>
              <td>".number_format($monto_a_transferir, 2, ',', '.')."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Fecha:</td>
                <td>".$fecha_registro."</td>
            </tr>
            </table>";
        
        $msj="Estimado Usuario la solicitud Nro Reft-".$id_transferencia." fue procesada con exito";
        $pie="Para mayor informacion ingresa a: idsistemas15.com   9 6417 7427";
            
        // configuracion del envio de email de solicitud
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Transferencia Exitosa...!!!');
        $this->email->message($msj.'<br><br>'.$tabla.'<br><br>'.$pie);
        $this->email->send();
    }

    public function contar_solicitudes_pendientes()
    {
        $cantidad=$this->Transferencias_model->contar_solicitudes_pendientes();
       
        foreach ($cantidad as $resultado) { 
            echo $resultado->cantidad;
        }
    }

    public function contar_solicitudes_historico()
    { 
        extract($_POST);
        $cantidad_sol=$this->Transferencias_model->contar_solicitudes_historico($anio,$mes);
       
        foreach ($cantidad_sol as $resultado) { 
            echo $resultado->cantidad_solicitudes;
        }
    }

    public function cancelar_solicitud_error()
    {
        extract($_POST);

        $id_transferencia = $this->input->post('id_transferencia');
        
        $this->Transferencias_model->cancelar_solicitud($id_transferencia);
        
         $info_transferencia=$this->Transferencias_model->mis_solicitudes_email($id_transferencia);
        foreach ($info_transferencia as $info) { 
            $nombres_apellidos= $info->nombres_apellidos;
            $identificacion= $info->identificacion;
            $cedula_titular= $info->cedula_titular;
            $nro_cuenta= $info->nro_cuenta;
            $tipo_cuenta= $info->tipo_cuenta;
            $nombre_banco= $info->nombre_banco;
            $fecha_registro= $info->fecha_registro;
            $monto_pesos= $info->monto_pesos;
            $monto_a_transferir= $info->monto_a_transferir;
            $correo= $info->correo;
        }
        
        $tabla="<table border='0' align='center'>
              <tr style='background-color: #1697d1;'>
               <td colspan='2' align='center'><font color='white'>Datos Recibidos</font></td>
            
            </tr>
            <tr>
               <td>Destinatario</td>
               <td>".$nombres_apellidos."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
                <td>Cedula/Rif</td>
                <td>".$identificacion."-".$cedula_titular."</td>
            </tr>
            <tr>
               <td>Banco</td>
               <td>".$nombre_banco."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Nro Cuenta</td>
               <td>".$nro_cuenta."</td>
            </tr>
            <tr>
               <td>Tipo Cuenta</td>
                <td>".$tipo_cuenta."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Monto Transferido:</td>
                <td>".number_format($monto_pesos, 2, ',', '.')."</td>
            </tr>
            <tr>
              <td>Monto Transferido (Bs):</td>
              <td>".number_format($monto_a_transferir, 2, ',', '.')."</td>
            </tr>
            <tr style='background-color: #eaedf0;'>
               <td>Fecha:</td>
                <td>".$fecha_registro."</td>
            </tr>
            </table>";
        
        $msj="Estimado Usuario la solicitud Nro Reft-".$id_transferencia." fue cancelada debido a un error...!!!";
        $pie="Para mayor informacion ingresa a: idsistemas15.com   9 6417 7427";
            
        // configuracion del envio de email de solicitud
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Transferencia Cancelada...!!!');
        $this->email->message($msj.'<br><br>'.$tabla.'<br><br>'.$pie);
        $this->email->send();
        
    }

    
}