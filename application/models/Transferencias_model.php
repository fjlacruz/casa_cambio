<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transferencias_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function bancos_todos()
    {
        $query = $this->db->query("SELECT DISTINCT nombre_banco,fecha_registro,estatus,id_banco from n_bancos where estatus=1
                                   group by nombre_banco
                                   order by nombre_banco ASC");
        return $query->result();
    }

    public function mis_cuentas($id_usuario)
    {
        $query = $this->db->query("SELECT t.id_cuenta,t.id_banco,b.nombre_banco,t.tipo_cuenta,t.nro_cuenta,t.cedula_titular,t.nombres_apellidos,
                                           t.email, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 'RECIBIDO' 
                                           when t.estatus=3 then 'PROCESADO' else 'CANCELADO' end estatus,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro
                                           from t_cuentas t 
                                           left join n_bancos b on (t.id_banco=b.id_banco)
                                           where id_usuario={$id_usuario} order by nombres_apellidos asc");
        return $query->result();
    }
    
     public function mis_cuentas_email($cuenta_id)
    {
        $query = $this->db->query("SELECT t.id_cuenta,t.id_banco,b.nombre_banco,t.tipo_cuenta,t.nro_cuenta,t.identificacion,t.cedula_titular,t.nombres_apellidos,
                                           t.email, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 'RECIBIDO' 
                                           when t.estatus=3 then 'PROCESADO' else 'CANCELADO' end estatus,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro
                                           from t_cuentas t 
                                           left join n_bancos b on (t.id_banco=b.id_banco)
                                           where id_cuenta={$cuenta_id} order by nombres_apellidos asc");
        return $query->result();
    }

    public function mis_solicitudes($id_usuario)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,u.nombres, u.apellidos,t.id_pais,p.nombre_pais,t.monto_pesos,t.tasa,
        t.monto_a_transferir, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 
        'PROCESADO'  else 'CANCELADO' end estatus,
        DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,t.adjunto,c.nombres_apellidos,adjunto_resp,b.nombre_banco,t.tipo_operacion
        from t_transferencias t
        left join t_usuarios u on (t.id_usuario= u.id_usuario)
        left join n_pais p on (t.id_pais=p.id_pais)
        left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
        left join n_bancos b on (b.id_banco=c.id_banco)
        where t.id_usuario={$id_usuario}
        order by id_transferencia desc");
        return $query->result();
    }
    
    
    public function mis_solicitudes_email($id_transferencia)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,u.nombres, u.apellidos,t.id_pais,p.nombre_pais,t.monto_pesos,t.tasa,
        t.monto_a_transferir, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 
        'PROCESADO'  else 'CANCELADO' end estatus,
        DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,t.adjunto,c.nombres_apellidos,adjunto_resp,c.identificacion,c.cedula_titular,c.nro_cuenta,
        c.tipo_cuenta,b.nombre_banco,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,c.email,u.correo
        from t_transferencias t
        left join t_usuarios u on (t.id_usuario= u.id_usuario)
        left join n_pais p on (t.id_pais=p.id_pais)
        left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
        left join n_bancos b on (b.id_banco=c.id_banco)
        where t.id_transferencia={$id_transferencia}
        order by id_transferencia desc");
        return $query->result();
    }


    public function lista_solicitudes()
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,u.nombres, u.apellidos,t.id_pais,p.nombre_pais,t.monto_pesos,t.tasa,
        t.monto_a_transferir, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 
        'PROCESADO'  else 'CANCELADO' end estatus,
        DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,t.adjunto,c.nombres_apellidos,adjunto_resp,c.id_banco, b.nombre_banco
        from t_transferencias t
        left join t_usuarios u on (t.id_usuario= u.id_usuario)
        left join n_pais p on (t.id_pais=p.id_pais)
        left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
        left join n_bancos b on (b.id_banco=c.id_banco)
        where t.estatus=1
        order by id_transferencia desc");
        return $query->result();
    }

    public function lista_solicitudes_historico($anio, $mes)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,u.nombres, u.apellidos,t.id_pais,p.nombre_pais,t.monto_pesos,t.tasa,
        t.monto_a_transferir, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 
        'PROCESADO'  else 'CANCELADO' end estatus,
        DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,t.adjunto,c.nombres_apellidos,adjunto_resp,b.nombre_banco
        from t_transferencias t
        left join t_usuarios u on (t.id_usuario= u.id_usuario)
        left join n_pais p on (t.id_pais=p.id_pais)
        left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
        left join n_bancos b on (c.id_banco=b.id_banco)
        where t.estatus in (2,3) and  EXTRACT(month FROM t.fecha_registro)={$mes} and EXTRACT(year FROM t.fecha_registro)={$anio}
        order by id_transferencia desc");
        return $query->result();
    }

    public function lista_solicitudes_rechazadas()
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,u.nombres, u.apellidos,t.id_pais,p.nombre_pais,t.monto_pesos,t.tasa,
        t.monto_a_transferir, case when t.estatus=1 then 'ENVIADO' when  t.estatus=2 then 
        'PROCESADO'  else 'CANCELADO' end estatus,
        DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,t.adjunto,c.nombres_apellidos,adjunto_resp,b.nombre_banco
        from t_transferencias t
        left join t_usuarios u on (t.id_usuario= u.id_usuario)
        left join n_pais p on (t.id_pais=p.id_pais)
        left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
        left join n_bancos b on (c.id_banco=b.id_banco)
        where t.estatus in (3) 
        order by id_transferencia desc");
        return $query->result();
    }

     public function lista_cuentas_pago_efectivo($rut_pasaporte)
    {
        $query = $this->db->query("SELECT u.id_usuario,c.cedula_titular,c.nro_cuenta, c.email,c.identificacion,c.estatus,
                                   c.nombres_apellidos, c.tipo_cuenta, c.id_banco, b.nombre_banco,c.id_cuenta

                                    from t_usuarios u 
                                    left join t_cuentas c on (u.id_usuario=c.id_usuario)
                                    left join n_bancos b on (c.id_banco=b.id_banco)

                                     where rut_pasaporte='{$rut_pasaporte}'");
        return $query->result();
    }



    public function monto_solicitudes_historico($anio,$mes)
    {
        $query = $this->db->query("SELECT SUM(monto_a_transferir) as monto_total
                                   from t_transferencias 
                                    where estatus=2 and  EXTRACT(month FROM fecha_registro)={$mes} and EXTRACT(year FROM fecha_registro)={$anio}");
        return $query->result();
    }

    public function tasas()
    {
        $query = $this->db->query("SELECT t.id_tasa, t.id_pais,t.valor,p.nombre_pais
                                    from t_tasa t
                                    left join n_pais p on (t.id_pais=p.id_pais)
                                    where estatus=1
                                   order by nombre_pais ASC");
        return $query->result();
    }

    public function get_id_cuenta($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->query("SELECT t.id_cuenta,t.id_banco,b.nombre_banco,t.tipo_cuenta,t.nro_cuenta,t.identificacion,
            t.cedula_titular,t.nombres_apellidos,t.email,  t.estatus,t.fecha_registro,t.id_usuario
            from t_cuentas t 
            left join n_bancos b on (t.id_banco=b.id_banco)
            where id_cuenta={$id}");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }
    public function upd_cuenta($param)
    {
        $campos = array(
            'id_cuenta' => $param['id_cuenta'],
            'id_banco' => $param['id_banco_edit'],
            'tipo_cuenta' => $param['tipo_cuenta_edit'],
            'identificacion' => $param['identificacion_edit'],
            'cedula_titular' => $param['cedula_titular_edit'],
            'nombres_apellidos' => $param['nombres_apellidos_edit'],
            'email' => $param['email_edit'],
            'nro_cuenta' => $param['nro_cuenta_edit'],
        );

        $this->db->where('id_cuenta', $param['id_cuenta']);
        $this->db->update('t_cuentas', $campos);


        $query = $this->db->query("select * from t_cuentas");

        return $query->result();
    }
    public function delete_cuenta($id_cuenta)
    {
        $this->db->where('id_cuenta', $id_cuenta);

        $this->db->delete('t_cuentas');
    }
    public function guardar_cuenta($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO t_cuentas  (id_banco,tipo_cuenta,nro_cuenta,identificacion,cedula_titular,nombres_apellidos,email,id_usuario)
                              VALUES  ({$id_banco},'{$tipo_cuenta}','{$nro_cuenta}','{$identificacion}','{$cedula_titular}','{$nombres_apellidos}','{$email}',{$id_usuario})";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function paises_todos()
    {
        $query = $this->db->query("SELECT id_pais,UPPER(nombre_pais)as nombre_pais ,fecha_registro,estatus
                                   from n_pais
                                   where estatus=1
                                   order by nombre_pais ASC");
        return $query->result();
    }

    public function guardar_solicitud($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO t_transferencias  (id_cuenta,id_usuario,id_pais,monto_pesos,    tasa,monto_a_transferir,adjunto, tipo_operacion)
                              VALUES  ({$id_cuenta},'{$id_usuario}','{$id_pais}','{$monto_pesos}','{$tasa}','{$monto_a_transferir}','{$adjunto}','{$tipo_operacion}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function guardar_solicitud_efectivo($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO t_transferencias  
        (id_cuenta,id_usuario,id_pais,monto_pesos,tasa,monto_a_transferir, tipo_operacion)
        VALUES  
        ({$id_cuenta},'{$id_usuario}','{$id_pais}','{$monto_pesos}','{$tasa}','{$monto_a_transferir}','{$tipo_operacion}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }



    public function getAdjunto($id_transferencia)
    {

        $query = $this->db->query("SELECT adjunto from t_transferencias
                                   where estatus in (1,3) and id_transferencia=$id_transferencia");

        foreach ($query->result() as $row) {
            $x = $row->adjunto;
        }
        return $x;
    }

    public function getAdjunto_historico($id_transferencia)
    {

        $query = $this->db->query("SELECT adjunto from t_transferencias
                                   where estatus in (2,3) and id_transferencia=$id_transferencia");

        foreach ($query->result() as $row) {
            $x = $row->adjunto;
        }
        return $x;
    }


    public function getAdjunto_resp($id_transferencia)
    {
        $query = $this->db->query("SELECT adjunto_resp from t_transferencias
        where estatus in (2,3) and id_transferencia=$id_transferencia");

        foreach ($query->result() as $row) {
            $x2 = $row->adjunto_resp;
        }
        return $x2;
    }

    public function detalle_solicitud($id_transferencia)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,t.id_pais, t.monto_pesos, t.tasa, 
                                    t.monto_a_transferir,t.estatus,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,
                                    t.adjunto,c.id_banco,c.tipo_cuenta,c.nro_cuenta, c.identificacion,c.cedula_titular,
                                    c.nombres_apellidos,c.email,p.nombre_pais,b.nombre_banco, u.nombres, u.apellidos,u.telefono,u.correo
                                    from t_transferencias t
                                    left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
                                    left join n_pais p on (t.id_pais=p.id_pais)
                                    left join n_bancos b on (c.id_banco=b.id_banco)
                                    left join t_usuarios u on (t.id_usuario=u.id_usuario)
                                    where t.estatus=1 and t.id_transferencia=$id_transferencia");
        return $query->result();
    }

    public function detalle_solicitud_historico($id_transferencia)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,t.id_pais, t.monto_pesos, t.tasa, 
                                    t.monto_a_transferir,t.estatus,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,
                                    t.adjunto,c.id_banco,c.tipo_cuenta,c.nro_cuenta, c.identificacion,c.cedula_titular,
                                    c.nombres_apellidos,c.email,p.nombre_pais,b.nombre_banco, u.nombres, u.apellidos,u.telefono,u.correo
                                    from t_transferencias t
                                    left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
                                    left join n_pais p on (t.id_pais=p.id_pais)
                                    left join n_bancos b on (c.id_banco=b.id_banco)
                                    left join t_usuarios u on (t.id_usuario=u.id_usuario)
                                    where t.estatus in (2,3) and t.id_transferencia=$id_transferencia");
        return $query->result();
    }

    public function detalle_solicitud_rechazada($id_transferencia)
    {
        $query = $this->db->query("SELECT t.id_transferencia,t.id_cuenta,t.id_usuario,t.id_pais, t.monto_pesos, t.tasa, 
                                    t.monto_a_transferir,t.estatus,DATE_FORMAT(t.fecha_registro,'%d-%m-%Y')as fecha_registro,
                                    t.adjunto,c.id_banco,c.tipo_cuenta,c.nro_cuenta, c.identificacion,c.cedula_titular,
                                    c.nombres_apellidos,c.email,p.nombre_pais,b.nombre_banco, u.nombres, u.apellidos,u.telefono,u.correo
                                    from t_transferencias t
                                    left join t_cuentas c on (t.id_cuenta=c.id_cuenta)
                                    left join n_pais p on (t.id_pais=p.id_pais)
                                    left join n_bancos b on (c.id_banco=b.id_banco)
                                    left join t_usuarios u on (t.id_usuario=u.id_usuario)
                                    where t.estatus in (3) and t.id_transferencia=$id_transferencia");
        return $query->result();
    }

    public function procesar_solicitud($id_transferencia, $adjunto_resp)
    {

        $sql = "UPDATE  t_transferencias set estatus =2,
                                       adjunto_resp = '{$adjunto_resp}'                           
                                       where id_transferencia={$id_transferencia}";
        $query = $this->db->query($sql);
    }

    public function getAdjuntoId($id_transferencia)
    {
        return $this->db->where('id_transferencia', $id_transferencia)->get('t_transferencias')->row()->id_transferencia;
    }
    public function contar_solicitudes_pendientes()
    {
        $query = $this->db->query("SELECT count(id_transferencia) as cantidad
                                   from t_transferencias  where estatus=1");
        return $query->result();
    }

    public function contar_solicitudes_historico($anio,$mes)
    {
        $query = $this->db->query("SELECT count(id_transferencia) as cantidad_solicitudes
                                   from t_transferencias  
                                   where estatus=2 and  EXTRACT(month FROM fecha_registro)={$mes} and EXTRACT(year FROM fecha_registro)={$anio}");
        return $query->result();
    }

    public function cancelar_solicitud($id_transferencia)
    {

        $sql = "UPDATE  t_transferencias set estatus =3  where id_transferencia={$id_transferencia}";
        $query = $this->db->query($sql);
    }
     public function ultimo_id($id_usuario)
    {
        $query = $this->db->query("SELECT max(id_transferencia) as id_ultimo from t_transferencias where id_usuario={$id_usuario}");
        return $query->result();
    }
    
    public function verificar_saldo($id_banco)
    {
        $query = $this->db->query("SELECT (monto_apertura)as saldo 
                                  from t_caja where id_banco={$id_banco} and 
                                  DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d'))");
        return $query->result();
    }
    
    public function actualizar_caja($id_banco,$monto_a_transferir)
    {

        $sql = "UPDATE  t_caja set monto_transferido=($monto_a_transferir+monto_transferido)
                where id_banco={$id_banco} and DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d'))";
        $query = $this->db->query($sql);
    }




}
