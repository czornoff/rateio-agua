<? $_SESSION['id_cliente'] = null; ?>
<div class="row mt-1 g-1">
    <div class="col-lg-10 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><b>Clientes</b></h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <?
                            if($_GET['action'] == "add"){
                        ?>
                            <form method="POST" action="./?clientes&action=adicionar">
                                <input type="hidden" id="id" name="id" value="<? echo $row['id']; ?>">
                                <input type="hidden" id="id_credenciado" name="id_credenciado" value="<? echo $row['id_credenciado'] ?: $_SESSION['ID']; ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="nome" class="form-label"><small><b>Nome *</b> <small>obrigatório</small></small></label>
                                        <input type="text" class="form-control" id="nome" name="nome" required value="<? echo $row['nome']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cpfcnpj" class="form-label"><small><b>CPF/CNPJ *</b> <small>obrigatório</small></small></label>
                                        <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" required value="<? echo $row['cpfcnpj']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="nascimento" class="form-label"><small><b>Nascimento/Fundação</b></small></label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento" value="<? echo $row['cpfcnpj']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="genero" class="form-label"><small><b>Gênero</b></small></label>
                                        <select class="form-control" id="genero" name="genero" value="<? echo $row['uf']; ?>">
                                            <option value="">Selecione</option>
                                            <option value="F"<? echo $row['genero'] == 'F' ? ' selected' : ''; ?>>Feminino</option>
                                            <option value="M"<? echo $row['genero'] == 'M' ? ' selected' : ''; ?>>Masculino</option>
                                            <option value="O"<? echo $row['genero'] == 'O' ? ' selected' : ''; ?>>Outro</option>
                                            <option value="N"<? echo $row['genero'] == 'N' ? ' selected' : ''; ?>>Não declarar</option>
                                        </select>
                                            
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="celular" class="form-label"><small><b>Celular</b></small></label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="<? echo $row['celular']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telefone" class="form-label"><small><b>Telefone</b></small></label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" value="<? echo $row['telefone']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label"><small><b>Email *</b> <small>obrigatório</small></small></label>
                                        <input type="email" class="form-control" id="email" name="email" required value="<? echo $row['email']; ?>">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="logradouro" class="form-label"><small><b>Logradouro</b></small></label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro" value="<? echo $row['logradouro']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="numero" class="form-label"><small><b>Número</b></small></label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="<? echo $row['numero']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="complemento" class="form-label"><small><b>Complemento</b></small></label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="<? echo $row['complemento']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bairro" class="form-label"><small><b>Bairro</b></small></label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" value="<? echo $row['bairro']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cidade" class="form-label"><small><b>Cidade</b></small></label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" value="<? echo $row['cidade']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="estado" class="form-label"><small><b>Estado</b></small></label>
                                        <select class="form-control" id="estado" name="estado" value="<? echo $row['uf']; ?>">
                                            <option value="">Selecione</option>
                                            <option value="AC"<? echo $row['uf'] == 'AC' ? ' selected' : ''; ?>>Acre</option>
                                            <option value="AL"<? echo $row['uf'] == 'AL' ? ' selected' : ''; ?>>Alagoas</option>
                                            <option value="AP"<? echo $row['uf'] == 'AP' ? ' selected' : ''; ?>>Amapá</option>
                                            <option value="AM"<? echo $row['uf'] == 'AM' ? ' selected' : ''; ?>>Amazonas</option>
                                            <option value="BA"<? echo $row['uf'] == 'BA' ? ' selected' : ''; ?>>Bahia</option>
                                            <option value="CE"<? echo $row['uf'] == 'CE' ? ' selected' : ''; ?>>Ceará</option>
                                            <option value="DF"<? echo $row['uf'] == 'DF' ? ' selected' : ''; ?>>Distrito Federal</option>
                                            <option value="ES"<? echo $row['uf'] == 'ES' ? ' selected' : ''; ?>>Espírito Santo</option>
                                            <option value="GO"<? echo $row['uf'] == 'GO' ? ' selected' : ''; ?>>Goiás</option>
                                            <option value="MA"<? echo $row['uf'] == 'MA' ? ' selected' : ''; ?>>Maranhão</option>
                                            <option value="MT"<? echo $row['uf'] == 'MT' ? ' selected' : ''; ?>>Mato Grosso</option>    
                                            <option value="MS"<? echo $row['uf'] == 'MS' ? ' selected' : ''; ?>>Mato Grosso do Sul</option>
                                            <option value="MG"<? echo $row['uf'] == 'MG' ? ' selected' : ''; ?>>Minas Gerais</option>
                                            <option value="PA"<? echo $row['uf'] == 'PA' ? ' selected' : ''; ?>>Pará</option>
                                            <option value="PB"<? echo $row['uf'] == 'PB' ? ' selected' : ''; ?>>Paraíba</option>
                                            <option value="PR"<? echo $row['uf'] == 'PR' ? ' selected' : ''; ?>>Paraná</option>
                                            <option value="PE"<? echo $row['uf'] == 'PE' ? ' selected' : ''; ?>>Pernambuco</option>    
                                            <option value="PI"<? echo $row['uf'] == 'PI' ? ' selected' : ''; ?>>Piauí</option>
                                            <option value="RJ"<? echo $row['uf'] == 'RJ' ? ' selected' : ''; ?>>Rio de Janeiro</option>
                                            <option value="RN"<? echo $row['uf'] == 'RN' ? ' selected' : ''; ?>>Rio Grande do Norte</option>
                                            <option value="RS"<? echo $row['uf'] == 'RS' ? ' selected' : ''; ?>>Rio Grande do Sul</option>
                                            <option value="RO"<? echo $row['uf'] == 'RO' ? ' selected' : ''; ?>>Rondônia</option>
                                            <option value="RR"<? echo $row['uf'] == 'RR' ? ' selected' : ''; ?>>Roraima</option>
                                            <option value="SC"<? echo $row['uf'] == 'SC' ? ' selected' : ''; ?>>Santa Catarina</option>
                                            <option value="SP"<? echo $row['uf'] == 'SP' ? ' selected' : ''; ?>>São Paulo</option>
                                            <option value="SE"<? echo $row['uf'] == 'SE' ? ' selected' : ''; ?>>Sergipe</option>
                                            <option value="TO"<? echo $row['uf'] == 'TO' ? ' selected' : ''; ?>>Tocantins</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cep" class="form-label"><small><b>CEP</b></small></label>
                                        <input type="text" class="form-control" id="cep" name="cep" value="<? echo $row['cep']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="observacao" class="form-label"><small><b>Observação</b></small></label>
                                        <textarea class="form-control" id="observacao" name="observacao" rows="3"><? echo $row['observacao']; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="px-0 my-3 col-lg-12">
                                    <input type="submit" class="btn btn-block btn-primary" value="Adicionar Cliente">
                                </div>
                            </form>
                            <script>
                                var cpfcnpjMask = function (val) {
                                    return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
                                },
                                options = {
                                    onKeyPress: function(val, e, field, options) {
                                        field.mask(cpfcnpjMask.apply({}, arguments), options);
                                    }
                                };

                                $('#cpfcnpj').mask(cpfcnpjMask, options);
                                $('#celular').mask('(00) 00000-0000');
                                $('#telefone').mask('(00) 0000-0000');
                                $('#cep').mask('00000-000');
                            </script>
                        <?php
                            } elseif($_GET['action'] == "edt"){
                                $_SESSION['id_cliente'] = $_GET['id'];
                                $sql = "SELECT * FROM clientes_cliente WHERE id = '{$_GET['id']}'";
                                $res = mysqli_query($con, $sql);
                                $row = mysqli_fetch_array($res);
                        ?>
                            <form method="POST" action="./?clientes&action=editar">
                                <input type="hidden" id="id" name="id" value="<? echo $row['id']; ?>">
                                <input type="hidden" id="id_credenciado" name="id_credenciado" value="<? echo $row['id_credenciado'] ?: $_SESSION['ID']; ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="nome" class="form-label"><small><b>Nome *</b> <small>obrigatório</small></small></label>
                                        <input type="text" class="form-control" id="nome" name="nome" required value="<? echo $row['nome']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cpfcnpj" class="form-label"><small><b>CPF/CNPJ *</b> <small>obrigatório</small></small></label>
                                        <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" required value="<? echo $row['cpfcnpj']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="nascimento" class="form-label"><small><b>Nascimento/Fundação</b></small></label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento" value="<? echo $row['cpfcnpj']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="genero" class="form-label"><small><b>Gênero</b></small></label>
                                        <select class="form-control" id="genero" name="genero" value="<? echo $row['uf']; ?>">
                                            <option value="">Selecione</option>
                                            <option value="F"<? echo $row['genero'] == 'F' ? ' selected' : ''; ?>>Feminino</option>
                                            <option value="M"<? echo $row['genero'] == 'M' ? ' selected' : ''; ?>>Masculino</option>
                                            <option value="O"<? echo $row['genero'] == 'O' ? ' selected' : ''; ?>>Outro</option>
                                            <option value="N"<? echo $row['genero'] == 'N' ? ' selected' : ''; ?>>Não declarar</option>
                                        </select>
                                            
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="celular" class="form-label"><small><b>Celular</b></small></label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="<? echo $row['celular']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telefone" class="form-label"><small><b>Telefone</b></small></label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" value="<? echo $row['telefone']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label"><small><b>Email *</b> <small>obrigatório</small></small></label>
                                        <input type="email" class="form-control" id="email" name="email" required value="<? echo $row['email']; ?>">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="logradouro" class="form-label"><small><b>Logradouro</b></small></label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro" value="<? echo $row['logradouro']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="numero" class="form-label"><small><b>Número</b></small></label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="<? echo $row['numero']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="complemento" class="form-label"><small><b>Complemento</b></small></label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="<? echo $row['complemento']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bairro" class="form-label"><small><b>Bairro</b></small></label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" value="<? echo $row['bairro']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cidade" class="form-label"><small><b>Cidade</b></small></label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" value="<? echo $row['cidade']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="estado" class="form-label"><small><b>Estado</b></small></label>
                                        <select class="form-control" id="estado" name="estado" value="<? echo $row['uf']; ?>">
                                            <option value="">Selecione</option>
                                            <option value="AC"<? echo $row['uf'] == 'AC' ? ' selected' : ''; ?>>Acre</option>
                                            <option value="AL"<? echo $row['uf'] == 'AL' ? ' selected' : ''; ?>>Alagoas</option>
                                            <option value="AP"<? echo $row['uf'] == 'AP' ? ' selected' : ''; ?>>Amapá</option>
                                            <option value="AM"<? echo $row['uf'] == 'AM' ? ' selected' : ''; ?>>Amazonas</option>
                                            <option value="BA"<? echo $row['uf'] == 'BA' ? ' selected' : ''; ?>>Bahia</option>
                                            <option value="CE"<? echo $row['uf'] == 'CE' ? ' selected' : ''; ?>>Ceará</option>
                                            <option value="DF"<? echo $row['uf'] == 'DF' ? ' selected' : ''; ?>>Distrito Federal</option>
                                            <option value="ES"<? echo $row['uf'] == 'ES' ? ' selected' : ''; ?>>Espírito Santo</option>
                                            <option value="GO"<? echo $row['uf'] == 'GO' ? ' selected' : ''; ?>>Goiás</option>
                                            <option value="MA"<? echo $row['uf'] == 'MA' ? ' selected' : ''; ?>>Maranhão</option>
                                            <option value="MT"<? echo $row['uf'] == 'MT' ? ' selected' : ''; ?>>Mato Grosso</option>    
                                            <option value="MS"<? echo $row['uf'] == 'MS' ? ' selected' : ''; ?>>Mato Grosso do Sul</option>
                                            <option value="MG"<? echo $row['uf'] == 'MG' ? ' selected' : ''; ?>>Minas Gerais</option>
                                            <option value="PA"<? echo $row['uf'] == 'PA' ? ' selected' : ''; ?>>Pará</option>
                                            <option value="PB"<? echo $row['uf'] == 'PB' ? ' selected' : ''; ?>>Paraíba</option>
                                            <option value="PR"<? echo $row['uf'] == 'PR' ? ' selected' : ''; ?>>Paraná</option>
                                            <option value="PE"<? echo $row['uf'] == 'PE' ? ' selected' : ''; ?>>Pernambuco</option>    
                                            <option value="PI"<? echo $row['uf'] == 'PI' ? ' selected' : ''; ?>>Piauí</option>
                                            <option value="RJ"<? echo $row['uf'] == 'RJ' ? ' selected' : ''; ?>>Rio de Janeiro</option>
                                            <option value="RN"<? echo $row['uf'] == 'RN' ? ' selected' : ''; ?>>Rio Grande do Norte</option>
                                            <option value="RS"<? echo $row['uf'] == 'RS' ? ' selected' : ''; ?>>Rio Grande do Sul</option>
                                            <option value="RO"<? echo $row['uf'] == 'RO' ? ' selected' : ''; ?>>Rondônia</option>
                                            <option value="RR"<? echo $row['uf'] == 'RR' ? ' selected' : ''; ?>>Roraima</option>
                                            <option value="SC"<? echo $row['uf'] == 'SC' ? ' selected' : ''; ?>>Santa Catarina</option>
                                            <option value="SP"<? echo $row['uf'] == 'SP' ? ' selected' : ''; ?>>São Paulo</option>
                                            <option value="SE"<? echo $row['uf'] == 'SE' ? ' selected' : ''; ?>>Sergipe</option>
                                            <option value="TO"<? echo $row['uf'] == 'TO' ? ' selected' : ''; ?>>Tocantins</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cep" class="form-label"><small><b>CEP</b></small></label>
                                        <input type="text" class="form-control" id="cep" name="cep" value="<? echo $row['cep']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="observacao" class="form-label"><small><b>Observação</b></small></label>
                                        <textarea class="form-control" id="observacao" name="observacao" rows="3"><? echo $row['observacao']; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="px-0 my-3 col-lg-12">
                                    <input type="submit" class="btn btn-block btn-primary" value="Editar Cliente">
                                </div>
                            </form>
                            <script>
                                var cpfcnpjMask = function (val) {
                                    return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
                                },
                                options = {
                                    onKeyPress: function(val, e, field, options) {
                                        field.mask(cpfcnpjMask.apply({}, arguments), options);
                                    }
                                };

                                $('#cpfcnpj').mask(cpfcnpjMask, options);
                                $('#celular').mask('(00) 00000-0000');
                                $('#telefone').mask('(00) 0000-0000');
                                $('#cep').mask('00000-000');
                            </script>
                        <?
                            } elseif($_GET['action'] == "del"){
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Atenção!</h4>
                                <p>Tem certeza que deseja excluir este cliente?</p>
                                <hr>
                                <p class="mb-0">
                                    <a href="./?clientes&action=deletar&id=<? echo $_GET['id']; ?>" class="btn btn-sm btn-danger">Sim, excluir</a>
                                    <a href="./?clientes" class="btn btn-sm btn-secondary">Não, voltar</a>
                                </p>
                            </div>
                        <?
                            } elseif($_GET['action'] == "shw"){
                                $_SESSION['id_cliente'] = $_GET['id'];
                                $sql = "SELECT * FROM clientes_cliente WHERE id = '{$_GET['id']}'";
                                $res = mysqli_query($con, $sql);
                                $row = mysqli_fetch_array($res);
                        ?>
                            <div class="row">
                                <div class="col-md-6 small">
                                    <div class='card p-3'>
                                        <h5 class="card-title"><b>Dados do Cliente</b></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="badge bg-secondary">Nome</span><br><? echo $row['nome']; ?>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="badge bg-secondary">CPF/CNPJ</span><br><? echo $row['cpfcnpj'] ?>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="badge bg-secondary">Nascimento</span><br><? echo $row['nascimento'] ? date("d/m/Y", strtotime($row['nascimento'])) : ""; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-secondary">Observação</span><br><? echo nl2br($row['observacao']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 small">
                                    <div class='card p-3'>
                                        <h5 class="card-title"><b>Dados de Contato</b></h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-secondary">Endereço</span><br>
                                                <? echo $row['logradouro'].", ".$row['numero'].($row['complemento'] ? " - ".$row['complemento'] : "")." - ".$row['bairro']."<br>".$row['cidade']." - ".$row['uf']." - ".$row['cep']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <span class="badge bg-secondary">Email</span><br><? echo $row['email']; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="badge bg-secondary">Celular</span><br><? echo $row['celular']; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="badge bg-secondary">Telefone</span><br><? echo $row['telefone']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="agendamentos-tab" data-bs-toggle="tab" data-bs-target="#agendamentos" type="button" role="tab" aria-controls="agendamentos" aria-selected="true">
                                        Agendamentos
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="fc-tab" data-bs-toggle="tab" data-bs-target="#fc" type="button" role="tab" aria-controls="fc" aria-selected="true">
                                        Fichas de Cliente
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="frt-tab" data-bs-toggle="tab" data-bs-target="#frt" type="button" role="tab" aria-controls="frt" aria-selected="true">
                                        Recomendação Terapêutica
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="recibos-tab" data-bs-toggle="tab" data-bs-target="#recibos" type="button" role="tab" aria-controls="recibos" aria-selected="true">
                                        Recibos
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="agendamentos" role="tabpanel" aria-labelledby="agendamentos-tab">
                                    <div class="card p-3 m-3">
                                        <h5><b>Agendamentos</b></h5>
                                        <table class="table table-hover table-sm small">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Local</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                    $sql = "SELECT nome, descricao, data, hora, local, clientes_agendamento.id as id FROM clientes_agendamento inner join clientes_cliente on clientes_agendamento.id_cliente = clientes_cliente.id WHERE clientes_agendamento.id_credenciado = '" . $_SESSION['ID'] . "' AND id_cliente = '{$_GET['id']}' ORDER BY data, hora ASC";
                                                    $res = mysqli_query($con, $sql);
                                                    while($row = mysqli_fetch_array($res)){
                                                        echo "<tr>";
                                                            echo "<td>" . $row['nome'] . "</td>";
                                                            echo "<td>" . $row['data'] . "</td>";
                                                            echo "<td>" . $row['hora'] . "</td>";
                                                            echo "<td>" . $row['local'] . "</td>";
                                                            echo "<td>
                                                                    <div class='btn-group' role='group' aria-label='Ações'>
                                                                        <a href='./?agenda&action=edt&id=" . $row['id'] . "' class='btn btn-sm btn-primary' title='Editar'><i class='fas fa-pen fa-fw'></i></a>
                                                                        <a href='#' class='btn btn-sm btn-danger' title='Excluir'><i class='fas fa-trash fa-fw'></i></a>
                                                                    </div>
                                                                </td>";
                                                        echo "</tr>";
                                                    }   
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="fc" role="tabpanel" aria-labelledby="fc-tab">
                                    <div class="card p-3 m-3">
                                        <h5><b>Ficha do Cliente</b></h5>
                                        <table class="table table-hover table-sm small">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="frt" role="tabpanel" aria-labelledby="frt-tab">
                                    <div class="card p-3 m-3">
                                        <h5><b>Ficha de Recomendação Terapêutica</b></h5>
                                        <table class="table table-hover table-sm small">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="recibos" role="tabpanel" aria-labelledby="recibos-tab">
                                    <div class="card p-3 m-3">
                                        <h5><b>Recibos</b></h5>
                                        <table class="table table-hover table-sm small">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                    <th scope="row">1</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>00/00/0000</td>
                                                    <td>Descrição do atendimento realizado.</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Ações">
                                                            <a href="#" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                                            <a href="#" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                            } elseif($_GET['action'] == "adicionar"){
                                if(!$_POST['id'] && $_POST['nome'] && $_POST['cpfcnpj'] && $_POST['email']){
                                    $uuid = gerarUUID();
                                    $sql = "INSERT INTO clientes_cliente (id, id_credenciado, nome, cpfcnpj, genero, nascimento, celular, telefone, email, logradouro, numero, complemento, bairro, cidade, uf, cep, observacao) VALUES (
                                        '".mysqli_real_escape_string($con, $uuid)."',
                                        '".mysqli_real_escape_string($con, $_POST['id_credenciado'])."',
                                        '".mysqli_real_escape_string($con, $_POST['nome'])."',
                                        '".mysqli_real_escape_string($con, $_POST['cpfcnpj'])."',
                                        '".mysqli_real_escape_string($con, $_POST['genero'])."',
                                        ". (mysqli_real_escape_string($con, $_POST['nascimento']) == "" ? "NULL" : "'".mysqli_real_escape_string($con, $_POST['nascimento'])."'").",
                                        '".mysqli_real_escape_string($con, $_POST['celular'])."',
                                        '".mysqli_real_escape_string($con, $_POST['telefone'])."',
                                        '".mysqli_real_escape_string($con, $_POST['email'])."',
                                        '".mysqli_real_escape_string($con, $_POST['logradouro'])."',
                                        '".mysqli_real_escape_string($con, $_POST['numero'])."',
                                        '".mysqli_real_escape_string($con, $_POST['complemento'])."',
                                        '".mysqli_real_escape_string($con, $_POST['bairro'])."',
                                        '".mysqli_real_escape_string($con, $_POST['cidade'])."',
                                        '".mysqli_real_escape_string($con, $_POST['estado'])."',
                                        '".mysqli_real_escape_string($con, $_POST['cep'])."',
                                        '".mysqli_real_escape_string($con, $_POST['observacao'])."'
                                    )";
                                    $res = mysqli_query($con, $sql);
                                    if($res){
                                        echo '<div class="alert alert-success" role="alert">Cliente adicionado com sucesso!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Erro ao adicionar cliente: '.mysqli_error($conn).'</div>';
                                    }   
                                } else {
                                    echo "<div class='alert alert-danger' role='alert'>
                                        <i class='fas fa-exclamation-triangle'></i> <b>Erro: Campos obrigatórios não foram preenchidos!</b><br>
                                        </div>";
                                }
                                echo "<p class='text-center'><a class='btn btn-block btn-primary' href='./?clientes&action=shw&id=".$uuid."'>Vá para o perfil do cliente</a> <a class='btn btn-block btn-primary' href='./?clientes'>Retorne para a lista de clientes</a></p>";

                            } elseif($_GET['action'] == "editar"){
                                if($_POST['id'] && $_POST['nome'] && $_POST['cpfcnpj'] && $_POST['email']){
                                    $sql = "UPDATE clientes_cliente SET 
                                        id_credenciado = '".mysqli_real_escape_string($con, $_POST['id_credenciado'])."',
                                        nome = '".mysqli_real_escape_string($con, $_POST['nome'])."',
                                        cpfcnpj = '".mysqli_real_escape_string($con, $_POST['cpfcnpj'])."',
                                        genero = '".mysqli_real_escape_string($con, $_POST['genero'])."',
                                        nascimento = ". (mysqli_real_escape_string($con, $_POST['nascimento']) == "" ? "NULL" : "'".mysqli_real_escape_string($con, $_POST['nascimento'])."'").",
                                        celular = '".mysqli_real_escape_string($con, $_POST['celular'])."',
                                        telefone = '".mysqli_real_escape_string($con, $_POST['telefone'])."',
                                        email = '".mysqli_real_escape_string($con, $_POST['email'])."',
                                        logradouro = '".mysqli_real_escape_string($con, $_POST['logradouro'])."',
                                        numero = '".mysqli_real_escape_string($con, $_POST['numero'])."',
                                        complemento = '".mysqli_real_escape_string($con, $_POST['complemento'])."',
                                        bairro = '".mysqli_real_escape_string($con, $_POST['bairro'])."',
                                        cidade = '".mysqli_real_escape_string($con, $_POST['cidade'])."',
                                        uf = '".mysqli_real_escape_string($con, $_POST['estado'])."',
                                        cep = '".mysqli_real_escape_string($con, $_POST['cep'])."',
                                        observacao = '".mysqli_real_escape_string($con, $_POST['observacao'])."',
                                        updated_at = NOW()
                                    WHERE id = '".mysqli_real_escape_string($con, $_POST['id'])."'";
                                    $res = mysqli_query($con, $sql);
                                    if($res){
                                        echo '<div class="alert alert-success" role="alert">Cliente atualizado com sucesso!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Erro ao atualizar cliente: '.mysqli_error($conn).'</div>';
                                    }   
                                } else {
                                    echo "<div class='alert alert-danger' role='alert'>
                                        <i class='fas fa-exclamation-triangle'></i> <b>Erro: Campos obrigatórios não foram preenchidos!</b><br>
                                        </div>";
                                }

                                echo "<p class='text-center'><a class='btn btn-block btn-primary' href='./?clientes&action=shw&id=".$_POST['id']."'>Vá para o perfil do cliente</a> <a class='btn btn-block btn-primary' href='./?clientes'>Retorne para a lista de clientes</a></p>";
                            } elseif($_GET['action'] == "deletar"){
                                if($_GET['id']){
                                    $sql = "DELETE FROM clientes_cliente WHERE id = '".mysqli_real_escape_string($con, $_GET['id'])."'";
                                    $res = mysqli_query($con, $sql);
                                    if($res){
                                        echo '<div class="alert alert-success" role="alert">Cliente excluído com sucesso!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Erro ao excluir cliente: '.mysqli_error($conn).'</div>';
                                    }   
                                } else {
                                    echo "<div class='alert alert-danger' role='alert'>
                                        <i class='fas fa-exclamation-triangle'></i> <b>Erro: ID do cliente não foi fornecido!</b><br>
                                        </div>";
                                }
                                echo "<p class='text-center'><a class='btn btn-block btn-primary' href='./?clientes'>Retorne para a lista de clientes</a></p>";
                            } else {
                        ?>
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col" class="d-none d-md-table-cell">CPF/CNPJ</th>
                                        <th scope="col" class="d-none d-lg-table-cell">Cidade/UF</th>
                                        <th scope="col" class="d-none d-lg-table-cell">Telefone</th>
                                        <th scope="col" class="d-none d-lg-table-cell">Email</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?
                            $sql = "SELECT id, id_credenciado, nome, cpfcnpj, cidade, uf, celular, email FROM clientes_cliente WHERE id_credenciado = '".mysqli_real_escape_string($con, $_SESSION['ID'])."' ORDER BY nome ASC";
                            $res = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($res)){
                        ?>

                                <tr>
                                    <td><? echo $row['nome']; ?></td>
                                    <td class="d-none d-md-table-cell"><? echo $row['cpfcnpj']; ?></td>
                                    <td class="d-none d-lg-table-cell"><? echo $row['cidade']; ?>/<? echo $row['uf']; ?></td>
                                    <td class="d-none d-lg-table-cell"><? echo $row['celular']; ?></td>
                                    <td class="d-none d-lg-table-cell"><? echo $row['email']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Ações">
                                            <a href="./?clientes&action=shw&id=<? echo $row['id']; ?>" class="btn btn-sm btn-success" title="Acessar"><i class="fas fa-file fa-fw"></i></a>
                                            <a href="./?clientes&action=edt&id=<? echo $row['id']; ?>" class="btn btn-sm btn-primary" title="Editar"><i class="fas fa-pen fa-fw"></i></a>
                                            <a href="./?clientes&action=del&id=<? echo $row['id']; ?>" class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash fa-fw"></i></a>
                                        </div>
                                    </td>
                                </tr>
                        <?
                                }
                        ?>
                            </tbody>
                        </table>
                        <?
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-12">
        <div class="list-group">
            <a href="./?clientes&action=add" class="list-group-item list-group-item-action"><i class="fas fa-plus fa-fw"></i> Adicionar</a>
            <? if (isset($_SESSION['id_cliente'])) { ?>
                <a href="./?clientes&action=edt&id=<? echo $_SESSION['id_cliente']; ?>" class="list-group-item list-group-item-action"><i class="fas fa-pen fa-fw"></i> Editar</a>
                <a href="./?clientes&action=del&id=<? echo $_SESSION['id_cliente']; ?>" class="list-group-item list-group-item-action"><i class="fas fa-trash fa-fw"></i> Excluir</a>
            <? } ?>
            <a href="./?clientes" class="list-group-item list-group-item-action"><i class="fas fa-list fa-fw"></i> Listar</a>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <p class="card-text">
                Aqui você pode gerenciar os clientes cadastrados no sistema.<br>
                Utilize as opções para adicionar novos clientes, editar informações existentes ou remover clientes que não são mais necessários.<br>
                Mantenha os dados dos clientes atualizados para um melhor atendimento!
                </p>
            </div>
        </div>
    </div>
