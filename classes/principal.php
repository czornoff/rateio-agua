<div class="row mt-1 g-1">
    <div class="col-lg-10 col-md-12">
        <div class="card">
            <div class="card-header">
                <? if(isset($_SESSION['id'])){ ?>
                    <h5><b>Principal</b></h5>
                <? } else { ?>
                    <h5 id="nome"><b>Utilize seu Usuário e Senha.</b></h5>
                <? } ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                    <? 
                        if(isset($_SESSION['id'])){ 
                            $sql = "SELECT * FROM usuario WHERE id = ".$_SESSION['id'];
                            $res = mysqli_query($con, $sql);
                            $qtde_rows = mysqli_num_rows($res);
                    ?>
                        <div class="alert alert-success" role="alert">
                            <? echo "Olá, <b>".$_SESSION['usuario']."</b>!<br>"; ?>
                        </div>

                        <?
                            if($qtde_rows == 0){
                                
                                echo "<div class='alert alert-warning' role='alert'>
                                    <i class='fas fa-exclamation-triangle'></i> <b>Atenção:</b> Você ainda não configurou seu perfil. <a href='./?admin&action=edt' target='_blank'><b>Clique aqui</b></a> para configurar agora.
                                </div>";
                            }
                        ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Concessionária</h5>
                            <table class="table table-striped table-sm small">
                                <tr>
                                    <th>Nome</th>
                                    <th>Hidrômetro</th>
                                    <th>Fornecimento</th>
                                    <th></th>
                                </tr>
                                <?
                                    $sql = "SELECT * from concessionaria";
                                    $res = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_array($res)){
                                        echo "<tr>";
                                            echo "<td>" . $row['concessionaria_nome'] . "</td>";
                                            echo "<td>" . $row['concessionaria_hidrometro'] . "</td>";
                                            echo "<td>" . $row['concessionaria_fornecimento'] . "</td>";
                                            echo !empty($row['observacao']) ? "<td><span class='badge bg-info float-end' data-bs-toggle='popover' data-bs-placement='bottom' title='" . $row['observacao'] . "'><i class='fas fa-info'></i></span></td>" : "<td></td>";
                                        echo "</tr>";
                                    }   
                                ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Faixas de Consumo</h5>
                            <table class="table table-striped table-sm small">
                                <tr>
                                    <th>Nome</th>
                                    <th>Consumo de - até</th>
                                    <th>Valor</th>
                                    <th>Descrição</th>
                                    <th></th>
                                </tr>
                                <?
                                    $sql = "SELECT * from faixa";
                                    $res = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_array($res)){
                                        echo "<tr>";
                                            echo "<td>" . $row['nome'] . "</td>";
                                            echo "<td>" . $row['range_inicial'] ." - ". $row['range_final'] . "</td>";
                                            echo "<td>R$&nbsp;" . number_format($row['valor'], 3, ',', '.') . "</td>";
                                            echo "<td>" . $row['descricao'] . "</td>";
                                            echo !empty($row['observacao']) ? "<td><span class='badge bg-info float-end' data-bs-toggle='popover' data-bs-placement='bottom' title='" . $row['observacao'] . "'><i class='fas fa-info'></i></span></td>" : "<td></td>";
                                        echo "</tr>";
                                    }   
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Consumo Global</h5>
                            <table class="table table-striped table-sm small">
                                <tr>
                                    <th>Data</th>
                                    <th class="d-none d-md-table-cell">Leitura</th>
                                    <th class="d-none d-md-table-cell">Dias</th>
                                    <th class="d-none d-md-table-cell">Documento</th>
                                    <th>Valor</th>
                                    <th>Consumo</th>
                                    <th class="text-end d-none d-md-table-cell">Privativa</th>
                                    <th class="text-end d-none d-md-table-cell">Comum</th>
                                    <th class="d-none d-md-table-cell"></th>
                                    <th class="d-md-none">Dados</th>
                                </tr>
                                <?
                                    $sql = "SELECT * from consumo_global ORDER BY data_leitura DESC;";
                                    $res = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_array($res)){
                                        echo "<tr>";
                                            echo "<td>" . date("d/m/Y", strtotime($row['data_leitura'])) . "</td>";
                                            echo "<td class='d-none d-md-table-cell'>" . number_format($row['concessionaria_leitura'], 0, ',', '.') . "m³</td>";
                                            echo "<td class='d-none d-md-table-cell'>" . number_format($row['concessionaria_dias'], 0) . "</td>";
                                            echo "<td class='d-none d-md-table-cell'><a class='badge bg-primary' href='./upload/faturas/" . $row['concessionaria_arquivo'] . "' target='_blank'><i class='fas fa-file-pdf'></i></a> " . $row['concessionaria_documento'] . "</td>";
                                            echo "<td>R$&nbsp;" . number_format($row['concessionaria_valor'], 2, ',', '.') . "</td>";
                                            echo "<td>" . number_format($row['concessionaria_consumo'], 0, ',', '.') . "m³</td>";
                                            echo "<td class='text-end d-none d-md-table-cell'>" . number_format($row['privativa_consumo'], 3, ',', '.') . "m³<br>R$&nbsp;" . number_format($row['privativa_valor'], 2, ',', '.') . "</td>";
                                            echo "<td class='text-end d-none d-md-table-cell'>" . number_format($row['comum_consumo'], 3, ',', '.') . "m³<br>R$&nbsp;" . number_format($row['comum_valor'], 2, ',', '.') .  "</td>";
                                            echo "<td class='d-none d-md-table-cell'>" . (!empty($row['observacao']) ? ("<span class='badge bg-info float-end' data-bs-toggle='popover' data-bs-placement='bottom' title='" . $row['observacao'] . "'><i class='fas fa-info'></i></span>") : "") . "</td>";
                                            echo "<td class='d-md-none'>
                                                <a class='badge bg-primary' href='./upload/faturas/" . $row['concessionaria_arquivo'] . "' target='_blank'><i class='fas fa-file-pdf'></i></a> " . $row['concessionaria_documento'] . "<br>
                                                Leitura: " . number_format($row['concessionaria_leitura'], 0, ',', '.') . "m³<br>";
                                                echo "Dias: " . number_format($row['concessionaria_dias'], 0) . "<br>";
                                                echo "<b>Privativa </b><br>" . number_format($row['privativa_consumo'], 3, ',', '.') . "m³<br>R$&nbsp;" . number_format($row['privativa_valor'], 2, ',', '.') . "<br>";
                                                echo "<b>Comum </b><br>" . number_format($row['comum_consumo'], 3, ',', '.') . "m³<br>R$&nbsp;" . number_format($row['comum_valor'], 2, ',', '.') .  "";
                                                echo (!empty($row['observacao']) ? ("<hr><div style='width: 180px'><i>" . $row['observacao'] . "</i></div>") : "") . 
                                            "</td>";
                                        echo "</tr>";
                                    }   
                                ?>
                            </table>
                        </div>
                    </div>
                        
                    <? } else { ?>
                        <form id="login" role="form"  method="POST" action="./login.php" >
                            <p class="card-text small"><i>Utilize seu usuário e senha.</i></p>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="usuario" class="form-label"><small><b>Usuário *</b> <small>obrigatório</small></small></label>
                                    <input type="text" class="form-control" id="usuario" name="usuario">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="senha" class="form-label"><small><b>Senha</b> *</b> <small>obrigatório</small></small></label>
                                    <input type="password" class="form-control" id="senha" name="senha">
                                </div>
                            </div>
                            <div class="px-0 my-3 col-lg-12">
                                <input type="submit" class="btn btn-block btn-primary" value="Acessar Sistema">
                            </div>
                        </form>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-2 col-md-12">
    <div class="card">
        <h5 class="card-header">Observações</h5>
        <div class="card-body">
            <p class="card-text small">
            Acesso ao sistema de controle de condôminos e rateio de água.<br>
            Preencha seus dados <a href='./?admin&edt' target='_blank'><b>aqui</b></a> para:<br>
            <ul class="small">
                <li>Criar Condôminos</li>
                <li>Cadastrar Proprietários</li>
                <li>Alterar Senha</li>
            </ul>
            </p>
        </div>
    </div>
</div>