
<?php
use App\Models\Utilizador;

if (! function_exists('label_detalhes')) {
    function label_detalhes($dados, $campo, $titulo = '', $classe = '')
    {
        $titulo = $titulo ? $titulo : ucfirst($campo);
        $valor = $dados->$campo;

        echo "<div class='$classe' style='display: flex; flex-direction: column;'>";
        echo "<span style='font-weight: bold;'>$titulo:</span>";
        echo "<span style='margin-top: 4px;'>$valor</span>";
        echo '</div>';
    }
}
if (! function_exists('verificar_medico')) {

    function verificar_medico()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if (! $utilizador->id_medico) {
            return false;
        }
        if ($utilizador->nivel_acesso != 2) {
            return false;
        }

        return $utilizador;
    }
}
if (! function_exists('verificar_recepcionista')) {

    function verificar_recepcionista()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if (! $utilizador->id_recepcionista) {
            return false;
        }
        if ($utilizador->nivel_acesso != 1) {
            return false;
        }

        return $utilizador;
    }
}
if (! function_exists('verificar_paciente')) {
    function verificar_paciente()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if (! $utilizador->id_paciente) {
            return false;
        }
        if ($utilizador->nivel_acesso != 3) {
            return false;
        }

        return $utilizador;
    }
}
if (! function_exists('verificar_admin')) {
    function verificar_admin()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }

        return $utilizador;
    }
}
if (! function_exists('link_ativo')) {
    function link_ativo($rota)
    {
        return request()->routeIs($rota) ? 'active' : '';
    }
}

?>