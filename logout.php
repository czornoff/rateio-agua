<?
    session_start();
    include "./util/util.php";

    criaLog($con, "Logout", $_SESSION['id']);

    if(isset($_SESSION['id'])){
        unset($_SESSION['id']);
    }
    if(isset($_SESSION['usuario'])){
        unset($_SESSION['usuario']);
    }
    if(isset($_SESSION['administrador'])){
        unset($_SESSION['administrador']);
    }
    session_destroy();
    header('Location: ./');
?>