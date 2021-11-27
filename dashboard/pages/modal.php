
<?php 
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';

$funcionariosAtivos = obterUsuarios(TIPO_USUARIO_FUNCIONARIO, STATUS_USUARIO_ATIVO);
$servicos = obterServicos(STATUS_SERVICO_ATIVO);
?>
<!--Modal Agendamento-->
<div class="modal fade" id="popupAgendamento" tabindex="-1" aria-labelledby="popupAgendamentoLabel">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Faça Seu Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-agendamento" id="agendar">
                    <div class="row g-3 align-items-center">
                        <div class="col-sm-6">
                            <select name="profissional" id="profissional" class="form-select" required >
                                <option value="" selected disabled>Profissional</option>
                                <?php foreach($funcionariosAtivos as $row) {?>
                                        <option value="<?php echo $row['ID'];?>"><?php echo $row['NOME']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="servico" id="servico" class="form-select" required>
                                <option value="" selected disabled>Serviço</option>
                                    <?php foreach($servicos as $row) {?>
                                        <option value="<?php echo $row['ID'];?>"><?php echo $row['DESCRICAO']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="date" name="date" min="<?php echo date('Y-m-d');?>" max="2022-12-25" class="form-control" id="data" required >
                        </div>
                        <div class="col-sm-6" >
                            <select name="time" id="hora" class="form-select" >
                                <option value="" selected disabled>Horário</option>
                                <option value="08:00:00">8:00</option>
                                <option value="08:30:00">8:30</option>
                                <option value="09:00:00">9:00</option>
                                <option value="09:30:00">8:30</option>
                                <option value="10:00:00">10:00</option>
                                <option value="10:30:00">10:30</option>
                                <option value="11:00:00">11:00</option>
                                <option value="11:30:00">11:30</option>
                                <option value="12:00:00">12:00</option>
                                <option value="12:30:00">12:30</option>
                                <option value="13:00:00">13:00</option>
                                <option value="13:30:00">13:30</option>
                                <option value="14:00:00">14:00</option>
                                <option value="14:30:00">14:30</option>
                                <option value="15:00:00">15:00</option>
                                <option value="15:30:00">15:30</option>
                                <option value="16:00:00">16:00</option>
                                <option value="15:30:00">16:30</option>
                                <option value="17:00:00">17:00</option>
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
                <input type="submit"  name="agendamento" form="agendar" class="btn btn-primary" value="Agendar Agora">
            </div>
        </div>
    </div>
</div>
<!--Modal Cadastrar Funcionario-->
<?php if ($tipo == 0) {?>
<div class="modal fade" id="popupFuncionario" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form method="POST" id="cadFunc">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nome" id="cadNomeFuncionario" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control"  name="email" id="cadEmailFuncionario"  placeholder="Email" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" id="cadSenhaFuncionario"  placeholder="Senha" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" id="cadCSenhaFuncionario" placeholder="Confirmar Senha" required>
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
<!--Modal Cadastrar Servico-->
<div class="modal fade" id="popupServico" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form method="POST" id="cadServ" enctype="multipart/form-data">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="descricao" id="cadDescricaoServico" placeholder="Nome do Serviço" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="imagem">Escolha A Imagem</label>
                        <input type="file" class="form-control" accept="image/jpg" name="imagem" id="cadImagemServico" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="icone">Escolha O Icone</label>
                        <input type="file" class="form-control" accept="image/png" name="icone" id="cadIconeServico" required>
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
<!--Modal Cadastrar Cliente-->
<div class="modal fade" id="popupCliente" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title">Cadastrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form method="POST" id="cadClient"> 
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nome" id="cadNomeCliente" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" id="cadEmailCliente" placeholder="Email" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" id="cadSenhaCliente" placeholder="Senha" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" id="cadCSenhaCliente" placeholder="Confirmar Senha">
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
<!--Modal Editar Funcionario-->
<div class="modal fade" id="editarFuncionario" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form id="editFunc">
                <div class="row g-3 justify-content-center">
                <input type="hidden" name="id" id="editIdFuncionario">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nome" id="editNomeFuncionario" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control"  name="email" id="editEmailFuncionario" placeholder="Email"  disabled>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" id="editSenhaFuncionario" placeholder="Senha" >
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" id="editCSenhaFuncionario" placeholder="Confirmar Senha" >
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="editfuncionario" form="editFunc" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>
<!--Modal Editar Cliente-->
<div class="modal fade" id="editarCliente" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form action="dashboard.php" method="POST" id="editCliente">
                <div class="row g-3 justify-content-center">
                <input type="hidden" name="id" id="editIdCliente">
                    <div class="col-sm-12">
                        <input type="nome" class="form-control" name="nome" id="editNomeCliente" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="email" class="form-control"  name="email" id="editEmailCliente" placeholder="Email" required disabled>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="senha" id="editSenhaCliente" placeholder="Senha">
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirmar_senha" id="editCSenhaCliente" placeholder="Confirmar Senha" >
                    </div>
                </div>
            </form> 
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" name="editCliente" form="editCliente" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>
<!--Modal Editar Servico-->
<div class="modal fade" id="editarServico" tabindex="-1">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
            <form method="POST" id="editServ" enctype="multipart/form-data">
                <input type="hidden" id="editIdServico">
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
<?php } ?>