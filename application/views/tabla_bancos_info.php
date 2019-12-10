<?php
$variablesSesion = $this->session->userdata('usuario');
        $rol = $variablesSesion['rol'];
?>
<table class="table table-hover table-striped">
    <?php
    echo "
        <tbody class='buscar'>";
    foreach ($resultados as $resultado) {
        $id_banco = $resultado->id_banco;
        $nombre_banco = $resultado->nombre_banco;
        $estatus = $resultado->estatus;
        $saldo = $resultado->saldo;
        $rol = $variablesSesion['rol'];
        $banco_saldo=$this->Transferencias_model->verificar_saldo($id_banco);
        //echo $banco_saldo;
        foreach($banco_saldo as $saldo_banco){
                $saldo=$saldo_banco->saldo;
               // echo $saldo;
            }
          
        
        if($rol==1){
            if($saldo<=1500000){
                $saldo_aux="<td align='justify'><strong><font color='red'>" . number_format($saldo, 2, ',', '.') . " Bs"."</font></strong></td>";
            }else{
                $saldo_aux="<td align='justify'><strong>" . number_format($saldo, 2, ',', '.') . " Bs"."</strong></td>";
            }
            
        }else{
           $saldo_aux=""; 
        }

        echo "
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_banco . "</td>      
        <td align='justify'>" . $nombre_banco . "</td> 
        $saldo_aux
        </tr>";
    }
    echo "
        <tbody>
        ";
    ?>
</table>