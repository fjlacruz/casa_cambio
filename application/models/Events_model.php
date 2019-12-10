<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function upd($param) {
        $campos = array(
            'rol' => $param['rol'],
            'estatus' => $param['estatus'],
            'id_comunidad' => $param['id_comunidad'],
        );

        $this->db->where('id_usuario', $param['id']);
        $this->db->update('t_usuarios', $campos);


        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function get() {

        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function get_id($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("SELECT id_usuario,UPPER(nombres)as nombres,UPPER(apellidos) as apellidos,
            UPPER(correo) as correo,telefono,UPPER(usuario) as usuario,DATE_FORMAT(fecha_registro,'%d-%m-%Y')as fecha_registro,
            case when rol =1 then 'Administrador' else 'Solicitante' end rol,
            case when estatus =1 then 'Activo' else 'Inactivo' end estatus
            from t_usuarios where id_usuario = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }
    public function delete_user2($id_usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
    
        $this->db->delete('t_usuarios');
    }
    public function actualizar_tipo_usuario($id_usuario)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  t_usuarios set estatus=1 where id_usuario={$id_usuario}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    public function cambiar_adm($id_usuario) {
        $campos = array(
            'rol' => 2,
        );
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('t_usuarios', $campos);
        $query = $this->db->query("select * from t_usuarios");
        return $query->result();
    }
    public function cambiar_sol($id_usuario) {
        $campos = array(
            'rol' => 1,
        );
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('t_usuarios', $campos);
        $query = $this->db->query("select * from t_usuarios");
        return $query->result();
    }

}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */