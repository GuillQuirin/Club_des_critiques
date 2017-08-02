<!-- POP UP D'UNE OEUVRE -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="modal-title text-center">
        <span id="name"></span> de <span id="subName"></span>
    </div>
</div>

<div class="modal-body">
	<!-- Informations de l'élèment -->
    <div class="row">
    	<img src="" 
            alt='image' 
            id="picture" 
            class="col-xs-6 col-sm-4 col-md-4"><!-- 
        --><div>
            <p class="col-xs-6 col-sm-8 col-md-8" id="description"></p>
            <hr>
            <div class="col-xs-6 col-sm-8 col-md-8">
                <p>Vous pouvez acheter ce livre à <a id="link">cette adresse</a></p>
            </div>
        </div>
    </div>
	
	<hr>

    <!-- Catégorie -->
    <div class="row">
		<div class="text-center col-10 col-md-offset-1">Vous pouvez retrouver cette oeuvre dans la catégorie 
            <a id="route_category_parent" data-route="{{route('list_category')}}"><span id="name_category"></span></a>
        </div>
    </div>

     <!-- Note -->
    <div class="row">
        <div class="text-center col-10 col-md-offset-1">Note des utilisateurs de cette oeuvre :
            <span id="mark"></span> / 4
        </div>
    </div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
</div>
