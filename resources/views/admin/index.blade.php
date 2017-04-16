@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">    
@endsection

@section('title')
    Administration
@endsection

@section('content')
	<div class="jumbotron">
      <div class="container-fluid">
        <h1>Administration</h1>
      </div>
    </div>
    <div class="container notPadding"> 
   		<div class="panel-group" id="accordion">
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseHome">
		        		Page d'accueil</a>
		      		</h4>
		    	</div>
		    	<div id="collapseHome" class="panel-collapse collapse in">
		      		@include('admin.home')
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		     		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseCategory">
		        		Catégories</a>
		      		</h4>
		    	</div>
		    	@include('admin.category')
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		     		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseElement">
		        		Oeuvres</a>
		      		</h4>
		    	</div>
		    	@include('admin.element')
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
		        		Pages statiques</a>
		      		</h4>
		    	</div>
		    	<div id="collapse3" class="panel-collapse collapse">
		      		<div class="panel-body">

		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
		        		Salons</a>
		      		</h4>
		    	</div>
		    	@include('admin.room')
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
		        		Membres</a>
		      		</h4>
		    	</div>
		    	@include('admin.user')
		    </div>
		</div> 
    </div>




@endsection


@section('js')
<script type="text/javascript">
	$(document).ready(function() {

		$('#elementManual').show();
    	$('#elementAutomatic').hide();

    	initializedDataTable('elementTable');
    	initializedDataTable('elementTopTable');
    	initializedDataTable('categoryTable');
    	initializedDataTable('roomTable');
    	initializedDataTable('userTable');

    	$( "#date_start" ).datepicker();
    	$( "#date_end" ).datepicker();


// HOME

		// Cache le bouton "ajouter un element"
		$('#btnShowAddTopElement').click(function() {
			$('#btnShowAddTopElement').hide();
		});
		// Affiche le bouton "ajouter un element"
		$('#btnHideAddTopElement').click(function() {
			$('#btnShowAddTopElement').show();
		});
    	
    	// Débloque les listes déroulantes
		$('#top_parent_cat').change(function() {
			if (this.value != null) {
				$('#top_creator').prop('disabled', false);
			}
		});
		$('#top_creator').change(function() {
			if (this.value != null) {
				$('#top_element').prop('disabled', false);
			}
		});

// CATEGORY

		// Cache le bouton "ajouter une categorie"
		$('#btnShowAddCategory').click(function() {
			$('#btnShowAddCategory').hide();
		});
		// Affiche le bouton "ajouter une categorie"
		$('#btnHideAddCategory').click(function() {
			$('#btnShowAddCategory').show();
		});

// ELEMENT

		// Cache le bouton "ajouter un element"
		$('#btnShowAddElement').click(function() {
			$('#btnShowAddElement').hide();
		});
		// Affiche le bouton "ajouter un element"
		$('#btnHideAddElement').click(function() {
			$('#btnShowAddElement').show();
		});

		// Affiche le bon formulaire d'ajout d'oeuvre
    	$('input[type=radio][name=radioElement]').change(function() {
	        if (this.value == 'manual') {
	            $('#elementManual').show();
    			$('#elementAutomatic').hide();
	        }
	        else if (this.value == 'automatic') {
	            $('#elementAutomatic').show();
    			$('#elementManual').hide();
	        }
	    });

    	// Affiche les bonnes dates pour le formulaire d'une oeuvre
    	$('#parent_cat').change(function() {
	    	if( this.value == 1 || this.value == 2){
	    		$('#datePublication').show();
	    		$('#dateStart').hide();
	    		$('#dateEnd').hide();	
	    	} else {
	    		$('#datePublication').hide();
	    		$('#dateStart').show();
	    		$('#dateEnd').show();
	    	}
	    });
	    $('#parent_cat_edit').change(function() {
	    	if( this.value == 1 || this.value == 2){
	    		$('#datePublicationEdit').show();
	    		$('#dateStartEdit').hide();
	    		$('#dateEndEdit').hide();	
	    	} else {
	    		$('#datePublicationEdit').hide();
	    		$('#dateStartEdit').show();
	    		$('#dateEndEdit').show();
	    	}
	    });

// ROOM

		// Cache le bouton "ajouter un salon"
		$('#btnShowAddRoom').click(function() {
			$('#btnShowAddRoom').hide();
		});
		
		// Affiche le bouton "ajouter un salon"
		$('#btnHideAddRoom').click(function() {
			$('#btnShowAddRoom').show();
		});


// USER

		// Cache le bouton "ajouter un utilisateur"
		$('#btnShowAddUser').click(function() {
			$('#btnShowAddUser').hide();
		});
		
		// Affiche le bouton "ajouter un utilisateur"
		$('#btnHideAddUser').click(function() {
			$('#btnShowAddUser').show();
		});


// FUNCTIONS

        function initializedDataTable(id) {
        	$('#' + id).DataTable({
        		"language": {
	              	"sProcessing":     "Traitement en cours...",
		          	"sSearch":         "Rechercher&nbsp;:",
		          	"sLengthMenu":     "Afficher _MENU_ éléments",
		          	"sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
		          	"sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
		          	"sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
		          	"sInfoPostFix":    "",
		          	"sLoadingRecords": "Chargement en cours...",
		          	"sZeroRecords":    "Aucun élément à afficher",
		          	"sEmptyTable":     "Aucune donnée disponible dans le tableau",
		          	"oPaginate": {
		              	"sFirst":      "Premier",
		              	"sPrevious":   "Précédent",
		              	"sNext":       "Suivant",
		              	"sLast":       "Dernier"
		          	},
		          	"oAria": {
	              		"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
	              	"	sSortDescending": ": activer pour trier la colonne par ordre décroissant"
          			}
        		} 
        	});
        }


	});
</script>
@endsection