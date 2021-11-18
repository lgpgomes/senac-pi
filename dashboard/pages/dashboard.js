$('#modal').load('./pages/modal.php');
$('#spinner').hide();
$('#conteudo').load('./pages/home.php');
$('#navside, #navoff').load('./pages/nav.php');


$(document).ajaxStart(function(){
    $('#spinner').show();
 }).ajaxStop(function(){
    $('#spinner').hide();
 });

 function hiddenAlert () {
     $('.alert').addClass('d-none');
 }

function btnclick(_url){
    $.ajax({
        url : _url,
        type : 'post',
        success: function(){
           $('#conteudo').load(_url);
        }
    });
}

function btncliente(obj){
    $('#editarCliente').modal('show');
    $tr = $(obj).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#editIdCliente').val(data[0]);
    $('#editNomeCliente').val(data[1]);
    $('#editEmailCliente').val(data[2]);
}

function btnfunc(obj){
    $('#editarFuncionario').modal('show');
    $tr = $(obj).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#editIdFuncionario').val(data[0]);
    $('#editNomeFuncionario').val(data[1]);
    $('#editEmailFuncionario').val(data[2]);
}

function btnserv(obj){
    $('#editarServico').modal('show');
    $tr = $(obj).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#editIdServico').val(data[0]);
    $('#editDescricaoServico').val(data[1]);
}

function statusAgend(id, status) {
$.ajax({
    type: "POST",
    url: "./dashboard.php",
    data: { idAgend: id, statusAgend: status},
    success: function() {
        btnclick('./pages/agendamentos.php');
    }
});
}

function statusServ(id, status) {
$.ajax({
    type: "POST",
    url: "./util/teste.php",
    data: { idServ: id, statusServ: status },
    success: function(data) {
        btnclick('./pages/servicos.php');

    }
});
}
function statusUser(id, status, page) {
    $.ajax({
    type: "POST",
    url: "./util/teste.php",
    data: { idUser: id, statusUser: status },
    success: function(data) {
        btnclick(page);
    }
});
}

$(document).on("submit", "#editFunc", function (e){
    e.preventDefault();
    var nome = $('#editNomeFuncionario').val();
    var senha = $('#editSenhaFuncionario').val();
    var c_senha = $('#editSenhaFuncionario').val();
    var id = $('#editIdFuncionario').val();
    $.ajax({
        url: './util/teste.php',
        method: 'POST',
        data: {editNomeUser: nome, editSenhaUser: senha, editCsenhaUser: c_senha, editIdUser: id},
        dataType: 'json',
        success: function(data) {
            alertData(data);
        },
    })
    btnclick('./pages/funcionarios.php');
    $('#editarFuncionario').modal('hide');
    $("#editFunc").trigger("reset");
});

$(document).on("submit", "#editCliente", function (e){
    e.preventDefault();
    var nome = $('#editNomeCliente').val();
    var senha = $('#editSenhaCliente').val();
    var c_senha = $('#editCSenhaCliente').val();
    var id = $('#editIdCliente').val();
    $.ajax({
        url: './util/teste.php',
        method: 'POST',
        data: {editNomeUser: nome, editSenhaUser: senha, editCsenhaUser: c_senha, editIdUser: id},
        dataType: 'json',
        success: function(data) {
            alertData(data);
        },
    })
    btnclick('./pages/clientes.php');
    $('#editarCliente').modal('hide');
    $("#editCliente").trigger("reset");
});

$(document).on("submit", "#editServ", function (e){
    e.preventDefault();
    var id = $('#editIdServico').val();
    var descricao = $('#editDescricaoServico').val();
    var img_data = $('#editImagemServico').prop('files')[0];
    var icon_data = $('#editIconeServico').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('imagem', img_data);
    form_data.append('icone', icon_data);
    form_data.append('editDescricaoServico', descricao);
    form_data.append('editIdServico', id);
    $.ajax({
        url: './util/teste.php', 
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        dataType: 'json',
        success: function(data) {
            alertData(data);
        }
     });
     btnclick('./pages/servicos.php');
     $('#editarServico').modal('hide');
     $("#editServ").trigger("reset");
});

$(document).on("submit", "#cadServ", function (e){
    e.preventDefault();
    var cadDescricao = $('#cadDescricaoServico').val();
    var img_data = $('#cadImagemServico').prop('files')[0];
    var icon_data = $('#cadIconeServico').prop('files')[0];
    var form_data = new FormData();                  
    form_data.append('imagem', img_data);
    form_data.append('icone', icon_data);
    form_data.append('cadDescricaoServico', cadDescricao);
    $.ajax({
        url: './util/teste.php', 
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        dataType: 'json',
        success: function(data) {
            alertData(data);
        },
     });
     btnclick('./pages/servicos.php');
     $('#popupServico').modal('hide');
});

$(document).on("submit", "#cadFunc", function (e){
    e.preventDefault();
    var nome = $('#cadNomeFuncionario').val();
    var email = $('#cadEmailFuncionario').val();
    var senha = $('#cadSenhaFuncionario').val();
    var c_senha = $('#cadCSenhaFuncionario').val();
    $.ajax({
        url: './util/teste.php',
        method: 'POST',
        data: {cadNomeFunc: nome, cadEmailFunc: email, cadSenhaFunc: senha, cadCsenhaFunc: c_senha},
        dataType: 'json',
        success: function(data) {
            alertData(data);
        }
    })
    btnclick('./pages/funcionarios.php'); 
    $('#popupFuncionario').modal('hide');
});

$(document).on("submit", "#cadClient", function (e){
    e.preventDefault();
    var nome = $('#cadNomeCliente').val();
    var email = $('#cadEmailCliente').val();
    var senha = $('#cadSenhaCliente').val();
    var c_senha = $('#cadCSenhaCliente').val();

    $.ajax({
        url: './util/teste.php',
        method: 'POST',
        data: {cadNomeClient: nome, cadEmailClient: email, cadSenhaClient: senha, cadCsenhaClient: c_senha},
        dataType: 'json',
        success: function(data) {
            alertData(data);
        },
    })
    btnclick('./pages/clientes.php');        
    $('#popupCliente').modal('hide');
});

$(document).on("submit", "#agendar", function (e){
    e.preventDefault();
    var idFuncionario = $('#profissional').val();
    var idServico = $('#servico').val();
    var date = $('#data').val();
    var time = $('#hora').val();
    $.ajax({
        url: './util/teste.php',
        method: 'POST',
        data: {date: date, time: time, idServico: idServico, idFuncionario: idFuncionario},
        dataType: 'json',
        success: function(data) {
            alertData(data);
        },
    })
    btnclick('./pages/home.php');        
    $('#popupAgendamento').modal('hide');

});

function alertData(data) {
    if (data.event == 1) {
        $( ".alert" ).removeClass("d-none alert-danger").addClass( "alert-success" );
        $("#msg").html(data.msg);
        
    } else {
        $( ".alert" ).removeClass("d-none alert-success").addClass( "alert-danger" );
        $("#msg").html(data.msg);
    }
    setTimeout(function() {
        $(".alert").addClass('d-none');
    }, 6000);
}