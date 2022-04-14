$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        var res = confirm('Подтвердите действия');
        if(!res){
            return false;
        }
    });


})


$('#file-upload').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
});
