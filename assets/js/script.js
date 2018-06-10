$(function() {
    $('.add_tab').on('click', function() {
        var chatName = window.prompt("Qual a sala que você deseja entrar?");
        chat.setGroup(1, chatName);
    });
});