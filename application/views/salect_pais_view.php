
 <?php
    echo '
 <select name="pais" id="pais" class="form-control" onchange="consulta_tasa();" >
                    <option value="0">Selecione...</option>';

    foreach ($paises as $i => $pais) {
        echo '<option value="' . $pais->id_pais . '">' . $pais->nombre_pais . '</option>';
    }

    echo '</select>';

?>