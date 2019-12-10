<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultas_usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no

    public function consultar_usuario($usuario = false, $clave = false) {
        $parametros = get_defined_vars();
        $sql = "SELECT id_usuario,UPPER(nombres)as nombres,UPPER(apellidos) as apellidos, UPPER(usuario) as usuario,
        UPPER(correo) as correo,telefono,rol,estatus,DATE_FORMAT(fecha_registro,'%d-%m-%Y')as fecha_registro 
    from t_usuarios 
    where usuario='{$usuario}' and clave='{$clave}' and estatus='1'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $query->result();
        //SELECT cedula,p_nombre,p_apellido,rol,id_usuario from t_usuarios where usuario='admin' and clave='00096995e9369076a898930cadb2c1f9' and estatus=1 
    }

    public function existe_correo($correo) {
        $sql = "SELECT * from t_usuarios where correo = '{$correo}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    public function existe_correo_recuperar($correo) {
        $sql = "SELECT * from t_usuarios where correo = '{$correo}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
public function existe_usuario($cedula) {
        $sql = "SELECT * from t_usuarios where cedula = '{$cedula}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }    
public function existe_usuario2($usuario) {
        $sql = "SELECT * from t_usuarios where usuario = '{$usuario}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
// ============== Funcion para registrar usuarios ==========================//
        
  public function usuarios_guardar($arrayData){
    extract($arrayData);
    
    $sql = "INSERT INTO t_usuarios  (nombres,      apellidos,      correo,     usuario,    clave,     telefono,  rut_pasaporte) 
                          VALUES  ('{$nombres}', '{$apellidos}','{$correo}','{$usuario}','{$clave}','{$telefono}','{$rut_pasaporte}')";
    $this->db->query($sql);
    //return 1;
    if ($this->db->affected_rows() > 0) {
      return 1;
    }
    else{
      return 0;
    }
} 

  // ============== Funcion para modificar usuarios ==========================// 
 public function actualizar_usuario($rol,$estatus,$id) {
       // extract($$arrayData2);
    $sql = "UPDATE  t_usuarios set rol = '{$rol}',
                                      estatus = '{$estatus}'                           
                                      where id_usuario={$id}";
    $query = $this->db->query( $sql );
       // return $query->result();          
} 

// ============== Funcion para cargar la tabla de usuarios ==========================//
 public function usuarios_todos() 
   {
   
      $query = $this->db->query
              ("SELECT  r.descripcion_rol as rol,UPPER(u.nombres)as nombres,UPPER(u.apellidos)as apellidos,UPPER(u.usuario) as usuario,
              UPPER(u.correo) as correo,
    case when u.estatus= 1 then 'HABILITADO' else 'DESHABILITADO' end as estatus,u.id_usuario
    from t_usuarios u, n_roles r 
    where u.rol=r.id_rol
    order by u.id_usuario asc",true);
      return $query->result();  
  }  
//===== funcion para consultar datos del usuario (de la variable de sesion) ==========///
   public function buscar_usuario($id_usuario) 
   {
      $query = $this->db->query
              ("SELECT a.id_usuario, UPPER(a.nombres) as nombres,UPPER(a.apellidos) as apellidos ,UPPER(a.correo) as correo,
              UPPER(a.usuario) as usuario, a.rol,a.fecha_registro,
                case when a.rol= 1 then 'ADMINISTRADOR' else 'ANALISTA' end rol,
                case when a.estatus= true then 'HABILITADO' else 'DESHABILITADO' end estatus,telefono, rut_pasaporte
               from t_usuarios a 
               where a.id_usuario = '{$id_usuario}'");
      return $query->result();  
  } 


  // ============== Funcion para modificar datos de  usuarios ==========================// 
 public function modificar_usuario_cedula($id_usuario,$correo,$usuario,$nombres,$apellidos,$telefono,$rut_pasaporte) {
       // extract($$arrayData2);
    $sql = "UPDATE  t_usuarios set correo = '{$correo}',
                                   usuario = '{$usuario}',
                                   nombres = '{$nombres}',
                                   apellidos ='{$apellidos}',
                                   telefono ='{$telefono}',
                                   rut_pasaporte ='{$rut_pasaporte}'                          
                                  where id_usuario=$id_usuario";
    $query = $this->db->query( $sql );
    
       // return $query->result();          
} 
// ============== Funcion para actualizar contrase�a ==========================// 
 public function actualizar_contrasenia2($id_usuario,$clave) {
       // extract($$arrayData2);
    $sql = "UPDATE  t_usuarios set clave = '{$clave}'                          
                                  where id_usuario='{$id_usuario}'";
    $query = $this->db->query( $sql );
       // return $query->result();          
} 
// ============== Funcion para actualizar contrase�a aletoria envia al correo ==========================// 
 public function actualizar_contrasenia($correo,$clave) {
       // extract($arrayData2);
    $sql = "UPDATE  t_usuarios set clave = '{$clave}'                          
                                  where correo='{$correo}'";
    $query = $this->db->query( $sql );
       // return $query->result();          
} 

 public function fecha_registro() 
   {
     // return $this->db->get('t_usuarios')->row()->fecha_registro;
           //  $this->db->order_by('fecha_registro', 'DESC');
      
      
      
      $query = $this->db->query ("SELECT fecha_registro from t_usuarios order by fecha_registro desc limit 1");
      return $query->result();  
      
      
  } 
  // ============== Funcion para cargar la tabla de usuarios ==========================//
 public function get_roles() 
   {
      $query = $this->db->query
              ("select * from n_roles");
      return $query->result();  
  } 

  public function contar_usuarios()
    {
        $query = $this->db->query("SELECT count(id_usuario) as cantidad
                                   from t_usuarios  where estatus=1");
        return $query->result();
    }

}
