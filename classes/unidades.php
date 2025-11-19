<?
    $data_minima = date('Y-m-d');
    date_default_timezone_set('America/Sao_Paulo');

    if($_SESSION['role'] == 'admin'){
        $_SESSION['unidade']['id'] = $_GET['id'];
    }
?>
<div class="row mt-1 g-1">
    <div class="col-lg-10 col-md-10">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body"> 
                        <?php
                            if($_GET['action'] == "show"){
                                    $sql = "SELECT * FROM unidade where id=" . $_SESSION['unidade']['id'];
                                    $res = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<div class='row'>";
                                            echo "<div class='col-8'>";
                                                echo "<h2><b>Bloco " . ( $row['bloco'] == 1 ? "1 (Leiden)" : "2 (Amsterdan)")  . "</b> - Unidade <b>" . $row['apto'] . "</b></h2>";
                                            echo "</div>";
                                            echo "<div class='col-4'>";
                                                echo "<span class='badge bg-secondary badge-xs small float-end'><small>Fração: " . $row['fracao'] . "</small></span>";
                                            echo "</div>";
                                        echo "</div>";
                                        
                                        echo "<div class='row'>";
                                            echo "<div class='col-4'>";
                                                echo "<div class='list-group' id='list-tab' role='tablist'>";
                                                    echo "<li class='list-group-item bg-info h5 text-white mb-0'>
                                                            Proprietários <a href='./unidades?action=add_proprietario' class='badge badge-sm small bg-primary float-end'><i class='fas fa-plus'></i></a>
                                                    </li>";
                                                        echo "<a class='list-group-item list-group-item-action' id='list-p-1' data-bs-toggle='list' href='#proprietario-1' role='tab' aria-controls='list-home'>Proprietário 1</a>";
                                                    echo "<li class='list-group-item bg-info h5 text-white mb-0'>
                                                            Moradores <a href='./unidades?action=add_morador' class='badge badge-sm small bg-primary float-end'><i class='fas fa-plus'></i></a>
                                                    </li>";
                                                        echo "<a class='list-group-item list-group-item-action' id='list-m-1' data-bs-toggle='list' href='#morador-1' role='tab' aria-controls='list-home'>Morador 1</a>";
                                                echo "</div>";
                                                if($_SESSION['role'] == 'admin'){
                                                    echo "<a href='./?relatorioAnalitico&id=".$_SESSION['unidade']['id']."' class='btn btn-primary mt-2'>Relatório Analítico - 12 meses</a>";
                                                } else {
                                                    echo "<a href='./?relatorioAnalitico' class='btn btn-primary mt-2'>Relatório Analítico - 12 meses</a>";
                                                }
                                            echo "</div>";
                                            echo "<div class='col-8'>";
                                                echo "<div class='tab-content' id='nav-tabContent'>";
                                                    echo "<div class='tab-pane fade' id='proprietario-1' role='tabpanel' aria-labelledby='list-p-1'>";
                                                        echo "<h5>Proprietário 1</h5>";
                                                        echo "<p>";
                                                            echo "<a href='./unidades?action=add_proprietario' class='btn btn-sm btn-danger float-end'><i class='fas fa-trash'></i></a>";
                                                            echo "<a href='./unidades?action=add_proprietario' class='btn btn-sm btn-info float-end'><i class='fas fa-pen'></i></a>";
                                                        echo "</p>";
                                                    echo "</div>";
                                                    echo "<div class='tab-pane fade' id='morador-1' role='tabpanel' aria-labelledby='list-m-1'>";
                                                        echo "<h5>Morador 1</h5>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                    echo "<div class='accordion mt-3' id='accordion-unidade'>";
                                        echo "<div class='accordion-item'>";
                                            echo "<h2 class='accordion-header' id='head-graph'>";
                                                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#body-graph' aria-expanded='true' aria-controls='head-graph'>";
                                                    echo "<b>Gráfico dos últimos 12 meses</b>";
                                                echo "</button>";
                                            echo "</h2>";
                                            echo "<div id='body-graph' class='accordion-collapse collapse' aria-labelledby='head-graph'>";
                                                echo "<div class='accordion-body'>";
                                                    echo "<div>";
                                                        echo "<h6>Consumo de Água (m³)</h6>";
                                                        echo "<canvas id='chart-consumo' style='height:50vh; width:100vw'></canvas>";
                                                    echo "</div>";
                                                    echo "<div>";
                                                        echo "<h6>Valor da Água (R$)</h6>";
                                                        echo "<canvas id='chart-valor' style='height:50vh; width:100vw'></canvas>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<div class='accordion-item'>";
                                            echo "<h2 class='accordion-header' id='head-consumo'>";
                                                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#body-consumo' aria-expanded='false' aria-controls='head-consumo'>";
                                                    echo "<b>12 últimos consumos de água</b>";
                                                echo "</button>";
                                            echo "</h2>";
                                            echo "<div id='body-consumo' class='accordion-collapse collapse' aria-labelledby='head-consumo'>";
                                                echo "<div class='accordion-body'>";
                                                    $media_consumo = 0;
                                                    $media_valor = 0;

                                                    $sqlg = "SELECT * from consumo_global ORDER BY data_leitura DESC limit 12;";
                                                    $resg = mysqli_query($con, $sqlg);

                                                    $corpo_historico = "";

                                                    $media_privativa_consumo = 0;
                                                    $media_privativa_valor = 0;
                                                    $media_comum_consumo = 0;
                                                    $media_comum_valor = 0;
                                                    $media_total_consumo = 0;
                                                    $media_total_valor = 0;

                                                    while ($rowg = mysqli_fetch_array($resg)) {
                                                        $corpo_historico .= "<div class='row'>";
                                                            $corpo_historico .= "<div class='col-12'>";
                                                                $corpo_historico .= "<div class='card mb-1'>";
                                                                    $corpo_historico .= "<div class='card-header bg-secondary text-white'>";
                                                                        $corpo_historico .= "Consumo com leitura em <b>" . date("d/m/Y", strtotime($rowg['data_leitura'])) . "</b>";
                                                                    $corpo_historico .= "</div>";
                                                                    $corpo_historico .= "<div class='card-body'>";
                                                                        $corpo_historico .= "<div class='row'>";
                                                                            $sqlc = "SELECT * from consumo_historico where consumo_global_id = " . $rowg['id'] . " and unidade_id = " . $_SESSION['unidade']['id'] . ";";
                                                                            $resc = mysqli_query($con, $sqlc);
                                                                            while ($rowc = mysqli_fetch_array($resc)) {
                                                                                $corpo_historico .= "<div class='col-4'>";
                                                                                    $corpo_historico .= "<div class='card m-0 p-2'>";
                                                                                        $corpo_historico .= "<p><b>Área Privativa</b></p>";
                                                                                        $corpo_historico .= "<p class='mb-0 small'>";
                                                                                            $corpo_historico .= "Consumo: <b>" . number_format($rowc['privativa_consumo'],3,",",".") . "</b>m³<br>";
                                                                                            $corpo_historico .= "Valor: <b>R$ " . number_format($rowc['privativa_valor'],2,",",".") . "</b>";
                                                                                        $corpo_historico .= "</p>";
                                                                                    $corpo_historico .= "</div>";
                                                                                $corpo_historico .= "</div>";
                                                                                $corpo_historico .= "<div class='col-4'>";
                                                                                    $corpo_historico .= "<div class='card m-0 p-2'>";
                                                                                        $corpo_historico .= "<p><b>Área Comum</b></p>";
                                                                                        $corpo_historico .= "<p class='mb-0 small'>";
                                                                                            $corpo_historico .= "Consumo: <b>" . number_format($rowc['comum_consumo'],3,",",".") . "</b>m³<br>";
                                                                                            $corpo_historico .= "Valor: <b>R$ " . number_format($rowc['comum_valor'],2,",",".") . "</b>";
                                                                                        $corpo_historico .= "</p>";
                                                                                    $corpo_historico .= "</div>";
                                                                                $corpo_historico .= "</div>";
                                                                                $corpo_historico .= "<div class='col-4'>";
                                                                                    $corpo_historico .= "<div class='card m-0 p-2 bg-info'>";
                                                                                        $corpo_historico .= "<p><b>Total</b></p>";
                                                                                        $corpo_historico .= "<p class='mb-0 small'>";
                                                                                            $corpo_historico .= "Consumo: <b>" . number_format($rowc['privativa_consumo']+$rowc['comum_consumo'],3,",",".") . "</b>m³<br>";
                                                                                            $corpo_historico .= "Valor: <b>R$ " . number_format($rowc['privativa_valor']+$rowc['comum_valor'],2,",",".") . "</b>";
                                                                                        $corpo_historico .= "</p>";
                                                                                    $corpo_historico .= "</div>";
                                                                                $corpo_historico .= "</div>";

                                                                                $media_privativa_consumo += $rowc['privativa_consumo'];
                                                                                $media_privativa_valor += $rowc['privativa_valor'];
                                                                                $media_comum_consumo += $rowc['comum_consumo'];
                                                                                $media_comum_valor += $rowc['comum_valor'];
                                                                                $media_total_consumo += ($rowc['privativa_consumo'] + $rowc['comum_consumo']);
                                                                                $media_total_valor += ($rowc['privativa_valor'] + $rowc['comum_valor']);
                                                                            }
                                                                        $corpo_historico .= "</div>";
                                                                    $corpo_historico .= "</div>";
                                                                $corpo_historico .= "</div>";
                                                            $corpo_historico .= "</div>";
                                                        $corpo_historico .= "</div>";
                                                    }
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-12'>";
                                                            echo "<div class='card mb-1'>";
                                                                echo "<div class='card-header bg-success text-white'>";
                                                                    echo "<b>Consumo médio</b>";
                                                                echo "</div>";
                                                                echo "<div class='card-body'>";
                                                                    echo "<div class='row'>";
                                                                        echo "<div class='col-4'>";
                                                                            echo "<div class='card m-0 p-1'>";
                                                                                echo "<p><b>Área Privativa</b></p>";
                                                                                echo "<p class='mb-0 small'>";
                                                                                    echo "Consumo: <b>" . number_format($media_privativa_consumo/12,3,",",".") . "</b>m³<br>";
                                                                                    echo "Valor: <b>R$ " . number_format($media_privativa_valor/12,2,",",".") . "</b>";
                                                                                echo "</p>";
                                                                            echo "</div>";
                                                                        echo "</div>";
                                                                        echo "<div class='col-4'>";
                                                                            echo "<div class='card m-0 p-1'>";
                                                                                echo "<p><b>Área Comum</b></p>";
                                                                                echo "<p class='mb-0 small'>";
                                                                                    echo "Consumo: <b>" . number_format($media_comum_consumo/12,3,",",".") . "</b>m³<br>";
                                                                                    echo "Valor: <b>R$ " . number_format($media_comum_valor/12,2,",",".") . "</b>";
                                                                                echo "</p>";
                                                                            echo "</div>";
                                                                        echo "</div>";
                                                                        echo "<div class='col-4'>";
                                                                            echo "<div class='card m-0 p-1 bg-info'>";
                                                                                echo "<p><b>Total</b></p>";
                                                                                echo "<p class='mb-0 small'>";
                                                                                    echo "Consumo: <b>" . number_format($media_total_consumo/12,3,",",".") . "</b>m³<br>";
                                                                                    echo "Valor: <b>R$ " . number_format($media_total_valor/12,2,",",".") . "</b>";
                                                                                echo "</p>";
                                                                            echo "</div>";
                                                                        echo "</div>";
                                                                    echo "</div>";
                                                                echo "</div>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                    echo $corpo_historico;
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<div class='accordion-item'>";
                                            echo "<h2 class='accordion-header' id='head-leitura'>";
                                                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#body-leitura' aria-expanded='false' aria-controls='head-leitura'>";
                                                    echo "<b>12 últimos leituras de água</b>";
                                                echo "</button>";
                                            echo "</h2>";
                                            echo "<div id='body-leitura' class='accordion-collapse collapse' aria-labelledby='head-leitura'>";
                                                echo "<div class='accordion-body'>";
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-md-12 mb-2'>";
                                                            $sqlg = "SELECT * from consumo_global ORDER BY data_leitura DESC limit 12;";
                                                            $resg = mysqli_query($con, $sqlg);
                                                            while ($rowg = mysqli_fetch_array($resg)) {
                                                                echo "<div class='card border-secondary mb-2'>";
                                                                    echo "<div class='card-header text-white bg-secondary'>";
                                                                    echo "Leitura efetuada em <b>" . date("d/m/Y", strtotime($rowg['data_leitura'])) . "</b>";
                                                                    echo "</div>";
                                                                    echo "<div class='card-body'>";
                                                                        echo "<div class='card-group'>";
                                                                            $sqlr = "SELECT * from relogio where unidade_id = " . $_SESSION['unidade']['id'];
                                                                            $resr = mysqli_query($con, $sqlr);
                                                                            while ($rowr = mysqli_fetch_array($resr)) {
                                                                                echo "<div class='card'>";
                                                                                    echo "<div class='card-header p-1 text-center'>";
                                                                                        echo "<b>" . $rowr['nome'] . "</b>";
                                                                                    echo "</div>";
                                                                                    echo "<div class='card-body p-1'>";
                                                                                    echo "<p class='text-center card-text small'>
                                                                                        <span class='badge bg-info badge-sm small'>Transmissor nº " . $rowr['radio'] . ")</span>
                                                                                    </p>";
                                                                                    $sqlc = "SELECT * from consumo_privativo where consumo_global_id = " . $rowg['id'] . " and relogio_id = " . $rowr['id'] . ";";
                                                                                    $resc = mysqli_query($con, $sqlc);
                                                                                    while ($rowc = mysqli_fetch_array($resc)) {
                                                                                        echo "<p class='text-center card-text h3 mb-1'>
                                                                                            <span class='badge bg-primary'>" . $rowc['leitura'] . "</span>
                                                                                        </p>";
                                                                                    }
                                                                                echo "</div>";
                                                                                echo "</div>";
                                                                            }
                                                                        echo "</div>";
                                                                    echo "</div>";
                                                                echo "</div>";
                                                            }
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                $sqlg = "SELECT * from consumo_global ORDER BY data_leitura DESC limit 12;";
                                $resg = mysqli_query($con, $sqlg);

                                $label = "";
                                $privativa_consumo = "";
                                $privativa_valor = "";
                                $comum_consumo = "";
                                $comum_valor = "";
                                $media_consumo = "";
                                $media_valor = "";
                                $total_consumo = "";
                                $total_valor = "";

                                $media_privativa_consumo = 0;
                                $media_privativa_valor = 0;
                                $media_comum_consumo = 0;
                                $media_comum_valor = 0;
                                $media_total_consumo = 0;
                                $media_total_valor = 0;

                                while ($rowg = mysqli_fetch_array($resg)) {
                                    $label .= "'" . date("m/Y", strtotime($rowg['data_leitura'])) . "', ";
                                    $sqlc = "SELECT * from consumo_historico where consumo_global_id = " . $rowg['id'] . " and unidade_id = " . $_SESSION['unidade']['id'] . ";";
                                    $resc = mysqli_query($con, $sqlc);
                                    
                                    while ($rowc = mysqli_fetch_array($resc)) {
                                        $privativa_consumo  .= number_format($rowc['privativa_consumo'],3,".","") . ", ";
                                        $privativa_valor    .= number_format($rowc['privativa_valor'],2,".","") . ", ";
                                    
                                        $comum_consumo .= number_format($rowc['comum_consumo'],3,".","") . ", ";
                                        $comum_valor   .= number_format($rowc['comum_valor'],2,".","") . ", ";

                                        $total_consumo .= number_format($rowc['privativa_consumo']+$rowc['comum_consumo'],3,".","") . ", ";
                                        $total_valor   .= number_format($rowc['privativa_valor']+$rowc['comum_valor'],2,".","") . ", ";

                                        $media_privativa_consumo += $rowc['privativa_consumo'];
                                        $media_privativa_valor += $rowc['privativa_valor'];
                                        $media_comum_consumo += $rowc['comum_consumo'];
                                        $media_comum_valor += $rowc['comum_valor'];
                                        $media_total_consumo += ($rowc['privativa_consumo'] + $rowc['comum_consumo']);
                                        $media_total_valor += ($rowc['privativa_valor'] + $rowc['comum_valor']);
                                    }
                                }

                                $media_comum_consumo = number_format($media_comum_consumo/12,3,".","");
                                $media_privativa_consumo = number_format($media_privativa_consumo/12,3,".","");
                                $media_comum_valor = number_format($media_comum_valor/12,3,".","");
                                $media_privativa_valor = number_format($media_privativa_valor/12,3,".","");

                                $comum_consumo_media     = "";
                                $privativa_consumo_media = "";
                                $comum_valor_media     = "";
                                $privativa_valor_media = "";

                                for($i=0; $i<12; $i++){
                                    $comum_consumo_media .= $media_comum_consumo . ", ";
                                    $privativa_consumo_media .= $media_privativa_consumo . ", ";
                                    $comum_valor_media .= $media_comum_valor . ", ";
                                    $privativa_valor_media .= $media_privativa_valor . ", ";
                                }
                            ?>
                            <script>
                                const ctx = document.getElementById('chart-consumo');

                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        datasets: [
                                            {
                                                type: 'line',
                                                label: 'Média Consumo Privativa (m³)',
                                                data: [<? echo rtrim($privativa_consumo_media, ", "); ?>],
                                                borderColor: '#0368b1ff',
                                                backgroundColor: '#0368b1ff'
                                            }, {
                                                type: 'line',
                                                label: 'Média Consumo Área Comum (m³)',
                                                data: [<? echo rtrim($comum_consumo_media, ", "); ?>],
                                                borderColor: '#ff486dff',
                                                backgroundColor: '#ff486dff'
                                            },
                                            {
                                                type: 'bar',
                                                label: 'Consumo Privativa (m³)',
                                                data: [<? echo rtrim($privativa_consumo, ", "); ?>],
                                                backgroundColor: '#9BD0F5'
                                            }, {
                                                type: 'bar',
                                                label: 'Consumo Área Comum (m³)',
                                                data: [<? echo rtrim($comum_consumo, ", "); ?>],
                                                backgroundColor: '#FFB1C1'
                                            }, {
                                                type: 'bar',
                                                label: 'Consumo Total (m³)',
                                                data: [<? echo rtrim($total_consumo, ", "); ?>],
                                                backgroundColor: '#c863f7ff'
                                            }
                                    ],
                                        labels: [<? echo rtrim($label, ", "); ?>]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                                const ctxV = document.getElementById('chart-valor');

                                new Chart(ctxV, {
                                    type: 'bar',
                                    data: {
                                        datasets: [
                                            {
                                                type: 'line',
                                                label: 'Média Valor Privativa (R$)',
                                                data: [<? echo rtrim($privativa_valor_media, ", "); ?>],
                                                borderColor: '#519b3bff',
                                                backgroundColor: '#519b3bff'
                                            }, {
                                                type: 'line',
                                                label: 'Média Valor Área Comum (R$)',
                                                data: [<? echo rtrim($comum_valor_media, ", "); ?>],
                                                borderColor: '#c48426ff',
                                                backgroundColor: '#c48426ff'
                                            },
                                            {
                                                type: 'bar',
                                                label: 'Valor Privativa (R$)',
                                                data: [<? echo rtrim($privativa_valor, ", "); ?>],
                                                backgroundColor: '#96ca86ff'
                                            }, {
                                                type: 'bar',
                                                label: 'Valor Área Comum (R$)',
                                                data: [<? echo rtrim($comum_valor, ", "); ?>],
                                                backgroundColor: '#ffe0b1ff'
                                            }, {
                                                type: 'bar',
                                                label: 'Valor Total (R$)',
                                                data: [<? echo rtrim($total_valor, ", "); ?>],
                                                backgroundColor: '#c863f7ff'
                                            }
                                    ],
                                        labels: [<? echo rtrim($label, ", "); ?>]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                            <?
                            } else {
                                echo "<div class='row'>";
                                for($bloco=1; $bloco<=2; $bloco++) {
                                    echo "<div class='col-md-6 mb-2'>";
                                        echo "<div class='card'>";
                                            echo "<div class='card-header'>";
                                                echo "<h5><b>Bloco " . $bloco . " (" . ($bloco == 1 ? "Leiden" : "Amsterdan") . ")</b></h5>";
                                            echo "</div>";
                                            echo "<div class='card-body'>";
                                                echo "<div class='row g-1'>";
                                                    $sqlq = "SELECT * FROM unidade where bloco = $bloco and ocupada = 'S'";
                                                    $resq = mysqli_query($con, $sqlq);
                                                    $qtde = mysqli_num_rows($resq);

                                                    $sql = "SELECT * FROM unidade where bloco = $bloco ORDER BY apto ASC";
                                                    $res = mysqli_query($con, $sql);
                                                    
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        echo "<div class='col-md-3'>";
                                                            echo "<a href='./?unidades&action=show&id=" . $row['id'] . "' class='btn btn-primary w-100 m-1 h3'>";
                                                                echo "<b>" . $row['apto'] . "</b>";
                                                            echo "</a>";
                                                        echo "</div>";
                                                    }
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<div class='card-footer text-muted'>";
                                                echo "<div class='row'>";
                                                    echo "<div class='col-md-4'><div class='col-md-12 my-1 badge bg-primary'>Total de Unidades: 48</div></div>";
                                                    echo "<div class='col-md-4'><div class='col-md-12 my-1 badge bg-success'>Unidades Ocupadas: " . $qtde . "</div></div>";
                                                    echo "<div class='col-md-4'><div class='col-md-12 my-1 badge bg-danger'>Unidades Vagas: " . (48 - $qtde) . "</div></div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    Visualize as unidades, relatórios, crie e edite moradores e proprietários.
                </p>
            </div>
        </div>
    </div>