<?php
    session_start();
    include_once "./util/util.php";
?>
<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../assets/css/crt.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />

    <title>Condomínio</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/src/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.7.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.7.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>1

</head>
<body style="margin-bottom: 50px; background-color: #EEEEEE;">

    <div class="container mb">
        <? if(!isset($_SESSION['id'])) {?>
        <div class="card my-3 col-md-12 alert-secondary">
            <div class="row" style="background-color: #FFFFFF;">
                <div class="col-lg-1 col-md-2 col-1 p-1 align-self-center">
                    <img src="./assets/img/logo.png" class="card-img">
                </div>
                <div class="col-lg-6 col-md-5 col-5 p-1 align-self-center">
                    <div class="card-body">
                        <h4 class="card-title">
                            <b>Sistema de Moradores</b>
                        </h4>  
                    </div>
                </div>
            </div>
        </div>
        <?
            } else { 
                include "./menu.php";
            }
        ?>

        <? if(isset($_SESSION['error']) && !empty($_SESSION['error'])){ ?>
            <div class="alert alert-danger" role="alert">
                <?
                    echo $_SESSION['error'];
                    session_destroy();
                ?>
            </div>
        <?  }  

            if(!isset($_SESSION['id'])){
                include "./classes/principal.php";
            } else {
                if(in_array("admin", array_keys($_GET))){
                    include "./classes/admin.php";
                } elseif(in_array("condominos", array_keys($_GET))){
                    include "./classes/condominos.php";
                } elseif(in_array("consumo", array_keys($_GET))){
                    include "./classes/consumo.php";
                } elseif(in_array("dados", array_keys($_GET))){
                    include "./classes/dados.php";
                } elseif(in_array("log", array_keys($_GET))){
                    include "./classes/log.php";
                } elseif(in_array("principal", array_keys($_GET))){
                    include "./classes/principal.php";
                } elseif(in_array("relatorioAnalitico", array_keys($_GET))){
                    include "./classes/relatorioAnalitico.php";
                } elseif(in_array("unidades", array_keys($_GET))){
                    include "./classes/unidades.php";
                } else {
                    include "./classes/principal.php";
                }
            }
        ?>
    </div>

    <div class="card my-3 col-md-12 alert-secondary">
        <div class="row">
            <div class="col-md-12 p-3 align-self-center text-center small text-small">
                <? include "./footer.php"; ?>
            </div>
        </div>
    </div>

<div id="overlay"><p>AGUARDE...<br><img src="../assets/img/loading.gif"></p></div>
</body>
</html>

<script>
    $(function(){
        $("#overlay").hide();
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>