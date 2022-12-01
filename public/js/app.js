$(document).ready(function() {
    $("#login-link, #login-link-body").on("click", function() {
        let modal_login = new bootstrap.Modal(document.getElementById('login-modal'), {
            keyboard: false
        })
        modal_login.toggle();
    });

    $(".btn-header").on("click", function() {
        let target = $(this).attr('target');
        if (target == "#main-title") {
            window.scrollTo(0, 0);
        } else {
            $.scrollTo(`${target}`, { duration: 400 });
        }
    });

    $("#log-in-button-action").on("click", function() {
        let email_field = $("#email").val();
        let password_field = $("#password").val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/login",
            type: "POST",
            data: {
                email: email_field,
                password: password_field,
                _token: _token
            },
            success: function(response) {
                console.log(response.messages);
                if (response.logged == true) {
                    location.href = "/home";
                } else {
                    let check = `${Object.keys(response.messages)[0]}`;
                    console.log(check);
                    switch (check) {
                        case "email":
                        case "password":
                            alert(response.messages[check]);
                            break;
                        default:
                            alert(response.messages);
                            break;
                    }
                }

                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");

            }
        });

    });
});