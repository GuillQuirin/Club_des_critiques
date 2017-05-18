$(document).ready(function(){

    /* COUNTDOWN */
    $('[data-countdown]').each(function() {
      var $this = $(this), finalDate = $(this).data('countdown');
      $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('%D jours %H:%M:%S  <span class="caret"></span>'));
      });
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

    $('#openModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);

        modal.find('#picture').attr('src',button.data('picture'));
        modal.find('#first_text').html(button.data('first_text'));
        modal.find('#second_text').html(button.data('second_text'));
        modal.find('#description').html(button.data('description'));
        
    });

    //Configuration AJAX pour le CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Soumission des formulaires AJAX
    $('.modal form.notRedirect').submit(function(event){
        var form = $(this);
        var i=3;
        var popUpMessage =' ';
        var erreur ='';
        var url = form.find('.url').data('url');

        console.log("URL du controlleur : "+url);
        console.log(form.serialize());

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            async: false
            })
            .done(function (data) {
                console.log('Appel du controlleur : ok');
                console.log(data);
                i = (parseInt(data)) ? parseInt(data) : data;
            })
            .fail(function (data) {
                console.log('Appel du controleur : fail');
                console.log(data);
                i = 3;
            });

        if(Number.isInteger(i)){
            switch(i){
                case 1: // OK
                    popUpMessage += '.alert-success';
                    break;
                case 2: // Problème fonctionnel
                    popUpMessage += '.alert-warning';
                    break;
                default: // Problème technique
                    popUpMessage += '.alert-danger';
                    break;
            }
        }
        else
            window.location.replace(i);
        
        form.find('.alert').hide();
        form.find(popUpMessage).fadeIn();
        
        event.preventDefault();
        return false;
    });

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
                data: req,
                success: function (data) {
                    if (data.response === 'true') {
                        add(data.first_name);
                    }
                }
            });
        }
    });

    $('#send').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

        var id_user_sender = 1;
        var message = encodeURIComponent( $('#message').val() );

        if(message != ""){
            $.ajax({
                url : "addMessage",
                type : "POST",
                data : "id_user_sender=" + id_user_sender + "&message=" + message,
                success : function(){
                    /* id_user_sender a remplacer par donnée de la session */
                    $('#messages').append(
                        "<li class='left clearfix'><span class='chat-img pull-left'>"
                        + "<img src='http://placehold.it/50/55C1E7/fff&text=U' alt='User Avatar' class='img-circle' /></span>"
                        + "<div class='chat-body clearfix'>"
                        + "<div class='header'>"
                        + "<strong class='primary-font'>" + id_user_sender + "</strong> <small class='pull-right text-muted'>"
                        + "<span class='glyphicon glyphicon-time'></span>" + Date.now().toLocaleString() + "</small>"
                        +"</div><p>" + message + "</p></div></li>"
                    );
                }
            });
        }
    });
});