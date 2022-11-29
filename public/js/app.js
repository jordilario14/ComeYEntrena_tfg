$( document ).ready(function() {
    $("#login-link, #login-link-body").on("click", function () {
        let modal_login = new bootstrap.Modal(document.getElementById('login-modal'), {
            keyboard: false
          })
        modal_login.toggle();
    });

    $(".btn-header").on("click", function () {
        let target = $(this).attr('target');
        if (target == "#main-title") {
            window.scrollTo(0, 0);
        }else{
            $.scrollTo(`${target}`, { duration:400 });
        }
    })
});