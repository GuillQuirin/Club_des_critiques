$(document).ready(function(){

    $("#messages").scrollTop($("#messages").prop('scrollHeight'));

    /* Countdown du prochain salon à venir */
    $.ajax({
        url: $('a#nextRoomCountdown').data('route'),
        type: 'GET'
    })
    .done(function (data) {
        if(!data){
            $("#nextRoomCountdown").html('Pas de salon annoncé prochainement');
            return false;
        }
        else{
            var nextRoom = JSON.parse(data);
            var date = new Date(nextRoom.date_start);
            var datestring = date.getUTCFullYear() + "/" +
                            ("0" + (date.getUTCMonth()+1)).slice(-2) + "/" +
                            ("0" + date.getUTCDate()).slice(-2);

            $('#nextRoomCountdown').attr('data-countdown', datestring);
            $('#nextRoomDetails .room').html(nextRoom.nameRoom);
            $('#nextRoomDetails .element').html(nextRoom.nameElement);
            $('#nextRoomDetails .date').html(nextRoom.date_start);
            $('#nextRoomDetails a').attr('href', $('#nextRoomDetails a')
                                    .data('redirect')+'/'+nextRoom.id)
                                    .html('Accèdez à la fiche du salon');

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

    // function initializedDataTable(id) {
    //   $('#elementTable').DataTable({
    //     "language": {
    //           "sProcessing":     "Traitement en cours...",
    //       "sSearch":         "Rechercher&nbsp;:",
    //       "sLengthMenu":     "Afficher _MENU_ éléments",
    //       "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    //       "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
    //       "sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
    //       "sInfoPostFix":    "",
    //       "sLoadingRecords": "Chargement en cours...",
    //       "sZeroRecords":    "Aucun élément à afficher",
    //       "sEmptyTable":     "Aucune donnée disponible dans le tableau",
    //       "oPaginate": {
    //           "sFirst":      "Premier",
    //           "sPrevious":   "Précédent",
    //           "sNext":       "Suivant",
    //           "sLast":       "Dernier"
    //       },
    //       "oAria": {
    //           "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
    //           "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
    //       }
    //     } 
    //   });
    // }


    //Affichage des informations dans la modal
    $('#openModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);

        modal.find('#picture').attr('src',button.data('picture'));
        modal.find('#name').html(button.data('name'));
        modal.find('#subName').html(button.data('subname'));
        modal.find('#description').html(button.data('description'));

        if(button.data('name_category') != undefined){
            var redirectionCat = $("#route_category_parent"); 
            modal.find('#route_category_parent').attr("href", redirectionCat.data('route')+"/"+button.data('id_element'));
            modal.find('#name_category').html(button.data('name_category'));
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
                
                default: // Problème technique
                    popUpMessage += '.alert-danger';
                    form.find('input[type="submit"]').parent().prepend('<i class="fa fa-exclamation-triangle fa-2x float-left" aria-hidden="true"></i>');
                    break;
            }
        }
        else
            window.location.replace(i);
        
        form.find('.alert').hide();
        form.find(popUpMessage).fadeIn();
    }

    //Validation des cookies
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

    $('#autocomplete_user').autocomplete({
        minLength: 2,
        source: function (req, add) {
            $.ajax({
                url: 'autocompleteUser',
                dataType: 'json',
                type: 'POST',
                data: req
            })
                .done(function (data) {
                    if (data.response === 'true') {
                        console.log(data)
                        add(data.message);
                    }
                });
        },
        select: function (event, ui) {
            $("#id_user").val(ui.item.id); // save selected id to hidden input
        }
    });

    $.ui.autocomplete.prototype._renderItem = function (ul, item) {
        item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
        return $("<li class='form-control'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };

    /*MAJ de la chatbox*/
    updateChatbox();

    function updateChatbox(){
        var id_room = $('#room').val();
        $.ajax({
            url : "getMessage",
            type : "POST",
            data : "id_room=" + id_room
        })
        .done(function(data){
            //console.log(data);
            var data = JSON.parse(data);
            var html="";
            //console.log(data);
            $.each(data, function(key, value){
                html+='<li class="left clearfix">';
                    html+='<span class="chat-img pull-left">';
                        if(value.picture)
                            html+='<img src="'+value.picture+'" alt="User Avatar" class="img-circle favicon_user"/>';
                        else
                            html+='<img src="/images/user.png" alt="User Avatar" class="img-circle favicon_user"/>';
                    html+='</span>';
                    html+='<div class="chat-body clearfix">';
                        html+='<div class="header">';
                            html+='<strong class="primary-font">'+value.first_name+' '+value.last_name+'</strong>';
                            html+='<small class="pull-right text-muted">';
                                html+='<span class="glyphicon glyphicon-time"></span>';
                                html+=value.date;
                            html+='</small>';
                        html+='</div>';
                        html+='<p>'+value.message+'</p>';
                    html+='</div>';
                html+='</li>';
                $('ul#chatbox').html(html);
            });
        })
        .fail(function(data){
            console.log(data);
        })
        .always(function() {           // on completion, restart
           setTimeout(updateChatbox, 2000);  // function refers to itself
        });
    }

    /*Envoi d'un message en chatbox*/
    $('#send').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

        var message = $('#message').val();

        var today = new Date();
        var dd = today.getDate() < 10 ? '0' + today.getDate() : today.getDate();
        var mm = today.getMonth()+1 < 10 ? '0' + (today.getMonth()+1) : today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes()< 10 ? '0' + today.getMinutes() : today.getMinutes();
        var s = today.getSeconds() < 10 ? '0' + today.getSeconds() : today.getSeconds();
        var id_room = $('#room').val();

        today = dd+'/'+mm+'/'+yyyy+' '+h+':'+m+':'+s;

        if(message != ""){
            $.ajax({
                url : "addMessage",
                type : "POST",
                data : "id_room=" + id_room + "&message=" + message,
            })
            .done(function(data){
                updateChatbox();
                $('#message').val('');
            });
        }
    });
});