<table class="table table-hover table-striped">
    <?php
    echo "
        <tbody>";
    foreach ($tasas as $tasa) {
        $nombre_pais = $tasa->nombre_pais;
        $valor = $tasa->valor;

        echo "
        <tr align='right'> 
        <td align='right' >" . $nombre_pais . "</td>      
        <td align='justify'>" . $valor . "</td>   
        </tr>";
    }
    echo "
        <tbody>
        ";
    ?>
</table>