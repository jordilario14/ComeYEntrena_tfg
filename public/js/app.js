$( document ).ready(function() {
    $("#login-link, #login-link-body").on("click", function () {
        let modal_login = new bootstrap.Modal(document.getElementById('login-modal'), {
            keyboard: false
          })
        modal_login.toggle();
    });
});