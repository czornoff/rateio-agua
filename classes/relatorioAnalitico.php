<?
    $data_minima = date('Y-m-d');
    date_default_timezone_set('America/Sao_Paulo');

    if($_SESSION['role'] == 'admin'){
        $_SESSION['unidade']['id'] = $_GET['id'];
    }
?>
<div class="row mt-1 g-1">
    <div class="col-lg-12 col-md-10">
        <div class="card">
            <div class="card-body"> 
                <?
                    $tabelaValores = "";
                    echo "<h3>Relatório Analítico últimos 12 meses</h3>";
                    $sqlu = "SELECT * FROM unidade where id=" . $_SESSION['unidade']['id'];
                    $resu = mysqli_query($con, $sqlu);
                    $rowu = mysqli_fetch_array($resu);

                    echo "<h4><b>Bloco " . ( $rowu['bloco'] == 1 ? "1 (Leiden)" : "2 (Amsterdan)")  . "</b> - Unidade <b>" . $rowu['apto'] . "</b></h4>";
                    echo "<table class='table table-hover table-sm small'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th scope='col'>Relógio</th>";
                                $tabelaValores .= "Relógio|";
                                $sqlg = "SELECT * FROM (SELECT id, data_leitura from consumo_global ORDER BY data_leitura DESC LIMIT 12) as s ORDER BY ID ASC;";
                                $resg = mysqli_query($con, $sqlg);
                                while ($rowg = mysqli_fetch_array($resg)) {
                                    echo "<th scope='col'>" . date("m/Y", strtotime($rowg['data_leitura'])) . "</th>";
                                    $tabelaValores .= date("m/Y", strtotime($rowg['data_leitura'])) . "|";
                                    $total_mes[$rowg['data_leitura']] = 0;
                                    $consumo_global = $rowg['id'];
                                }
                                echo "<th scope='col'>Total</th>";
                                echo "<th scope='col'>Média</th>";
                                $tabelaValores .= "Total|Média|";
                            echo "</tr>";
                            $tabelaValores .= "
";
                        echo "</thead>";
                        echo "<tbody>";
                            $sqlr = "SELECT id, nome from relogio WHERE unidade_id = " . $_SESSION['unidade']['id'] . " ORDER BY nome;";
                            $resr = mysqli_query($con, $sqlr);
                            while ($rowr = mysqli_fetch_array($resr)) {
                                echo "<tr>";
                                    $total_linha = 0;
                                    echo "<td scope='col'>" . $rowr['nome'] . "</td>";
                                    $tabelaValores .= $rowr['nome'] . "|";
                                    $sqlg = "SELECT * FROM (SELECT id, data_leitura from consumo_global ORDER BY data_leitura DESC LIMIT 12) as s ORDER BY ID ASC;";
                                    $resg = mysqli_query($con, $sqlg);
                                    while ($rowg = mysqli_fetch_array($resg)) {
                                        $sqlp = "SELECT id, leitura_inicial, leitura_final from consumo_privativo WHERE consumo_global_id = " . $rowg['id'] . " and relogio_id = " . $rowr['id'] . " ORDER BY id;";
                                        $resp = mysqli_query($con, $sqlp);
                                        while ($rowp = mysqli_fetch_array($resp)) {
                                            echo "<td scope='col' class='text-end'>" . number_format(($rowp['leitura_final'] - $rowp['leitura_inicial']), 3, ",", ".") . "</td>";
                                            $tabelaValores .= number_format(($rowp['leitura_final'] - $rowp['leitura_inicial']), 3, ",", ".") . "|";
                                            $total_linha += ($rowp['leitura_final'] - $rowp['leitura_inicial']);
                                            $total_mes[$rowg['data_leitura']] += ($rowp['leitura_final'] - $rowp['leitura_inicial']);
                                        }
                                    }
                                    echo "<td scope='col' class='text-end'><b>" . number_format($total_linha, 3, ",", ".") . "</b></td>";
                                    echo "<td scope='col' class='text-end'><b>" . number_format($total_linha/12, 3, ",", ".") . "</b></td>";
                                    $tabelaValores .= number_format($total_linha, 3, ",", ".") . "|";
                                    $tabelaValores .= number_format($total_linha/12, 3, ",", ".") . "|";
                                echo "</tr>";
                                $tabelaValores .= "
";
                            }
                        echo "</tbody>";
                        echo "<tfooter>";
                            $total_linha=0;
                            echo "<tr>";
                                echo "<th scope='col'>Total Mês</th>";
                                $tabelaValores .= "Total Mês|";
                                $sqlg = "SELECT * FROM (SELECT id, data_leitura from consumo_global ORDER BY data_leitura DESC LIMIT 12) as s ORDER BY ID ASC;";
                                $resg = mysqli_query($con, $sqlg);
                                while ($rowg = mysqli_fetch_array($resg)) {
                                    echo "<th scope='col' class='text-end'>" . number_format($total_mes[$rowg['data_leitura']], 3, ",", ".") . "</th>";
                                    $tabelaValores .= number_format($total_mes[$rowg['data_leitura']], 3, ",", ".") . "|";
                                    $total_linha += $total_mes[$rowg['data_leitura']];
                                }
                                echo "<th scope='col' class='text-end'><b>" . number_format($total_linha, 3, ",", ".") . "</b></th>";
                                echo "<th scope='col' class='text-end'><b>" . number_format($total_linha/12, 3, ",", ".") . "</b></th>";
                                $tabelaValores .= number_format($total_linha, 3, ",", ".") . "|";
                                $tabelaValores .= number_format($total_linha/12, 3, ",", ".") . "|";
                            echo "</tr>";
                            $tabelaValores .= "
";
                        echo "</tfooter>";
                    echo "</table>";

                    $sqlg = "SELECT id, dados, created_at FROM relatorio where unidade_id = " . $_SESSION['unidade']['id'] . " and consumo_global_id = " . $consumo_global . ";";
                    $resg = mysqli_query($con, $sqlg);
                    $temRelatorio = mysqli_num_rows($resg);
                    $dados = mysqli_fetch_array($resg);

                    if($temRelatorio == 0) {
                        $apiKey = $_config['ia']['KEY']; 
                        $model  = $_config['ia']['MODEL'];
                        $apiUrl = $_config['ia']['URL'];

                        $prompt =  'Gere uma análise do consumo de água de um apartamento com os seguintes dados de consumo em m³ no CSV separados por |
Os números decimais são separados por vírgula, então 1,000 é igual a 1 inteiro e sempre representados com 3 casas decimais
A soma total do consumo de todos os pontos deve ser ' . number_format($total_linha, 3, ",", ".") . 'm³
A média mensal de todos os consumos de todos os pontos deve ser ' . number_format($total_linha/12, 3, ",", ".") . 'm³ 

' . $tabelaValores . '

                        Me traga diretamente o relatório sem frase de informação inicial adicional.
                        
                        Utilize como modelo de relatório o texto abaixo e me retorne a saída em formato HTML puro sem nenhuma informação em markdown
                        
                        <h3><strong>Análise de Consumo de Água</h3
                        <h6>(Período: XXX a XXX)</strong></h3>
                        <p>Esta análise detalha o consumo mensal de água, identifica os principais pontos de consumo e oferece insights para otimização e possíveis economias. Os valores de consumo são apresentados em metros cúbicos (m³), onde <strong>1 m³ = 1.000 litros</strong>.</p>
                        <h4><strong>1. Resumo Geral</strong></h4>
                        <ul>
                        <li><strong>Consumo Total no Período:</strong> <strong>0,000 m³</strong> (ou 0,000 litros)</li>
                        <li><strong>Média Mensal de Consumo:</strong> <strong>0,000 m³</strong> (ou 0,000 litros)</li>
                        <li><strong>Principal Ponto de Consumo:</strong> O <strong>XXX</strong> é, de longe, o maior responsável pelo consumo de água, representando <strong>0,000%</strong> do total. Isso indica que XXX.</li>
                        <li><strong>Ponto de Atenção:</strong> XXX.</li>
                        </ul>
                        <h4><strong>2. Análise do Consumo Mensal Total (Todos os Pontos Somados)</strong></h4>
                        <p>O consumo do apartamento apresentou uma tendência de XXX.</p>
                        <table class="table table-hover table-sm small">
                        <thead>
                        <tr>
                        <th style="text-align: left;">Mês</th>
                        <th style="text-align: left;">Consumo Total (m³)</th>
                        <th style="text-align: left;">Variação em Relação à Média</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td style="text-align: left;">XXX</td>
                        <td style="text-align: left;">0,000</td>
                        <td style="text-align: left;">0,000%</td>
                        </tr>
                        ...

                        ...
                        </tbody>
                        </table>
                        <p><strong>Observações:</strong></p>
                        <ul>
                        <li>XXX</li>
                        ...

                        ...
                        </ul>
                        <h4><strong>3. Análise por Ponto de Consumo (Ranking de Maiores Gastos)</strong></h4>
                        <p>Esta análise mostra quais áreas do apartamento mais consomem água.</p>
                        <table class="table table-hover table-sm small">
                        <thead>
                        <tr>
                        <th style="text-align: left;">Local</th>
                        <th style="text-align: left;">Consumo Total no Período (m³)</th>
                        <th style="text-align: left;">Percentual do Total</th>
                        <th style="text-align: left;">Média Mensal (m³)</th>
                        <th style="text-align: left;">Observação</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td style="text-align: left;"><strong>XXX</strong></td>
                        <td style="text-align: left;">0,000</td>
                        <td style="text-align: left;"><strong>0,000%</strong></td>
                        <td style="text-align: left;">0,000</td>
                        <td style="text-align: left;">XXX</td>
                        </tr>
                        ...

                        ...
                        <tr>
                        <td style="text-align: left;"><strong>Total</strong></td>
                        <td style="text-align: left;"><strong>XXX</strong></td>
                        <td style="text-align: left;"><strong>XXX%</strong></td>
                        <td style="text-align: left;"><strong>XXX</strong></td>
                        <td style="text-align: left;"></td>
                        </tr>
                        </tbody>
                        </table>
                        <p><strong>Gráfico de Contribuição por Local:</strong></p>
                        <pre><code>XXX:          [####################] 0,000%
                        ...

                        ...</code></pre>
                        <h4><strong>4. Conclusões e Recomendações</strong></h4>
                        <ol>
                        <li>
                        XXX
                        <ul>
                        <li><strong>Recomendação:</strong> XXX.</li>
                        </ul>
                        </li>
                        ...

                        ...
                        </ol>
                        <p>Em resumo, XXX.</p>';

                        $payload = json_encode([
                            'contents' => [
                                [
                                    'parts' => [['text' => $prompt]]
                                ]
                            ],
                            'generationConfig' => [ 
                                'temperature' => 0.8
                            ]
                        ]);

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $apiUrl);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'x-goog-api-key: ' . $apiKey,
                            'Content-Type: application/json',
                        ]);

                        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                        $response = curl_exec($ch);
                        curl_close($ch);

                        $data = json_decode($response, true);

                        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                            $resposta_ia = $data['candidates'][0]['content']['parts'][0]['text'];
                            echo $resposta_ia;
                            include "./util/conexaoMySQLi.php";
                            $sql = "insert into relatorio (unidade_id, consumo_global_id, dados) values (" . $_SESSION['unidade']['id'] . ", " . $consumo_global . ", '" . $resposta_ia . "');";
                            $res = mysqli_query($con, $sql);
                        } else {
                            echo "<div class='alert alert-danger'>Não foi possível gerar o relatório, tente novamente em instantes.</div>";
                        }

                    } else {
                        echo "<p class='text-end'><span class='badge bg-secondary badge-sm small'>Seu relatório foi gerado em " . date("d/m/Y H:i:s", strtotime($dados['created_at'])) . "</span></p>";
                        echo $dados['dados'];
                    }
                ?>
            </div>
        </div>
    </div>
</div>