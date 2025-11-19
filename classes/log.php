<?
    $usuarios[0] = "Desconhecido";
?>
<div class="row mt-1 g-1">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5><b>Log de acesso e alteração de dados.</b></h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <table id="tabela-logs" class="display table table-sm small table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Tabela</th>
                                    <th>Dados</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                    $sql = "SELECT * FROM `log` ORDER BY id DESC;";
                                    $r = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_array($r)) {
                                        echo "<tr>";
                                            echo "<td>" . date('d/m/Y H:i:s', strtotime($row['created_at'])) . "</td>";
                                            echo "<td>" . $row['tabela'] . "</td>";
                                            echo "<td>";
                                                $data_array = json_decode($row['log'], true);
                                                foreach ($data_array as $key => $value) {
                                                    echo $key . ': ' . $value . "<br>";
                                                }
                                            echo "</td>";
                                            echo "<td>" . $usuarios[$row['usuario_id']] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tabela-logs').DataTable({
            ordering:  false,
            pageLength: 50,
            "language": {
                "processing":     "Processando...",
                "search":         "Pesquisar:",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "info":           "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 até 0 de 0 registros",
                "infoFiltered":   "(filtrados de _MAX_ registros no total)",
                "infoPostFix":    "",
                "loadingRecords": "Carregando...",
                "zeroRecords":    "Nenhum registro encontrado",
                "emptyTable":     "Nenhum dado disponível na tabela",
                "paginate": {
                    "first":      "Primeiro",
                    "previous":   "Anterior",
                    "next":       "Próximo",
                    "last":       "Último"
                },
                "aria": {
                    "sortAscending":  ": Ordenar a coluna de forma crescente",
                    "sortDescending": ": Ordenar a coluna de forma decrescente"
                }
            }
        });
    });
</script>