<?
    session_start();
    include "./util/util.php";

    if(empty($_POST['usuario']) && empty($_POST['senha'])){
        session_destroy();
        header('Location: ./index.php');
    }

    $_SESSION['error'] = "Não foi possível encontrar seus dados";

    $sql = "SELECT
        id, usuario, role
    FROM 
        usuario 
    WHERE 
        usuario='".$_POST['usuario']."' and senha='".md5($_POST['senha'])."';";
    
    $r = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($r)) {
        
        $_SESSION['id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['nome'] = $row['usuario'];
        $_SESSION['unidade_id'] = NULL;
        $_SESSION['role'] = $row['role'];

        if($_SESSION['role'] == 'unidade'){
            $sqlUnidade = "SELECT id, bloco, apto, fracao, observacao FROM unidade WHERE usuario_id=".$row['id']." LIMIT 1;";
            $rUnidade = mysqli_query($con, $sqlUnidade);
            if ($rowUnidade = mysqli_fetch_array($rUnidade)) {
                $unidade = [
                    'id' => $rowUnidade['id'],
                    'bloco' => $rowUnidade['bloco'],
                    'apto' => $rowUnidade['apto'],
                    'fracao' => $rowUnidade['fracao'],
                    'observacao' => $rowUnidade['observacao'],
                ];
                $_SESSION['unidade'] = $unidade;
            }
        }

        criaLog($con, "Login", $row['id']);

        $_SESSION['error'] = "";
    }

    if(!isset($_SESSION['id'])){
        criaLog($con, "Erro Login", 0, "User: " . $_POST['usuario']);
        $_SESSION['error'] = "Não foi possível encontrar seus dados. Tente novamente ou entre em contato com o Condomínio.";
    }

    header('Location: ./');
?>