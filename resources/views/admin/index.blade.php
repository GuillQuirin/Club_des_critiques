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
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseHome">
		      		<h4 class="panel-title">Page d'accueil</h4>
		    	</div>
		    	<div id="collapseHome" class="panel-collapse collapse in">
		      		@include('admin.home')
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseCategory">
		     		<h4 class="panel-title">Catégories</h4>
		    	</div>
		    	@include('admin.category')
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseElement">
		     		<h4 class="panel-title">Oeuvres</h4>
		    	</div>
		    	@include('admin.element')
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading"  data-parent="#accordion" data-toggle="collapse" href="#collapseRoom">
		      		<h4 class="panel-title">Salons</h4>
		    	</div>
		    	@include('admin.room')
		  	</div>
		    <div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseBanRoom">
		      		<h4 class="panel-title">Demande de ban en salon</h4>
		    	</div>
		    	@include('admin.room_ban')
		    </div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseUser">
		      		<h4 class="panel-title">Membres</h4>
		    	</div>
		    	@include('admin.user')
		    </div>
		    
		    <div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseFooter">
		      		<h4 class="panel-title">Footer</h4>
		    	</div>
		    	@include('admin.footer')
		    </div>
		    <div class="panel panel-default">
		    	<div class="panel-heading" data-parent="#accordion" data-toggle="collapse" href="#collapseElementSuggest">
		      		<h4 class="panel-title">Proposition d'oeuvre</h4>
		    	</div>
		    	@include('admin.element_suggest')
		    </div>
		</div> 
    </div>

@endsection


@section('js')
	<script type="text/javascript" src="moment/min/moment.min.js"></script>
	<script type="text/javascript" src="bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {

	    $('#elementManual').show();
	    $('#elementAutomatic').hide();

	    initializedDataTable('elementTable');
	    initializedDataTable('elementTopTable');
	    initializedDataTable('categoryTable');
	    initializedDataTable('roomTable');
	    initializedDataTable('userTable');
	    initializedDataTable('footerTable');
	    initializedDataTable('banTable');
	    initializedDataTable('elementSuggestTable');

	    $( "#date_start" ).datepicker();
	    $( "#date_end" ).datepicker();


	// HOME 

		var selectSubCat = $('#top_sub_category');
		var selectCreator = $('#top_creator');
		var selectElement = $('#top_element');

		// Cache le bouton "ajouter un element"
		$('#btnShowAddTopElement').click(function() {
			$('#btnShowAddTopElement').hide();
		});
		// Affiche le bouton "ajouter un element"
		$('#btnHideAddTopElement').click(function() {
			$('#btnShowAddTopElement').show();
			// $('#collapseAddElementTop').hide();
		});
	    	

		// Sélection de la catégorie => affichage des sous catégories
		$("#top_category").change(function() {
	        var categoryId = this.value;

	        if (categoryId.length) {
	            // Call Ajax Request to get sub categories for the category 
	            $.ajax({
	                data : { categoryId : categoryId },
	                url: "{{ route('get_sub_categories') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectSubCat.attr('disabled',false);
	                        selectSubCat.html('<option value="" disabled selected>Choisissez une sous ctégorie</option>');
	                        jQuery.each(data, function() {
	                            selectSubCat.append(new Option(this.name, this.id));
	                        });
	                        selectSubCat.selectpicker('refresh');
	                    } else {
	                        selectSubCat.html('<option value="" disabled selected>Pas de sous catégorie disponible</option>');
	                        selectSubCat.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

	    // Sélection de la sous catégorie => affichage des auteurs
		selectSubCat.change(function() {
	        var subCatId = this.value;

	        if (subCatId.length) {
	            // Call Ajax Request to get creator for the sub category
	            $.ajax({
	                data : { subCatId : subCatId },
	                url: "{{ route('get_creators') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectCreator.attr('disabled',false);
	                        selectCreator.html('<option value="" disabled selected>Choisissez un auteur / réalisateur </option>');
	                        jQuery.each(data, function() {
	                            selectCreator.append(new Option(this.creator, this.creator));
	                        });
	                        selectCreator.selectpicker('refresh');
	                    } else {
	                        selectCreator.html('<option value="" disabled selected>Pas d\'auteur / réalisateur disopnible pour cette catégorie</option>');
	                        selectCreator.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

		// Sélection de l'auteur => affichage des oeuvres
		selectCreator.change(function() {
	        var subCatId = selectSubCat.val();
	        var creator = this.value;

	        if (subCatId.length && creator.length) {
	            // Call Ajax Request to get element for the creator
	            $.ajax({
	                data : { subCatId : subCatId, creator : creator },
	                url: "{{ route('get_elements') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectElement.attr('disabled',false);
	                        selectElement.html('<option value="" disabled selected>Choisissez une oeuvre </option>');
	                        jQuery.each(data, function() {
	                            selectElement.append(new Option(this.name, this.id));
	                        });
	                        selectElement.selectpicker('refresh');
	                    } else {
	                        selectElement.html('<option value="" disabled selected>Pas d\'oeuvre disopnible pour cet  auteur / réalisateur</option>');
	                        selectElement.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

		// Supprime un élément à la une
    	$('#elementTopTable').on('click', '.delete-top-element', function(){
    		elementId = this.id;
			tab = $( this ).parent().parent();

    		swal(
    			{
				  	title: "Voulez vous vraiment supprimer cette oeuvre?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { elementId : elementId },
			                url: "{{ route('delete_top_element') }}",
			                type: 'put'
			            }).done(function(){
			            	tab.remove();
			            	swal("Supprimé!", "L'oeuvre a bien été supprimée.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'oeuvre n'a pas été supprimée.", "error");
			            });
					}				  
				}
			);	
	    });


	// CATEGORY

		// Delete category
    	$('#categoryTable').on('click', '.delete-category', function(){
    		categoryId = this.id;
    		tab = $( this ).parent().parent();
    		swal(
    			{
				  	title: "Voulez vous vraiment supprimer cette catégorie?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { categoryId : categoryId },
			                url: "{{ route('delete_category') }}",
			                type: 'put',
			            }).done(function(){
			            	tab.remove();
			            	swal("Supprimé!", "La catégorie a bien été supprimée.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "La catégorie n'a pas été supprimée.", "error");
			            });
					}				  
				}
			);
	    	
	    });

		// Cache le bouton "ajouter une categorie"
		$('#btnShowAddCategory').click(function() {
			$('#btnShowAddCategory').hide();
		});
		// Affiche le bouton "ajouter une categorie"
		$('#btnHideAddCategory').click(function() {
			$('#btnShowAddCategory').show();
		});

		// Show pop up to edit category
		$('#categoryTable').on('click', 'a.edit-category', function(){
		    var myModal = $('#editCategoryModal');

		    // now get the values from the table
		    var id = $(this).closest('tr').find('td.category-id').html();
		    var name = $(this).closest('tr').find('td.category-name').html();
		    var parent = $(this).closest('tr').find('td.category-parent')[0].id;
		    var picture = $(this).closest('tr').find('td.category-picture').html();
		    
		    // and set them in the modal:
		    $('#id_category', myModal).val(id);		   
		    $('.edit-category-name', myModal).val(name);		   
		    $('.edit-category-picture', myModal).val(picture);
		    if(parent != 0){
		    	$('.selectpicker').selectpicker('val', parent);
		    }
		    
		    myModal.modal('toggle');

		    return false;
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
    	$('#element_category').change(function() {
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
	    $('#edit_element_category').change(function() {
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

    	// Sélection de la catégorie => affichage des sous catégories
    	var selectElementSubCat = $('#element_sub_category');
		$("#element_category").change(function() {
	        var categoryId = this.value;

	        if (categoryId.length) {
	            // Call Ajax Request to get sub categories for the category 
	            $.ajax({
	                data : { categoryId : categoryId },
	                url: "{{ route('get_sub_categories') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectElementSubCat.attr('disabled',false);
	                        selectElementSubCat.html('<option value="" disabled selected>Choisissez une sous ctégorie</option>');
	                        jQuery.each(data, function() {
	                            selectElementSubCat.append(new Option(this.name, this.id));
	                        });
	                        selectElementSubCat.selectpicker('refresh');
	                    } else {
	                        selectElementSubCat.html('<option value="" disabled selected>Pas de sous catégorie disponible</option>');
	                        selectElementSubCat.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

	    // Delete element
    	$('#elementTable').on('click', '.delete-element', function(){
    		elementId = this.id;
    		tab = $( this ).parent().parent();
    		swal(
    			{
				  	title: "Voulez vous vraiment supprimer cet oeuvre ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { elementId : elementId },
			                url: "{{ route('delete_element') }}",
			                type: 'put',
			            }).done(function(){
			            	tab.remove();
			            	swal("Supprimé!", "L'oeuvre a bien été supprimée.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'oeuvre n'a pas été supprimée.", "error");
			            });
					}				  
				}
			);
	    });

	    // Sow pop up to edit element
	    $('#elementTable').on('click', 'a.edit-element', function(){
		    var myModal = $('#editElementModal');

		    var elementId = $(this).closest('tr').find('td.element-id').html();
		    var selectEditElementSubCat = $('#edit_element_sub_category');
		    var selectEditElementCat = $('#edit_element_category');
		    console.log(selectEditElementCat.val());

		    $.ajax({
                data : { elementId : elementId },
                url: "{{ route('get_element') }}",
                type: 'get',
                success: function(data) {
                	console.log(data);
                	$('#id_element').val(data.element.id);	
                	$('#edit_element_name').val(data.element.name);	
                	$('#edit_element_creator').val(data.element.creator);
                	$('#edit_element_url_picture').val(data.element.url_picture);
                	$('#edit_element_date_publication').val(data.element.date_publication);
                	$('#edit_element_date_start').val(data.element.date_start);
                	$('#edit_element_date_end').val(data.element.date_end);
                	$('#edit_element_description').val(data.element.description);	                	
                	
                	selectEditElementCat.selectpicker('val', data.category);

                	// Affichage des sous catégories                 	
		            $.ajax({
		                data : { categoryId : data.category },
		                url: "{{ route('get_sub_categories') }}",
		                type: 'get',
		                success: function(subCategories) {
		                    if (subCategories.length) {
		                        selectEditElementSubCat.attr('disabled',false);
		                        selectEditElementSubCat.html('<option value="" disabled selected>Choisissez une sous catégorie</option>');
		                        jQuery.each(subCategories, function() {
		                            selectEditElementSubCat.append(new Option(this.name, this.id));
		                        });
		                        selectEditElementSubCat.selectpicker('refresh');
		                        selectEditElementSubCat.selectpicker('val', data.element.id_category);
		                    } else {
		                        selectEditElementSubCat.html('<option value="" disabled selected>Pas de sous catégorie disponible</option>');
		                        selectEditElementSubCat.selectpicker('refresh');
		                    }
		                }
		            });	            
		     
                },
                error : function() {
                	// gestion d'erreur
                }
            });

		    setTimeout(function(){
				if( selectEditElementCat.val() == 1 || selectEditElementCat.val() == 2){
		    		$('#datePublication',myModal).show();
		    		$('#dateStart', myModal).hide();
		    		$('#dateEnd', myModal).hide();	
		    	} else {
		    		$('#datePublication', myModal).hide();
		    		$('#dateStart', myModal).show();
		    		$('#dateEnd', myModal).show();
		    	}
	    		myModal.modal('toggle');
			}, 1000);
            
		    return false;
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

		var selectRoomSubCat = $('#room_sub_category');
		var selectRoomElement = $('#room_element');

		$('#room_date_start').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			defaultDate: new Date()
		});

		$('#room_date_end').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			minDate: $('#room_date_start').val(),
			defaultDate: $('#room_date_start').val()
		});

		$('#room_date_start').on('dp.change', function (e) {
		    if ($('#room_date_end').length > 0) {
		        $('#room_date_end').data("DateTimePicker").minDate(e.date)
		    }
		});

		// Sélection de la catégorie => affichage des sous catégories
		$("#room_category").change(function() {
	        var categoryId = this.value;

	        if (categoryId.length) {
	            // Call Ajax Request to get sub categories for the category 
	            $.ajax({
	                data : { categoryId : categoryId },
	                url: "{{ route('get_sub_categories') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectRoomSubCat.attr('disabled',false);
	                        selectRoomSubCat.html('<option value="" disabled selected>Choisissez une sous ctégorie</option>');
	                        jQuery.each(data, function() {
	                            selectRoomSubCat.append(new Option(this.name, this.id));
	                        });
	                        selectRoomSubCat.selectpicker('refresh');
	                    } else {
	                        selectRoomSubCat.html('<option value="" disabled selected>Pas de sous catégorie disponible</option>');
	                        selectRoomSubCat.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

	    // Sélection de la sous catégorie => affichage des auteurs
		selectRoomSubCat.change(function() {
	        var subCatId = this.value;

	        if (subCatId.length) {
	            // Call Ajax Request to get creator for the sub category
	             $.ajax({
	                data : { subCatId : subCatId},
	                url: "{{ route('get_elements_by_category') }}",
	                type: 'get',
	                success: function(data) {
	                    if (data.length) {
	                        selectRoomElement.attr('disabled',false);
	                        selectRoomElement.html('<option value="" disabled selected>Choisissez une oeuvre </option>');
	                        jQuery.each(data, function() {
	                            selectRoomElement.append(new Option(this.name, this.id));
	                        });
	                        selectRoomElement.selectpicker('refresh');
	                    } else {
	                        selectRoomElement.html('<option value="" disabled selected>Pas d\'oeuvre disopnible pour cette sous catégorie</option>');
	                        selectRoomElement.selectpicker('refresh');
	                    }
	                }
	            });
	        }
	    });

		// Affiche la liste des utilisateurs du salon
    	$('#roomTable').on('click', 'i.show-user-room', function(){
	    	var myModal = $('#userRoomModal');
	    	var roomId = $(this).closest('tr').find('td.room-id').html();
	    	$('#roomId').val(roomId);

	    	$.ajax({
                data : { roomId : roomId },
                url: "{{ route('get_users_for_room') }}",
                type: 'get',
                success: function(data) {
                	jQuery.each(data, function() {
                		if(this.status_user == 1){
							var status = "Membre";                			
                		} else if(this.status_user == 2){
							var status = "Administrateur";
                		}else{
                			var status = "Bannis";
                		}
                        $('#listUsersRoom').append('<li class="list-group-item">' + this.first_name + ' ' + this.last_name + ' - ' + status +'<span class=""><i class="fa fa-ban" id="' + this.id +'" aria-hidden="true"></i></span></li>');
                    });
					myModal.modal('toggle');

					// Bannir un utilisateur du salon
				    $('i.fa-ban').on('click', function() {
				    	var userId = this.id;
				    	var roomId = $('#roomId').val();

				    	swal(
			    			{
							  	title: "Voulez vous vraiment bannir cet utilisateur du salon ?",
								type: "warning",
								showCancelButton: true,
							  	confirmButtonColor: "#DD6B55",
								confirmButtonText: "Supprimer",
								cancelButtonText: "Annuler",
								closeOnConfirm: false
							},
							function(isConfirm){
								if(isConfirm){
									$.ajax({
						                data : { roomId : roomId, userId : userId },
						                url: "{{ route('ban_user_from_room') }}",
						                type: 'put',
						            }).done(function(){
						            	tdStatus.html('Banni');
						            	swal("Supprimé!", "L'utilisateur a bien été banni du salon.", "success");
						            }).fail(function(){
						            	swal("Erreur!", "L'utilisateur n'a pas été banni du salon.", "error");
						            });
								}				  
							}
						);
					});	 
                },
                error : function() {
                	// gestion d'erreur
                }
            });   
	    });
	    $("#userRoomModal").on("hidden.bs.modal", function () {
		    $('#listUsersRoom').empty();
		});

	    // Affiche la pop up de modification d'un salon
		$('#roomTable').on('click', 'a.edit-room', function(){
			    var myModal = $('#editRoomModal');

			    var roomId = $(this).closest('tr').find('td.room-id').html();
			    var selectEditRoomSubCat = $('#edit_room_sub_category');
			    var selectEditRoomElement = $('#edit_room_element');

			    $.ajax({
	                data : { roomId : roomId },
	                url: "{{ route('get_room') }}",
	                type: 'get',
	                success: function(data) {
	                	console.log(data.room.date_start);

	                	$('#edit_room_date_start').datetimepicker({
	                		format: 'YYYY-MM-DD HH:mm:ss',
	                		defaultDate: data.room.date_start
	                	});

	                	$('#edit_room_date_end').datetimepicker({
	                		format: 'YYYY-MM-DD HH:mm:ss',
	                		defaultDate: data.room.date_end
	                	});

	                	$('#edit_room_date_start').on('dp.change', function (e) {
						    if ($('#edit_room_date_end').length > 0) {
						        $('#edit_room_date_end').data("DateTimePicker").minDate(e.date)
						    }
						});
	                	
	                	$('#id_room').val(data.room.id);
	                	$('#edit_room_name').val(data.room.name);
	                	
	                	$('#edit_room_category').selectpicker('val', data.category);

	                	// Affichage des sous catégories                 	
			            $.ajax({
			                data : { categoryId : data.category },
			                url: "{{ route('get_sub_categories') }}",
			                type: 'get',
			                success: function(subCategories) {
			                    if (subCategories.length) {
			                        selectEditRoomSubCat.attr('disabled',false);
			                        selectEditRoomSubCat.html('<option value="" disabled selected>Choisissez une sous catégorie</option>');
			                        jQuery.each(subCategories, function() {
			                            selectEditRoomSubCat.append(new Option(this.name, this.id));
			                        });
			                        selectEditRoomSubCat.selectpicker('refresh');
			                        selectEditRoomSubCat.selectpicker('val', data.subCat);
			                    } else {
			                        selectEditRoomSubCat.html('<option value="" disabled selected>Pas de sous catégorie disponible</option>');
			                        selectEditRoomSubCat.selectpicker('refresh');
			                    }
			                }
			            });

			            // Affichage des éléments
			            $.ajax({
			                data : { subCatId : data.subCat},
	                		url: "{{ route('get_elements_by_category') }}",
			                type: 'get',
			                success: function(element) {
			                    if (element.length) {
			                        selectEditRoomElement.attr('disabled',false);
			                        selectEditRoomElement.html('<option value="" disabled selected>Choisissez une sous catégorie</option>');
			                        jQuery.each(element, function() {
			                            selectEditRoomElement.append(new Option(this.name, this.id));
			                        });
			                        selectEditRoomElement.selectpicker('refresh');
			                        selectEditRoomElement.selectpicker('val', data.room.id_element);
			                    } else {
			                        selectEditRoomElement.html('<option value="" disabled selected>Pas d\'oeuvre disponible</option>');
			                        selectEditRoomElement.selectpicker('refresh');
			                    }
			                }
			            });

	                	$('#edit_room_element').selectpicker('val', data.room.id_element);

			            myModal.modal('toggle');
	                },
	                error : function() {
	                	// gestion d'erreur
	                }
	            });

	            return false;
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

		// Affiche la pop up de modification
		$('#userTable').on('click', 'a.edit-user', function(){
		    var myModal = $('#editUserModal');

		    var userId = $(this).closest('tr').find('td.user-id').html();
		    var selectEditUserDepartment = $('#edit_user_department');
		    var selectEditUserStatus = $('#edit_user_status');

		    $.ajax({
                data : { userId : userId },
                url: "{{ route('get_user') }}",
                type: 'get',
                success: function(data) {
                	$('#id_user').val(data.id);
                	$('#edit_user_last_name').val(data.last_name);	
                	$('#edit_user_first_name').val(data.first_name);
                	$('#edit_user_descrition').val(data.description);
                	$('#edit_user_picture').val(data.picture);
                	$('#edit_user_email').val(data.email);
                	
                	selectEditUserDepartment.selectpicker('val', data.id_department);
                	selectEditUserStatus.selectpicker('val', data.id_status);

		            myModal.modal('toggle');            
		     
                },
                error : function() {
                	// gestion d'erreur
                }
            });
            return false;
		});

		// Ban user
	    $('#userTable').on('click', 'i.ban-user', function(){
	    	userId = this.id;
	    	tdStatus = $(this).closest('tr').find('td.user-status');
	    	swal(
    			{
				  	title: "Voulez vous vraiment bannir cet utilisateur du site ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { userId : userId },
	                		url: "{{ route('ban_user') }}",
			                type: 'put',
			            }).done(function(){
			            	tdStatus.html('Banni');
			            	swal("Supprimé!", "L'utilisateur a bien été banni du site.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'utilisateur n'a pas été banni du site.", "error");
			            });
					}				  
				}
			);
	    });

	    // Delete user
	    $('#userTable').on('click', 'i.delete-user', function(){
	    	userId = this.id;
		    tdStatus = $(this).closest('tr').find('td.user-status');
	    	swal(
    			{
				  	title: "Voulez vous vraiment supprimer ce compte utilisateur ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { userId : userId },
			                url: "{{ route('delete_user') }}",
			                type: 'put',
			            }).done(function(){
			            	tdStatus.html('Compte supprimé');
			            	swal("Supprimé!", "L'utilisateur a bien été supprimé.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'utilisateur n'a pas été supprimé.", "error");
			            });
					}				  
				}
			);
	    });

	// FOOTER

		// Cache le bouton "ajouter un lien"
		$('#btnShowAddFooter').click(function() {
			$('#btnShowAddFooter').hide();
		});
		
		// Affiche le bouton "ajouter un lien"
		$('#btnHideAddFooter').click(function() {
			$('#btnShowAddFooter').show();
		});

		// Supprime un élément
    	$('#footerTable').on('click', '.delete-footer', function(){
    		footerId = this.id;
    		tab = $( this ).parent().parent();
    		swal(
    			{
				  	title: "Voulez vous vraiment supprimer ce lien ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { footerId : footerId },
			                url: "{{ route('delete_footer') }}",
			                type: 'put',
			            }).done(function(){
			            	tab.remove();
			            	swal("Supprimé!", "Le lien a bien été supprimée.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "Le lien n'a pas été supprimée.", "error");
			            });
					}				  
				}
			);
	    });

	    // Show pop up to edit footer link
	    $('#footerTable').on('click', 'a.edit-footer', function(){
		    var myModal = $('#editFooterModal');

		    var footerId = $(this).closest('tr').find('td.footer-id').html();
		    var footerLable = $(this).closest('tr').find('td.footer-label').html();
		    var footerRoute = $(this).closest('tr').find('td.footer-route').html();

		    $('#id_footer').val(footerId);
		    $('#edit_footer_label').val(footerLable);
		    $('#edit_footer_route').val(footerRoute);

		    myModal.modal('toggle');

            return false;
		});

	// REPORT ROOM

		// Valide ban user
		$('#banTable').on('click', 'i.valide-ban-user-room', function(){
			var reportId = this.id;
			swal(
    			{
				  	title: "Voulez vous vraiment bannir cet utilisateur du salon ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Bannir",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { reportId : reportId },
			                url: "{{ route('ban_user_room') }}",
			                type: 'put',
			            }).done(function(){
			            	$('#report-status').html('<p class="text-success">Bannissement validé</p>');
			            	swal("Supprimé!", "L'utilisateur a bien été banni du salon.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'utilisateur n'a pas été banni du salon.", "error");
			            });
					}				  
				}
			);
            return false;
		});

		// Refuse ban user
		$('#banTable').on('click', 'i.refuse-ban-user-room', function(){
			var reportId = this.id;
			swal(
    			{
				  	title: "Voulez vous vraiment refuser de bannir cet utilisateur du salon ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Supprimer",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { reportId : reportId },
			                url: "{{ route('refuse_ban_user_room') }}",
			                type: 'put',
			            }).done(function(){
			            	$('#report-status').html('<p class="text-danger">Bannissement refusé</p>');
			            	swal("Supprimé!", "La bannissement de l'utilisateur a été refusé.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "Erreur lors du refus de bannissement de l'utilisateur", "error");
			            });
					}				  
				}
			);
            return false;
		});

	// ELEMENT SUGGEST

		// Validate element suggest
		$('#elementSuggestTable').on('click', 'i.valide-element-suggest', function(){
			var elementSuggestId = this.id;
			swal(
    			{
				  	title: "Voulez vous vraiment valider cette oeuvre ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Valider",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { elementSuggestId : elementSuggestId },
			                url: "{{ route('valide_element_suggest') }}",
			                type: 'put',
			            }).done(function(){
			            	$('.element-suggest-status').html('<p class="text-success">Validé</p>');
			            	swal("Validé!", "Vous devez maintenant l'ajouter dans les oeuvres.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'oeuvre n'a pas été validée.", "error");
			            });
					}				  
				}
			);
            return false;
		});

		// Refuse element suggest
		$('#elementSuggestTable').on('click', 'i.refuse-element-suggest', function(){
			var elementSuggestId = this.id;
			swal(
    			{
				  	title: "Voulez vous vraiment refuser cette oeuvre ?",
					type: "warning",
					showCancelButton: true,
				  	confirmButtonColor: "#DD6B55",
					confirmButtonText: "Refuser",
					cancelButtonText: "Annuler",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						$.ajax({
			                data : { elementSuggestId : elementSuggestId },
			                url: "{{ route('refuse_element_suggest') }}",
			                type: 'put',
			            }).done(function(){
			            	console.log('ok');
			            	$('.element-suggest-status').html('<p class="text-danger">Refusé</p>');
			            	swal("Validé!", "L'oeuvre a été refusée.", "success");
			            }).fail(function(){
			            	swal("Erreur!", "L'oeuvre n'a pas été refusée.", "error");
			            });
					}				  
				}
			);
            return false;
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
                    "   sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                    }
                } 
            });
        };
	});
	</script>
@endsection