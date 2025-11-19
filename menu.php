<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img src="./assets/img/logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
            Condom�nio
        </div>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navBarMenu" aria-controls="navBarMenu" aria-expanded="false" aria-label="Mostrar Menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navBarMenu">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link<? echo in_array('principal', array_keys($_GET)) ? ' active text-white' : '' ?>" aria-current="page" href="./?principal&action=index"><i class="fas fa-home"></i> Principal</a>
                </li>
                <? if($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link<? echo in_array('unidades', array_keys($_GET)) ? ' active text-white' : '' ?>" href="./?unidades&action=index"><i class="fas fa-calendar-alt"></i> Unidades</a>
                    </li>
                <? } else { ?>
                    <li class="nav-item">
                        <a class="nav-link<? echo in_array('unidades', array_keys($_GET)) ? ' active text-white' : '' ?>" href="./?unidades&action=show"><i class="fas fa-calendar-alt"></i> Unidade</a>
                    </li>
                <? } ?>
                <? if($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link<? echo in_array('condominos', array_keys($_GET)) ? ' active text-white' : '' ?>" href="./?condominos&action=index"><i class="fas fa-users"></i> Condôminos</a>
                    </li> 
                <? } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<? echo in_array('links', array_keys($_GET)) ? ' active text-white' : '' ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-link"></i> Links Úteis
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #e3f2fd;">
                        <a class="nav-link text-secondary" href="https://www.gruporiema.com">
                            <i class="fas fa-link"></i> Riema
                        </a>
                    </ul>
                </li>
            </ul>
            <? if(isset($_SESSION['id'])){ ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown float-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <? if($_SESSION['role'] == 'admin') { 
                                echo '<i class="fas fa-user-cog"></i> '; 
                            } elseif($_SESSION['role'] == 'unidade') { 
                                echo '<i class="fas fa-building"></i> '; 
                            } else {
                                echo '<i class="fas fa-user"></i> '; 
                            }
                            ?>
                            <? echo explode(" ", $_SESSION['nome'])[0]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><div class="small p-2">
                                <?
                                    if($_SESSION['role'] == 'admin') { 
                                        echo 'Administrador'; 
                                    } elseif($_SESSION['role'] == 'unidade') { 
                                        echo preg_replace_callback(
                                            '/bl(\d+)ap(\d+)/i',
                                            function ($correspondencias) {
                                                $numero_bloco = (int)$correspondencias[1];
                                                $numero_apartamento = (int)$correspondencias[2]; 
                                                
                                                if ($numero_bloco === 1) {
                                                    $nome_local = 'Leiden';
                                                } else {
                                                    $nome_local = 'Amsterdan';
                                                }
                                                return "Bloco $numero_bloco ($nome_local)<br>Apartamento $numero_apartamento";
                                            },
                                            $_SESSION['nome']
                                        );
                                    } else {
                                        echo 'Usuário'; 
                                    }
                                ?>
                            </div></li>
                            <li><hr class="dropdown-divider"></li>
                            <a class="dropdown-item nav-link text-secondary<? echo in_array('dados', array_keys($_GET)) ? ' active text-white' : '' ?>" href="./?dados&action=index">
                                <i class="fas fa-address-card"></i> Meus Dados / Perfil
                            </a>    
                            <a class="dropdown-item nav-link text-secondary<? echo in_array('admin', array_keys($_GET)) ? ' active text-white' : '' ?>" href="./?admin&action=index">
                                <i class="fas fa-cogs"></i> Configurações
                            </a>
                            <? if($_SESSION['role'] == 'admin') { ?>
                                <a class="dropdown-item nav-link text-secondary<? echo in_array('log', array_keys($_GET)) ? ' active  text-white' : '' ?>" href="./?log&action=index">
                                    <i class="fas fa-address-card"></i> Registro de Logs
                                </a>
                            <? } ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./logout.php"><i class="fas fa-close"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            <? } ?>
        </div>
    </div>
</nav>