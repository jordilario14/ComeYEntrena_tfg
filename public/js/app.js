

$(document).ready(function() {

    $(".addExercise").on("click", function() {
        let modal_add_exercise = new bootstrap.Modal(document.getElementById('add-exercise-modal'), {
            keyboard: false
        })
        modal_add_exercise.toggle();
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
                    if (response.error==false) {
                        alert("Ejercicio eliminado correctamente.");
                        location.href = response.route;
                    }else{
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
                if (response.error==false) {
                    alert("Ejercicio creado correctamente.");
                    location.href = response.route;
                }else{
                    let check = `${Object.keys(response.messages)[0]}`;
                    alert(response.messages[check]);
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
                if (response.error==false) {
                    alert("Ejercicio modificado correctamente.");
                    location.href = response.route;
                }else{
                    let check = `${Object.keys(response.messages)[0]}`;
                    
                    switch (check) {
                        case "name":
                        case "muscleGroup":
                            alert(response.messages[check]);
                            break;
                        default:
                            alert(response.messages);
                            break;
                    }
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
                    let check = `${Object.keys(response.messages)[0]}`;
                    
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
                $("#loading-login-hidden").addClass("loading-login-hidden");
            }
        });

    });
});