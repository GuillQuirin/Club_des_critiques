<div id="exchange" role="tabpanel" class="tab-pane fade">
  	<h4 class="text-center">Ajoutez une oeuvre que vous proposez d'échanger</h4>
    
    {{ Form::open(['route' => 'add_exchange', 'id' => 'addExchange', 'method' => 'post', 'class' => 'col-md-12']) }}
	    <div class="input-group input-group-md">
	        <input type="text" name="autocomplete_element" id="autocomplete_element" class="form-control" placeholder="Nom de l'oeuvre">
	        <span class="input-group-btn">
	        	<button class="btn btn-success" type="submit">Ajouter</button>
	        </span>
	    </div>
    {{Form::close()}}

    <div>
    	<ul id="listExchanged">
    	</ul>
	</div>
</div>