
<?php 
require_once '../../banco/banco.php';
require_once '../../usuario/usuario.php';
require_once '../util/connection.php';
?>
<?php
//Adminstrador
if($tipo == 0) {
?>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/home.php')" class="nav-link" id="navlink" tabindex="1">
        <span class="fa fa-home"></span>
        Principal
        </a>
    </li>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/funcionarios.php')" class="nav-link" id="nav-link" tabindex="1">
        <span class="fa fa-suitcase"></span>
        Funcionários
        </a>
    </li>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/.php')" class="nav-link" id="nav-link" tabindex="1">
        <span class="fa fa-users"></span>
        Clientes
        </a>
    </li>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/servicos.php')" class="nav-link" id="nav-link" tabindex="1">
        <span class="fa fa-clipboard"></span>
        Serviços
        </a>
    </li>
<?php } ?>

<?php 
//Funcionário
if($tipo == 1) { 
?>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/home.php')" class="nav-link" id="navlink"  tabindex="1">
        <span class="fa fa-home"></span>
        Principal
        </a>
    </li>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/agendamentos.php')" class="nav-link" id="nav-link"  tabindex="1">
        <span class="fa fa-calendar"></span>
        Agendamentos
        </a>
    </li>
<?php } ?>

<?php 
//Cliente
if($tipo == 2) { 
?>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/home.php')" class="nav-link" id="navlink" tabindex="1">
        <span class="fa fa-home"></span>
        Principal
        </a>
    </li>
    <li class="nav-item">
        <a  onclick="btnclick('./pages/agendamentos.php')" class="nav-link" id="nav-link" tabindex="1">
        <span class="fa fa-calendar"></span>
        Agendamentos
        </a>
    </li>
    <li class="nav-item">
        <a data-bs-toggle="modal" href="#popupAgendamento" class="nav-link" id="nav-link" tabindex="1">
        <span class="fa fa-plus"></span>
        Criar Agendamento
        </a>
    </li>
<?php } ?>

