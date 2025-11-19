<?php
    $con = mysqli_connect(
            $_config['db']['HOST'], 
            $_config['db']['USER'], 
            $_config['db']['PASS']
        ) or die ('Erro ao conectar ao banco de dados');

    mysqli_query( $con, "USE" . $_config['db']['NAME'] );
    mysqli_set_charset($con, "utf8mb4");

    $timezone_sql = "SET time_zone = '-03:00';";
    mysqli_query( $con, $timezone_sql );