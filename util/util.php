<?php
    include "config.php";
    include "conexaoMySQLi.php";

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $sqlu = "SELECT id, usuario FROM usuario;";
    $ru = mysqli_query($con, $sqlu);
    while ($rowu = mysqli_fetch_array($ru)) {
        $usuarios[$rowu['id']] = $rowu['usuario'];
    }

    function criaLog($con, $action, $id, $adicional = null){ 
        $dados = [
            "action" => $action,
            "ip" => $_SERVER['REMOTE_ADDR'],
            "local" => $_SERVER['HTTP_REFERER']
        ];

        if($adicional != null){
            $dados["adicional"] = $adicional;
        }

        $log = json_encode($dados);

        mysqli_query($con, "insert into log (tabela, usuario_id, log) values 
        ( 'usuario', ". $id.",'" . $log . "')");
    }
?>