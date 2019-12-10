<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuraciones_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    //Funcion para consultar tasa
    public function consultar_tasa($id_pais)
    {
        $query = $this->db->query("SELECT valor from t_tasa where id_pais={$id_pais}");
        return $query->result();
    }
    //Funcion para actualizar la tasa

    public function act_tasa($valor_tasa, $id_pais)
    {
        $sql = "UPDATE  t_tasa set valor = '{$valor_tasa}' where id_pais={$id_pais}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    public function insertar_tasa($valor_tasa, $id_pais)
    {
        extract($arrayData);

        $sql = "INSERT INTO t_tasa  (id_pais,valor_tasa)  VALUES  ({$id_pais},'{$valor_tasa}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function bancos_todos()
    {
        $query = $this->db->query("SELECT DISTINCT b.nombre_banco,b.fecha_registro,b.estatus,b.id_banco, b.estatus
                                   from n_bancos b
                                   left join t_caja c on (b.id_banco=c.id_banco)
                                   where  b.estatus in (1,2)
                                   group by nombre_banco
                                   order by nombre_banco ASC");
        return $query->result();
    }
    
    public function bancos_todos2()
    {
        $query = $this->db->query("SELECT DISTINCT b.nombre_banco,b.fecha_registro,b.estatus,b.id_banco
                                   from n_bancos b
                                   
                                   group by nombre_banco
                                   order by nombre_banco ASC");
        return $query->result();
    }
    
    public function bancos_todos_inf()
    {
        $query = $this->db->query("SELECT DISTINCT b.nombre_banco,b.fecha_registro,b.estatus,b.id_banco,(c.monto_apertura-c.monto_transferido)as saldo
                                   from n_bancos b
                                   left join t_caja c on (b.id_banco=c.id_banco)
                                   where b.estatus=1
                                   group by nombre_banco
                                   order by nombre_banco ASC");
        return $query->result();
    }


    public function paises_todos()
    {
        $query = $this->db->query("SELECT id_pais,UPPER(nombre_pais)as nombre_pais ,fecha_registro,estatus 
                                   from n_pais
                                   order by nombre_pais ASC");
        return $query->result();
    }

    public function paises_todos_select()
    {
        $query = $this->db->query("SELECT id_pais,UPPER(nombre_pais)as nombre_pais ,fecha_registro,estatus 
                                   from n_pais
                                   where estatus=1
                                   order by nombre_pais ASC");
        return $query->result();
    }

    public function act_banc($id_banco)
    {
        $campos = array(
            'estatus' => 1,
        );
        $this->db->where('id_banco', $id_banco);
        $this->db->update('n_bancos', $campos);
        $query = $this->db->query("select * from n_bancos");
        return $query->result();
    }

    public function desac_banc($id_banco)
    {
        $campos = array(
            'estatus' => 2,
        );
        $this->db->where('id_banco', $id_banco);
        $this->db->update('n_bancos', $campos);
        $query = $this->db->query("select * from n_bancos");
        return $query->result();
    }

    public function get_id($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->query("SELECT id_banco,UPPER(nombre_banco)as nombre_banco,
           DATE_FORMAT(fecha_registro,'%d-%m-%Y')as fecha_registro,
            case when estatus =1 then 'Activo' else 'Inactivo' end estatus
            from n_bancos where id_banco = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function upd_banco($param)
    {
        $campos = array(
            'nombre_banco' => $param['nombre_banco'],
        );

        $this->db->where('id_banco', $param['id_banco']);
        $this->db->update('n_bancos', $campos);
        $query = $this->db->query("select * from n_bancos");
        return $query->result();
    }
    public function guardar_banco($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO n_bancos  (nombre_banco)  VALUES  ('{$nombre_banco}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_id_pais($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->query("SELECT id_pais,UPPER(nombre_pais)as nombre_pais,
           DATE_FORMAT(fecha_registro,'%d-%m-%Y')as fecha_registro,
            case when estatus =1 then 'Activo' else 'Inactivo' end estatus
            from n_pais where id_pais = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }

    public function upd_pais($param)
    {
        $campos = array(
            'nombre_pais' => $param['nombre_pais'],
        );

        $this->db->where('id_pais', $param['id_pais']);
        $this->db->update('n_pais', $campos);
        $query = $this->db->query("select * from n_pais");
        return $query->result();
    }

    public function act_pais($id_pais)
    {
        $campos = array(
            'estatus' => 1,
        );
        $this->db->where('id_pais', $id_pais);
        $this->db->update('n_pais', $campos);
        $query = $this->db->query("select * from n_pais");
        return $query->result();
    }

    public function desac_pais($id_pais)
    {
        $campos = array(
            'estatus' => 2,
        );
        $this->db->where('id_pais', $id_pais);
        $this->db->update('n_pais', $campos);
        $query = $this->db->query("select * from n_pais");
        return $query->result();
    }
    public function eliminar_duplicados()
    {
        $query = $this->db->query("DELETE n1
                                    FROM n_bancos n1, n_bancos n2
                                    WHERE n1.nombre_banco = n2.nombre_banco
                                    AND n1.id_banco > n2.id_banco");
        //return $query->result();
    }

    public function eliminar_duplicados_paises()
    {
        $query = $this->db->query("DELETE n1
                                    FROM n_pais n1, n_pais n2
                                    WHERE n1.nombre_pais = n2.nombre_pais
                                    AND n1.id_pais > n2.id_pais");
        //return $query->result();
    }

    public function guardar_pais($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO n_pais  (nombre_pais)  VALUES  ('{$nombre_pais}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function delete_banco($id_banco)
	{
		$this->db->where('id_banco', $id_banco);
	
	    $this->db->delete('n_bancos');
    }
    
    public function delete_pais($id_pais)
	{
		$this->db->where('id_pais', $id_pais);
	
	    $this->db->delete('n_pais');
    }

   public function consultar_correos()
    {
        $query = $this->db->query("SELECT correo from t_usuarios");
        return $query->result();
    }
    public function info_pais($id_pais)
    {
        $query = $this->db->query("SELECT UPPER(nombre_pais)as nombre_pais 
                                   from n_pais
                                   where id_pais={$id_pais}
                                   order by nombre_pais ASC");
        return $query->result();
    }
     public function consultar_caja()
    {
        $query = $this->db->query("SELECT c.id_caja, c.id_banco, c.monto_apertura, c.monto_transferido,c.saldo, 
                                    case when c.estatus=1 then 'ABIERTA' else 'CERRADA' end estatus,c.id_usuario, 
                                    DATE_FORMAT(c.fecha_registro,'%d-%m-%Y   %H:%i:%s')as fecha_registro, b.nombre_banco, 
                                    CONCAT(u.nombres,  ' ', u.apellidos) as usuario
                                    from t_caja c
                                    left join n_bancos b on (b.id_banco=c.id_banco)
                                    left join t_usuarios u on (u.id_usuario=c.id_usuario)");
        return $query->result();
    }
    
    public function guardar_caja($arrayData)
    {
        extract($arrayData);

        $sql = "INSERT INTO t_caja  (id_banco,monto_apertura,id_usuario)  
                            VALUES  ({$id_banco},'{$monto_apertura}',{$id_usuario})";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
     public function consultar_banco_caja($id_banco)
    {
        $sql="SELECT id_banco FROM t_caja
            where DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d')) and id_banco={$id_banco}";
        $this->db->query($sql);
 
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function upd_caja($id_banco,$monto_apertura)
    {

        $sql = "UPDATE  t_caja set monto_apertura =(monto_apertura +'{$monto_apertura}') where id_banco={$id_banco} and 
                DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d'))";
        $query = $this->db->query($sql);
    }
    
    public function upd_caja_estatus($id_banco)
    {

        $sql = "UPDATE  t_caja set estatus=2 where id_banco={$id_banco} and 
                DATE_FORMAT(fecha_registro,'%Y-%m-%d')<(DATE_FORMAT((select CURDATE()),'%Y-%m-%d'))";
        $query = $this->db->query($sql);
    }
    
    public function consultar_monto_aper($id_banco)
    {
        $query = $this->db->query("SELECT id_banco, monto_apertura,
                                (select (monto_apertura-monto_transferido) from t_caja
                                where DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d')) and id_banco={$id_banco} 
                                and estatus=1
                                )as saldo
                                FROM t_caja
                                where DATE_FORMAT(fecha_registro,'%Y-%m-%d')=(DATE_FORMAT((select CURDATE()),'%Y-%m-%d')) and id_banco={$id_banco} 
                                and estatus=1");
        return $query->result();
    }
    
     public function caja_abierta($id_banco)
    {
        $sql="SELECT id_banco, monto_apertura FROM t_caja
            where DATE_FORMAT(fecha_registro,'%Y-%m-%d')<(DATE_FORMAT((select CURDATE()),'%Y-%m-%d')) and id_banco={$id_banco}";
        $this->db->query($sql);
 
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


}
