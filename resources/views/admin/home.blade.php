<div class="panel-body">
	<div class="row">
		{{ Form::open(['route' => 'edit_home', 'method' => 'put', 'files'=>true, 'class' => 'col-md-12']) }}
			<div class="form-group">
	    		<h4>Le concept : </h4>
		    	<textarea class="form-control" name="home_concept" id="home_concept" rows="3">{{$concept->value}}</textarea>
			</div>
			<div class="form-group">
	    		<h4>Le slogan : </h4>
		    	<input type="text" value="{{$slogan->value}}" class="form-control" name="home_slogan" id="home_slogan">
			</div>
			<div class="form-group">
				<label class="control-label">Select File</label>
				<!-- <input id="home_image" type="file" name="home_image" class="file"> -->
				{!! Form::file('image') !!}
			</div>
			<button type="submit" class="btn btn-success pull-right" id="editConcept">Modifier</button>
		{{ Form::close() }}
	</div>	

	<div class="row">
		<div class="col-md-12">
			<h4>Oeuvres à la une : </h4><br>

			<p>
	          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddElementTop" aria-expanded="false" aria-controls="collapseAddElementTop" id="btnShowAddTopElement">
	            Ajouter une oeuvre
	          </button>
	        </p>
	        <div class="collapse" id="collapseAddElementTop">
	          	<div class="card card-block">
	            	{{ Form::open(['route' => 'add_top_element', 'method' => 'put', 'class' => 'col-md-12']) }}
	            		<div class="form-group">
	                        <label for="top_category" class="col-2 col-form-label">Catégorie : </label>
	                        <div class="col-10">
	                        	<select id="top_category" name="top_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir une catégorie">
					                @foreach($categories as $category)
					                    <option value="{{$category->id}}">{{$category->name}}</option>
					                @endforeach
					            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="top_sub_category" class="col-2 col-form-label">Sous catégorie : </label>
	                        <div class="col-10">
	                        	<select id="top_sub_category" name="top_sub_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
	                        		<option value="">Vous devez choisir une catégorie</option>
					            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="top_creator" class="col-2 col-form-label">Auteur / réalisateur : </label>
	                        <div class="col-10">
	                           <select id="top_creator" name="top_creator" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
	                        		<option value="">Vous devez choisir une sous catégorie</option>
					            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="top_element" class="col-2 col-form-label">Oeuvre : </label>
	                        <div class="col-10">
	                           <select id="top_element" name="top_element" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
	                        		<option value="">Vous devez choisir un auteur / réalisateur</option>
					            </select>
	                        </div>
	                    </div>
	                    
	                    <div class="pull-right">
	                    	<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddElementTop" aria-expanded="false" aria-controls="collapseAddElementTop" id="btnHideAddTopElement">
	           					Annuler
	          				</button>
	                    	<button type="submit" class="btn btn-success">Ajouter</button>
	                    </div>
	            	{{ Form::close() }}
	            	<br><br>
	            </div>
	            <br>
	        </div>
	    </div>
	</div>

	<div class="row">
        <div class="col-md-12">
			<table id="elementTopTable" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Auteur</th>
						<th>Catégorie</th>
						<th>Sous catégorie</th>
						<th>Action</th>            					
					</tr>
				</thead>
				<tbody>
					@foreach($topElements as $element)
						<tr>
							<td>{{ $element->name }}</td>
							<td>{{ $element->creator }}</td>
							<td>{{ $element->category->parent->name}}</td>
							<td>{{ $element->category->name }}</td>
							<td>
								<i class="fa fa-trash delete-top-element" aria-hidden="true" id="{{ $element->id }}"></i>
							</td>            					
						</tr>
					@endforeach
				</tbody>		
			</table>
		</div>
	</div>
</div>