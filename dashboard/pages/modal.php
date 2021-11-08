
<?php 
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>

<div class="modal fade" id="popupAgendamento" tabindex="-1" aria-labelledby="popupAgendamentoLabel">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Faça Seu Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="dashboard.php" method="POST" class="form-agendamento" id="agendar">
                    <div class="row g-3 align-items-center">
                        <div class="col-sm-6">
                            <input type="date" name="date" min="<?php echo date('Y-m-d');?>" max="2021-12-25" class="form-control" id="data" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="time" name="time" class="form-control" id="hora" required>
                        </div>
                        <div class="col-sm-6">
                            <select name="servico" id="servico" class="form-select" required>
                                <option selected disabled>Serviço</option>
                                    <?php foreach($servicos as $row) {?>
                                        <option value="<?php echo $row['ID'];?>"><?php echo $row['DESCRICAO']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="profissional" id="profissional" class="form-select" required>
                                <option selected disabled>Profissional</option>
                                <?php foreach($funcionarios as $row) {?>
                                        <option value="<?php echo $row['ID'];?>"><?php echo $row['NOME']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Messagem"></textarea>
                            </div>
                        </div>
                    </div>
                </form>      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="agendamento" form="agendar" class="btn btn-primary" value="Agendar Agora">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="popupFuncionario" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="dashboard.php" method="POST" id="cadFunc">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nomeFuncionario" id="nomeFuncionario" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control"  name="email" placeholder="Email" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar Senha" required>
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="cadfuncionario" form="cadFunc" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>
                
<div class="modal fade" id="popupServico" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="dashboard.php" method="POST" id="cadServ" enctype="multipart/form-data">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="descricao" placeholder="Nome do Serviço" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="imagem">Escolha A Imagem</label>
                        <input type="file" class="form-control" accept="image/jpg" name="imagem" id="imagem" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="icone">Escolha O Icone</label>
                        <input type="file" class="form-control" accept="image/png" name="icone" id="icone" required>
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="cadservicos" form="cadServ" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>  

<div class="modal fade" id="popupCliente" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="./cadastrarCliente.php" method="POST" id="cadClient"> 
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar Senha">
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="cadcliente" form="cadClient" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="editarFuncionario" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="dashboard.php" method="POST" id="editFunc">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nomeFuncionario" id="editNameFuncionario" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control"  name="email" id="editEmailFuncionario" placeholder="Email" required disabled>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar Senha" required>
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="cadfuncionario" form="cadFunc" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarServico" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="" method="POST" id="editServ" enctype="multipart/form-data">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="descricao" id="editDescricaoServico" placeholder="Nome do Serviço" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="imagem">Escolha A Imagem</label>
                        <input type="file" class="form-control" accept="image/jpg" id="editImagemServico" name="imagem" id="imagem">
                    </div>
                    <div class="col-sm-12">
                        <label for="icone">Escolha O Icone</label>
                        <input type="file" class="form-control" accept="image/png" id="editIconeServico" name="icone" id="icone">
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="editservicos" form="editServ" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>  