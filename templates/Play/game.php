<?php
    echo "Quantidade total de espaços: ". $spaces;
    echo "<br><br>Todos os prêmios: <br>";
    print_r($awards);

    $awards = json_decode($awards);
    
    echo "<br><br>Casa selecionada: ". $selected;
    echo "<br>Prêmio posição: ".$award."<br>";

?>