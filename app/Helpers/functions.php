
<?php
    if(!function_exists('label_detalhes')) {    
        function label_detalhes($dados, $campo, $titulo = "",$classe='') {
            $titulo = $titulo ? $titulo : ucfirst($campo);
            $valor = $dados->$campo;

            echo "<div class='$classe' style='display: flex; flex-direction: column;'>";
            echo "<span style='font-weight: bold;'>$titulo:</span>";
            echo "<span style='margin-top: 4px;'>$valor</span>";
            echo "</div>";
        }
    }
?>