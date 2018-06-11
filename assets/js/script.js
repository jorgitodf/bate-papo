function abrirChat() {
    var cid = $('#chat_id').val();
    var cnm = $('#chat_nome').val();
    chat.setGroup(cid, cnm);
    $('.modal_bg').hide();
}

function fecharModal() {
    $('.modal_bg').hide();
}

$(function() {
    $('.add_tab').on('click', function() {
        /*var chatName = window.prompt("Qual a sala que você deseja entrar?");
        chat.setGroup(1, chatName); */
        var html = '<h2>Escolha uma Sala de Bate Papo</h2>';
        //var html = '<input type="text" id="chat_id" placeholder="Digite o ID do Chat: " /></br></br>';
        //html += '<input type="text" id="chat_nome" placeholder="Digite o NOME do Chat: " /></br></br>';
        //html += '<button onclick="abrirChat()">Abrir</button></br></br><hr>';
        html += '<div id="groupList">Carregando...</div>'
        html += '<hr/><button onclick="fecharModal()">Fechar Janela</button>'

        $('.modal_area').html(html);
        $('.modal_bg').show();
        chat.loadGroupList('groupList');
    });
});