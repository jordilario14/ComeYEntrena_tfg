$(document).ready(function() {


    $(".edit_exercise_pe").on("click", function() {

        let target = $(this).attr('target');
        let targetma = $(this).attr('targetma');

        let object = user.training_plan.days[target]['day_exercises'][targetma];

        //console.log(user.training_plan.days);

        $('#id_day_edit').val(user.training_plan.days[target]['id']);
        $('#id_day_exercise_edit').val(object['id']);
        //console.log(object);
        $('#name-edit-exercise').val(object['exercise']['id']);
        $("#series-edit-exercise").val(object['series']);
        $("#reps-edit-exercise").val(object['repetitions']);
        $("#rir-edit-exercise").val(object['rir']);


        let modal_edit_exercise_aliment = new bootstrap.Modal(document.getElementById('edit-exercise-pe-modal'), {
            keyboard: false
        })
        modal_edit_exercise_aliment.toggle();
    });

    $(".edit_aliment_pn").on("click", function() {

        let target = $(this).attr('target');
        let targetma = $(this).attr('targetma');

        let object = user.nutritional_plan.meals[target]['meal_aliments'][targetma];

        $('#id_meal_edit').val(user.nutritional_plan.meals[target]['id']);
        $('#id_meal_aliment_edit').val(object['id']);


        $("#name-edit-aliment").val(object['aliment']['id']);
        $("#cuant_edit_aliment").val(object['cuantity']);


        let modal_edit_meal_aliment = new bootstrap.Modal(document.getElementById('edit-aliment-pn-modal'), {
            keyboard: false
        })
        modal_edit_meal_aliment.toggle();
    });

    $(".view_exercise_pe").on("click", function() {

        let target = $(this).attr('target');
        let targetma = $(this).attr('targetma');

        let object = user.training_plan.days[target]['day_exercises'][targetma];

        $("#name-view-exercise-pe").html(object['exercise']['name']);
        $("#series-view-exercise-pe").html(object['series']);
        $('#mc-group-view-exercise-pe').html(object['exercise']['muscle_group']);
        $("#reps-view-exercise-pe").html(object['repetitions']);
        $("#muscl-view-exercise-pe").html(object['exercise']['muscle_group']);
        $("#rir-view-exercise-pe").html(object['rir']);


        let modal_view_day_exercise = new bootstrap.Modal(document.getElementById('view-day-exercise-modal'), {
            keyboard: false
        })
        modal_view_day_exercise.toggle();
    });

    $(".view_aliment_pn").on("click", function() {

        let target = $(this).attr('target');
        let targetma = $(this).attr('targetma');

        let object = user.nutritional_plan.meals[target]['meal_aliments'][targetma];
        //console.log(object);
        $("#name-view-aliment-pn").html(object['aliment']['name']);
        $("#measure-view-aliment-pn").html(object['aliment']['measure']);

        $("#kcal-view-aliment-pn").html(object['aliment']['kcal']);
        $("#protein-view-aliment-pn").html(object['aliment']['protein']);
        $("#lipids-view-aliment-pn").html(object['aliment']['lipids']);
        $("#glucids-view-aliment-pn").html(object['aliment']['glucids']);
        $("#quantity-view-aliment-pn").html(object['cuantity']);


        let modal_view_meal_aliment = new bootstrap.Modal(document.getElementById('view-meal-aliment-modal'), {
            keyboard: false
        })
        modal_view_meal_aliment.toggle();
    });

    $(".remove_exercise_pe").on("click", function() {
        if (confirm('??Est?? seguro de que desea eliminar este ejercicio del d??a?')) {
            let day_exercise = $(this).attr('target');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-exercise-pe",
                type: "POST",
                data: {
                    day_exercise: day_exercise,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Se ha eliminado el ejercicio del d??a correctamente correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                    _token = response.token;
                    $('meta[name="csrf-token"]').attr('content', response.token);
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });
        }
    });

    $(".remove_aliment_pn").on("click", function() {
        if (confirm('??Est?? seguro de que desea eliminar este alimento de la comida?')) {
            let meal_aliment = $(this).attr('target');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-aliment-pn",
                type: "POST",
                data: {
                    meal_aliment: meal_aliment,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Se ha eliminado el alimento de la comida correctamente correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                    _token = response.token;
                    $('meta[name="csrf-token"]').attr('content', response.token);
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });
        }
    });

    $(".removeDay").on("click", function() {
        if (confirm('??Est?? seguro de que desea eliminar este dia?')) {
            let day = $(this).attr('target');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-day",
                type: "POST",
                data: {
                    day: day,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Se ha eliminado el d??a y los ejercicios que conten??a correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                    _token = response.token;
                    $('meta[name="csrf-token"]').attr('content', response.token);
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });
        }
    });

    $(".removeMeal").on("click", function() {
        if (confirm('??Est?? seguro de que desea eliminar esta comida?')) {
            let meal = $(this).attr('target');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/remove-meal",
                type: "POST",
                data: {
                    meal: meal,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        alert("Se ha eliminado la comida y los alimentos que conten??a correctamente.");
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                    _token = response.token;
                    $('meta[name="csrf-token"]').attr('content', response.token);
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });
        }
    });

    $(".edit-exercise-pe-button").on("click", function() {
        let exercise = $('#name-edit-exercise').val();
        let series = $('#series-edit-exercise').val();
        let reps = $('#reps-edit-exercise').val();
        let rir = $('#rir-edit-exercise').val();

        let day = $('#id_day_edit').val();
        let day_exercise = $('#id_day_exercise_edit').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-exercise-pe",
            type: "POST",
            data: {
                exercise: exercise,
                series: series,
                reps: reps,
                rir: rir,
                day: day,
                day_exercise: day_exercise,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert(response.messages);
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".edit-aliment-pn-button").on("click", function() {
        let aliment = $('#name-edit-aliment').val();
        let quantity = parseFloat($('#cuant_edit_aliment').val());
        let meal = $('#id_meal_edit').val();
        let meal_aliment = $('#id_meal_aliment_edit').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-aliment-pn",
            type: "POST",
            data: {
                aliment: aliment,
                quantity: quantity,
                meal: meal,
                meal_aliment: meal_aliment,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert(response.messages);
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });
    $(".add-exercise-pe-button").on("click", function() {
        let exercise = $('#name-add-exercise').val();
        let series = parseInt($('#series-add-exercise').val());
        let reps = parseInt($('#reps-add-exercise').val());
        let rir = $('#rir-add-exercise').val();
        let day = $('#id_day').val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/add-exercise-pe",
            type: "POST",
            data: {
                exercise: exercise,
                series: series,
                reps: reps,
                rir: rir,
                day: day,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert(response.messages);
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });
    $(".add-aliment-pn-button").on("click", function() {
        let aliment = $('#name-add-aliment').val();
        let quantity = parseFloat($('#cuant_add_aliment').val());
        let meal = $('#id_meal').val();

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-aliment-pn",
            type: "POST",
            data: {
                aliment: aliment,
                quantity: quantity,
                meal: meal,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert(response.messages);
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".edit-day-button").on("click", function() {
        let day_note = $('#note-edit-day').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-day",
            type: "POST",
            data: {
                day_note: day_note,
                day_id: $("#id_day").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Se ha modificado la nota del d??a correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });


    $(".edit-meal-button").on("click", function() {
        let meal_note = $('#note-edit-meal').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/edit-meal",
            type: "POST",
            data: {
                meal_note: meal_note,
                meal_id: $("#id_meal").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Se ha modificado la nota de la comida correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".add-day-button").on("click", function() {
        let day_note = $('#note-add-day').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-day",
            type: "POST",
            data: {
                day_note: day_note,
                train_plan: $("#train-plan-id").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Se ha a??adido el d??a correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });


    $(".add-meal-button").on("click", function() {
        let meal_note = $('#note-add-meal').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/add-meal",
            type: "POST",
            data: {
                meal_note: meal_note,
                nutri_plan: $("#nutri-plan-id").val(),
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Se ha a??adido la comida correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });



    $(".addExercisePe").on("click", function() {

        let key = $(this).attr("target");

        $('#id_day').val(user.training_plan.days[key]['id']);

        let modal_add_exercise_pe = new bootstrap.Modal(document.getElementById('add-exercise-pe-modal'), {
            keyboard: false
        })
        modal_add_exercise_pe.toggle();
    });

    $(".addAlimentPn").on("click", function() {

        let key = $(this).attr("target");

        $('#id_meal').val(user.nutritional_plan.meals[key]['id']);

        let modal_add_aliment_pn = new bootstrap.Modal(document.getElementById('add-aliment-pn-modal'), {
            keyboard: false
        })
        modal_add_aliment_pn.toggle();
    });

    $(".addMeal").on("click", function() {
        let modal_add_meal = new bootstrap.Modal(document.getElementById('add-meal-modal'), {
            keyboard: false
        })
        modal_add_meal.toggle();
    });
    $(".addDay").on("click", function() {
        let modal_add_day = new bootstrap.Modal(document.getElementById('add-day-modal'), {
            keyboard: false
        })
        modal_add_day.toggle();
    });


    $(".editDay").on("click", function() {

        let key = $(this).attr("target");

        $('#note-edit-day').val(user.training_plan.days[key]['day_note']);
        $('#id_day').val(user.training_plan.days[key]['id']);

        let modal_edit_day = new bootstrap.Modal(document.getElementById('edit-day-modal'), {
            keyboard: false
        })
        modal_edit_day.toggle();
    });


    $(".editMeal").on("click", function() {

        let key = $(this).attr("target");

        $('#note-edit-meal').val(user.nutritional_plan.meals[key]['meal_note']);
        $('#id_meal').val(user.nutritional_plan.meals[key]['id']);


        let modal_edit_meal = new bootstrap.Modal(document.getElementById('edit-meal-modal'), {
            keyboard: false
        })
        modal_edit_meal.toggle();
    });



    $(".security-btn").on("click", function() {
        if (confirm("??Est?? seguro de que desea realizar estos cambios en su perfil? En caso de que cambie el correo electr??nico, aseg??rese de que est?? bien escrito, ya que es la via de recuperaci??n de contrase??a de la que dispone.")) {
            let email = $('#new-email').val();
            let email_confirmation = $('#new-email_confirmation').val();

            let password = $('#new-password').val();
            let password_confirmation = $('#new-password_confirmation').val();

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/change-security",
                type: "POST",
                data: {
                    email: email,
                    email_confirmation: email_confirmation,
                    password: password,
                    password_confirmation: password_confirmation,
                    _token: _token
                },
                success: function(response) {
                    if (response.error == false) {
                        //console.log(response);
                        alert(response.messages);
                        location.href = response.route;
                    } else {
                        alert(response.messages);
                    }
                    _token = response.token;
                    $('meta[name="csrf-token"]').attr('content', response.token);
                },
                error: function(error) {
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });
        }

    });

    $(".about-me-btn").on("click", function() {
        let about_me = $('#about-me-ta').val();
        let my_interests = $('#my-interests-ta').val();

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/change-about-me",
            type: "POST",
            data: {
                about_me: about_me,
                my_interests: my_interests,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Listo! Los datos han sido modificados correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".my-data-btn").on("click", function() {
        let tel = $('#tel').val();
        let weight = $('#weight').val();
        let height = $('#height').val();

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/change-my-data",
            type: "POST",
            data: {
                tel: tel,
                weight: weight,
                height: height,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Listo! Los datos han sido modificados correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });


    $(".change-password").on("click", function() {
        let email_rec_pw = $('#email_rec_pw').val();
        let new_password = $('#new_password').val();
        let new_password_confirmation = $('#new_password_confirmation').val();
        let hash_pw = $("#hash_pw").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/change-password",
            type: "POST",
            data: {
                email: email_rec_pw,
                new_password: new_password,
                new_password_confirmation: new_password_confirmation,
                hash: hash_pw,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Listo! Tu contrase??a se ha cambiado correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".send-forgot-password").on("click", function() {
        let email_fg_pw = $('#email_fg_pw').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/forgot-password-send",
            type: "POST",
            data: {
                email: email_fg_pw,
                _token: _token
            },
            success: function(response) {
                if (response.error == false) {
                    alert("Listo! Revisa tu correo electr??nico, has recibido un mail con las instrucciones para recuperar tu contrase??a.");
                } else {
                    alert(response.messages);
                }
                _token = response.token;
                $('meta[name="csrf-token"]').attr('content', response.token);
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
            }
        });
    });

    $(".link-client").on("click", function() {
        let target = $(this).attr("target");

        $("#cpanel").addClass('link-profile-hidden');
        $("#support").addClass('link-profile-hidden');

        $(target).removeClass('link-profile-hidden');

        $('.link-client').removeClass('current');
        $(this).addClass('current');
    });

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
        $("#measure-edit").val(object['measure'] == "ml." ? "0" : "1");
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
        //console.log(object);
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
        //console.log(object);
        $("#name-view").html(object['name']);
        $("#measure-view").html(object['measure']);
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
        if (confirm('??Est?? seguro de que desea eliminar este ejercicio?')) {
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
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });

        }
    });

    $(".removeAliment").on("click", function() {
        if (confirm('??Est?? seguro de que desea eliminar este alimento?')) {
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
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
                }
            });

        }
    });
    $(".banUnbanClient").on("click", function() {
        let client = parseInt($(this).attr('target'));
        let clientArr = parseInt($(this).attr('arrTarget'));

        if (confirm(clients[clientArr]['disabled'] == 0 ? '??Est?? seguro de que desea deshabilitar a este cliente?' : '??Est?? seguro de que desea habilitar a este cliente?')) {

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
                    alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                //console.log(response);
                if (response.error == false) {
                    alert("Ejercicio modificado correctamente.");
                    location.href = response.route;
                } else {
                    alert(response.messages);
                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                measure: $("#measure-add").val(),
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
                    //console.log(response);
                    alert(response.messages);

                }
            },
            error: function(error) {
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                measure: $("#measure-edit").val(),
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
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
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
                alert("Ha habido un error durante la comunicaci??n con el servidor.");
                $("#loading-login-hidden").addClass("loading-login-hidden");
            }
        });

    });
});