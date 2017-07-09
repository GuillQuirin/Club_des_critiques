$(document).ready(function(){

    /* Countdown du prochain salon à venir */
    $.ajax({
        url: $('a#nextRoomCountdown').data('route'),
        type: 'GET'
    })
    .done(function (data) {
        if(!data){
            $("#nextRoomCountdown").html('Pas de salon annoncé prochainement');
            $("#nextRoomCountdown").attr('class', 'disabled');
            return false;
        }
        else{
            var nextRoom = JSON.parse(data);
            var date = new Date(nextRoom.date_start);
            
            var datecountdown = date.getUTCFullYear() + "/" +
                            ("0" + (date.getUTCMonth()+1)).slice(-2) + "/" +
                            ("0" + date.getUTCDate()).slice(-2);

            var datestring = "le " + ("0" + date.getUTCDate()).slice(-2)+ "/" +
                            ("0" + (date.getUTCMonth()+1)).slice(-2) + "/" +
                            date.getUTCFullYear() +
                            " " + ("0" + date.getUTCHours()).slice(-2) + ":" + date.getUTCMinutes() + ":" + date.getSeconds();


            $('#nextRoomCountdown').attr('data-countdown', datecountdown);
            $('#nextRoomDetails .room').html(nextRoom.nameRoom);
            $('#nextRoomDetails .element').html(nextRoom.nameElement);
            $('#nextRoomDetails .date').html(datestring);
            /*$('#nextRoomDetails a').attr('href', $('#nextRoomDetails a')
                                    .data('redirect')+'/'+nextRoom.id)
                                    .html('Accèdez à la fiche du salon');
            */
            $('[data-countdown]').each(function() {
                var $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function(event) {
                    $this.html(event.strftime('%D jours %H:%M:%S  <span class="caret"></span>'));
                });
            });
        }
    })
    .fail(function (data) {
        console.log(data);
    });


    /* VOLET DEROULANT */
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    //Affichage des informations dans la modal
    $('#openModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);

        modal.find('#picture').attr('src',button.data('picture'));
        modal.find('#name').html(button.data('name'));
        modal.find('#subName').html(button.data('subname'));
        modal.find('#description').html(button.data('description'));

        // ELEMENT : url shop
        if(button.data('name_category') != undefined){
            var redirectionCat = $("#route_category_parent"); 
            modal.find('#route_category_parent').attr("href", redirectionCat.data('route')+"/"+button.data('id_element'));
            modal.find('#name_category').html(button.data('name_category'));
        }

        // ELEMENT : url category
        $('#link').parent().addClass('hide');
        if(button.data('link') != undefined){
            $('#link').parent().removeClass('hide');
            modal.find('#link').attr("href", button.data('link'));
        }
    });


    //Configuration AJAX pour le CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Soumission des formulaires AJAX
    $('form.notRedirect').submit(function(event){
        var form = $(this);
        var i=3;
        var url = form.attr('action');

        console.log("URL du controlleur : "+url);
        console.log(form.serialize());

        form.find('input[type="submit"]').parent().prepend('<i class="fa fa-refresh fa-2x fa-spin left" aria-hidden="true"></i>');

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize()
        })
        .done(function (data) {
            console.log('Appel du controlleur : ok');
            console.log(data);

            i = (parseInt(data)) ? parseInt(data) : data;
            displayMessage(i, form);
        })
        .fail(function (data) {
            console.log('Appel du controleur : fail');
            console.log(data);

            i = 3;
            displayMessage(i, form);
        });    
        
        event.preventDefault();
        return false;
    });


    //Messages de retour de formulaire
    function displayMessage(i, form){
        var popUpMessage =' ';
        form.find('.fa-refresh, .fa-exclamation-triangle, .fa-check').remove();
        if(Number.isInteger(i)){
            switch(i){
                
                case 1: // OK
                    popUpMessage += '.alert-success';
                    form.find('input[type="submit"]').parent().prepend('<i class="fa fa-check fa-2x float-left" aria-hidden="true"></i>');
                    
                    //Suppression des champs pour éviter le spam d'envoi de formulaires
                    form.find("input[type!='submit'], textarea, select").val('');
                    break;

                case 2: // Problème fonctionnel
                    popUpMessage += '.alert-warning';
                    form.find('input[type="submit"]').parent().prepend('<i class="fa fa-exclamation-triangle fa-2x float-left" aria-hidden="true"></i>');
                    break;
                
                case 3: // Problème technique
                    popUpMessage += '.alert-danger';
                    form.find('input[type="submit"]').parent().prepend('<i class="fa fa-exclamation-triangle fa-2x float-left" aria-hidden="true"></i>');
                    break;

                case 4: // Login : compte non-actif
                    popUpMessage += '.alert-danger-login';
                    form.find('input[type="submit"]').parent().prepend('<i class="fa fa-exclamation-triangle fa-2x float-left" aria-hidden="true"></i>');
                    break;
            }
        }
        else{
            console.log(i);
            window.location.replace(i);
        }
        
        form.find('.alert').hide();
        form.find(popUpMessage).fadeIn();
    }

    //Validation des cookies la première fois
    $('#alert_cookies button').click(function(){
        $.ajax({
            url: 'cookie',
            type: 'POST'
        })
        .done(function (data) {
            console.log('Création du cookie: ok');
        })
        .fail(function (data) {
            console.log('Création du cookie : fail');
        });
    });
});