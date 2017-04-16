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
});