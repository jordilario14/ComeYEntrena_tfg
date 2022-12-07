$(document).ready(function() {

    $(".link-profile").on("click", function() {
        let target = $(this).attr("target");

        $("#aboutMe").addClass('link-profile-hidden');
        $("#security").addClass('link-profile-hidden');
        $("#myData").addClass('link-profile-hidden');

        $(target).removeClass('link-profile-hidden');

        $('.link-profile').removeClass('current');
        $(this).addClass('current');
    });

    $(".addExercise").on("click", function() {
        let modal_add_exercise = new bootstrap.Modal(document.getElementById('add-exercise-modal'), {
            keyboard: false
        })
        modal_add_exercise.toggle();
    });

    $(".addAliment").on("click", function() {
        let modal_add_aliment = new bootstrap.Modal(document.getElementById('add-aliment-modal'), {
            keyboard: false
        })
        modal_add_aliment.toggle();
    });


    $(".addClient").on("click", function() {
        let modal_add_client = new bootstrap.Modal(document.getElementById('add-client-modal'), {
            keyboard: false
        })
        modal_add_client.toggle();
    });


    $(".editExercise").on("click", function() {

        let target = $(this).attr('target');
        let object = exercises[parseInt(target)];

        $("#name-edit").val(object['name']);
        $("#muscle-group-edit").val(object['muscle_group']);
        $("#exercise-id-edit").val(object['id']);


        let modal_add_exercise = new bootstrap.Modal(document.getElementById('edit-exercise-modal'), {
            keyboard: false
        })
        modal_add_exercise.toggle();
    });

    $(".editAliment").on("click", function() {

        let target = $(this).attr('target');
        let object = aliments[parseInt(target)];

        $("#name-edit").val(object['name']);
        $("#kcal-edit").val(object['kcal']);
        $("#prot-edit").val(object['protein']);
        $("#lip-edit").val(object['lipids']);
        $("#gluc-edit").val(object['glucids']);
        $("#aliment-id-edit").val(object['id']);


        let modal_add_aliment = new bootstrap.Modal(document.getElementById('edit-aliment-modal'), {
            keyboard: false
        })
        modal_add_aliment.toggle();
    });

    $(".viewExercise").on("click", function() {

        let target = $(this).attr('target');
        let object = exercises[parseInt(target)];

        $("#name-view").html(object['name']);
        $("#muscle-group-view").html(object['muscle_group']);

        let modal_add_exercise = new bootstrap.Modal(document.getElementById('view-exercise-modal'), {
            keyboard: false
        })
        modal_add_exercise.toggle();
    });

    $(".viewClient").on("click", function() {

        let target = $(this).attr('target');
        let object = clients[parseInt(target)];
        console.log(object);
        $("#name-view").html(object['name']);
        $("#surname-view").html(object['surname'] == null ? "N/A" : object['surname']);
        $("#tel-view").html(object['tf_number'] == null ? "N/A" : object['tf_number']);

        $("#email-view").html(object['email']);
        $("#weight-view").html(object['weight'] == null ? "N/A" : object['weight']);
        $("#height-view").html(object['height'] == null ? "N/A" : object['height']);
        $("#interests-view").html(object['my_interests'] == null ? "N/A" : object['my_interests']);
        $("#about-view").html(object['about_me'] == null ? "N/A" : object['about_me']);
        $("#state-view").html(object['disabled'] == 0 ? "Habilitado" : "Deshabilitado");


        let modal_view_client = new bootstrap.Modal(document.getElementById('view-client-modal'), {
            keyboard: false
        })
        modal_view_client.toggle();
    });


    $(".viewAliment").on("click", function() {

        let target = $(this).attr('target');
        let object = aliments[parseInt(target)];
        console.log(object);
        $("#name-view").html(object['name']);
        $("#kcal-view").html(object['kcal']);
        $("#prot-view").html(object['protein']);
        $("#gluc-view").html(object['glucids']);
        $("#lip-view").html(object['lipids']);
        let modal_add_aliment = new bootstrap.Modal(document.getElementById('view-aliment-modal'), {
            keyboard: false
        })
        modal_add_aliment.toggle();
    });


    $(".removeExercise").on("click", function() {
        if (confirm('¿Está seguro de que desea eliminar este ejercicio?')) {
            let exercise = parseInt($(this).attr('target'));
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-exercise",
                type: "POST",
                data: {
                    exercise: exercise,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Ejercicio eliminado correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicación con el servidor.");
                }
            });

        }
    });

    $(".removeAliment").on("click", function() {
        if (confirm('¿Está seguro de que desea eliminar este alimento?')) {
            let aliment = parseInt($(this).attr('target'));
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-aliment",
                type: "POST",
                data: {
                    aliment: aliment,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Alimento eliminado correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicación con el servidor.");
                }
            });

        }
    });
    $(".banUnbanClient").on("click", function() {
        let client = parseInt($(this).attr('target'));
        let clientArr = parseInt($(this).attr('arrTarget'));

        if (confirm(clients[clientArr]['disabled'] == 0 ? '¿Está seguro de que desea deshabilitar a este cliente?' : '¿Está seguro de que desea habilitar a este cliente?')) {

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/ban-client",
                type: "POST",
                data: {
                    client: client,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert(clients[clientArr]['disabled'] == 0 ? 'Cliente deshabilitado correctamente.' : 'Cliente habilitado correctamente.');
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicación con el servidor.");
                }
            });

        }
    });


    $(".add-exercise-button").on("click", function() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-exercise",
            type: "POST",
            data: {
                name: $("#name-add").val(),
                muscleGroup: $("#muscle-group-add").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Ejercicio creado correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
            }
        });
    });

    $(".edit-exercise-button").on("click", function() {

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-exercise",
            type: "POST",
            data: {
                name: $("#name-edit").val(),
                muscleGroup: $("#muscle-group-edit").val(),
                exercise: parseInt($('#exercise-id-edit').val()),
                _token: _token
            },
            success: function(response) {
                console.log(response);
                if (response.error == false) {
                    alert("Ejercicio modificado correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
            }
        });
    });

    $(".add-aliment-button").on("click", function() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-aliment",
            type: "POST",
            data: {
                name: $("#name-add").val(),
                kcalories: parseInt($("#kcal-add").val()),
                protein: parseInt($("#prot-add").val()),
                lipids: parseInt($("#lip-add").val()),
                glucids: parseInt($("#gluc-add").val()),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Alimento creado correctamente.");
                    location.href = response.route;
                } else {
                    console.log(response);
                    alert(response.messages);

                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
            }
        });
    });

    $(".add-client-button").on("click", function() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-client",
            type: "POST",
            data: {
                name: $("#name-add").val(),
                surname: $("#surname-add").val(),
                tel: $("#tel-add").val(),
                email: $("#email-add").val(),
                weight: $("#weight-add").val(),
                height: $("#height-add").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Cliente dado de alta correctamente. Se ha enviado un mail al cliente con las credenciales.");
                    location.href = response.route;
                } else {
                    alert(response.messages);

                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
            }
        });
    });




    $(".edit-aliment-button").on("click", function() {

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-aliment",
            type: "POST",
            data: {
                name: $("#name-edit").val(),
                kcalories: parseInt($("#kcal-edit").val()),
                protein: parseInt($("#prot-edit").val()),
                lipids: parseInt($("#lip-edit").val()),
                glucids: parseInt($("#gluc-edit").val()),
                aliment: parseInt($("#aliment-id-edit").val()),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Alimento modificado correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
            }
        });
    });


    $(".searchTerm").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".dataToSearch tr").not(':first').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


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

        $("#loading-login-hidden").removeClass("loading-login-hidden");
        //$("#login-modal").addClass("disabled");


        $.ajax({
            url: "/login",
            type: "POST",
            data: {
                email: email_field,
                password: password_field,
                _token: _token
            },
            success: function(response) {
                $("#loading-login-hidden").addClass("loading-login-hidden");

                if (response.logged == true) {
                    location.href = "/home";
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicación con el servidor.");
                $("#loading-login-hidden").addClass("loading-login-hidden");
            }
        });

    });
});
