/* function abrirChat() {
    var cid = $('#chat_id').val();
    var cnm = $('#chat_nome').val();
    chat.setGroup(cid, cnm);
    $('.modal_bg').hide();
} */
function addGroupModal() {
    var html = '<h2>Criar Nova Sala</h2>';

    html += '<input type="text" id="newGroupName" placeholder="Digite o nome da nova Sala" /><br/><br/>';
    html += '<button id="newGroupButton">Cadastrar</button><br/>';
    html += '<hr/><button onclick="fecharModal()">Fechar Janela</button>';

    $('.modal_area').html(html);
    $('.modal_bg').show();

    $('#newGroupButton').on('click', function() {
        var newGroupName = $('#newGroupName').val();
        if (newGroupName != '') {
            chat.addNewGroup(newGroupName, function(json) {
                if (json.error == '0') {
                    $('.add_tab').click();
                } else {
                    alert(json.errorMsg);
                }
            });
        }
    });
}

function fecharModal() {
    $('.modal_bg').hide();
}

$(function() {

    chat.chatActivity();

    $('.add_tab').on('click', function() {
        /*var chatName = window.prompt("Qual a sala que você deseja entrar?");
        chat.setGroup(1, chatName); */
        var html = '<h2>Escolha uma Sala de Bate Papo</h2>';
        //var html = '<input type="text" id="chat_id" placeholder="Digite o ID do Chat: " /></br></br>';
        //html += '<input type="text" id="chat_nome" placeholder="Digite o NOME do Chat: " /></br></br>';
        //html += '<button onclick="abrirChat()">Abrir</button></br></br><hr>';
        html += '<div id="groupList">Carregando...</div>';
        html += '<hr/><button onclick="addGroupModal()">Nova Sala</button><button onclick="fecharModal()">Fechar Janela</button>';

        $('.modal_area').html(html);
        $('.modal_bg').show();

        chat.loadGroupList(function(json) {
            var html = '';
            for(var i in json.groups) {
                html += '<button data-id="' + json.groups[i].id + '">' + json.groups[i].name + '</button>';    
            }
            $('#groupList').html(html);
            $('#groupList').find('button').on('click', function() {
                var cid = $(this).attr('data-id');
                var cnm = $(this).text();
                chat.setGroup(cid, cnm);
                $('.modal_bg').hide();
            });
        });
    });

    $('nav ul').on('click', 'li', function() {
        var id = $(this).attr('data-id');
        chat.setActiveGroup(id); 
    });

    $('#sender_input').on('keyup', function(e){
        if (e.keyCode == 13) {
            var msg = $(this).val();
            $(this).val('');
            chat.sendMessage(msg);
        }
    });
});