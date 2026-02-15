
<?php
// Importações necessárias
use App\Models\Utilizador;

/**
 * label_detalhes - Função auxiliar para exibir detalhes em formato de label

 */
if (! function_exists('label_detalhes')) {
    function label_detalhes( $dados, $campo , $titulo = '', $classe = '')
    {
        $titulo = $titulo ? $titulo : ucfirst($campo); // Define título padrão se não informado
        $valor = $dados->$campo; // Obtém o valor do campo

        // Exibe HTML com estilos inline
        echo "<div class='$classe' style='display: flex; flex-direction: column;'>";
        echo "<span style='font-weight: bold;'>$titulo:</span>";
        echo "<span style='margin-top: 4px;'>$valor</span>";
        echo '</div>';
    }
}

/**
 * verificar_medico - Verifica se o utilizador logado é um médico
 * Valida sessão, existência de perfil médico e nível de acesso
 */
if (! function_exists('verificar_medico')) {

    function verificar_medico()
    {
        // Verifica se existe sessão
        if (! session('id_utilizador')) {
            return false;
        }
        
        // Busca o utilizador
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        
        // Verifica se tem perfil de médico
        if (! $utilizador->id_medico) {
            return false;
        }
        
        // Verifica se nível de acesso é 2 (médico)
        if ($utilizador->nivel_acesso != 2) {
            return false;
        }

        return $utilizador;
    }
}

/**
 * verificar_recepcionista - Verifica se o utilizador logado é recepcionista
 */
if (! function_exists('verificar_recepcionista')) {

    function verificar_recepcionista()
    {
        // Verifica se existe sessão
        if (! session('id_utilizador')) {
            return false;
        }
        
        // Busca o utilizador
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        
        // Verifica se tem perfil de recepcionista
        if (! $utilizador->id_recepcionista) {
            return false;
        }
        
        // Verifica se nível de acesso é 1 (recepcionista)
        if ($utilizador->nivel_acesso != 1) {
            return false;
        }

        return $utilizador;
    }
}

/**
 * verificar_paciente - Verifica se o utilizador logado é um paciente
 */
if (! function_exists('verificar_paciente')) {
    function verificar_paciente()
    {
        // Verifica se existe sessão
        if (! session('id_utilizador')) {
            return false;
        }
        
        // Busca o utilizador
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        
        // Verifica se tem perfil de paciente
        if (! $utilizador->id_paciente) {
            return false;
        }
        
        // Verifica se nível de acesso é 3 (paciente)
        if ($utilizador->nivel_acesso != 3) {
            return false;
        }

        return $utilizador;
    }
}

/**
 * verificar_admin - Verifica se o utilizador logado é administrador
 */
if (! function_exists('verificar_admin')) {
    function verificar_admin()
    {
        // Verifica se existe sessão
        if (! session('id_utilizador')) {
            return false;
        }
        
        // Busca o utilizador
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        
        // Verifica se nível de acesso é 0 (administrador)
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }

        return $utilizador;
    }
}

/**
 * link_ativo - Marca um link como ativo se a rota atual bater com a esperada
 * Útil para navbars e menus
 */
if (! function_exists('link_ativo')) {
    function link_ativo($rota)
    {
        return request()->routeIs($rota) ? 'active' : '';
    }

}

?>