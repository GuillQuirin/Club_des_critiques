<div class="panel-body">
	<div class="row">
		<form class="col-md-12">
			<div class="form-group">
	    		<h4>Le concept : </h4>
		    	<textarea class="form-control" id="contenu" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-success pull-right">Modifier</button>
		</form>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<h4>A la une : </h4><br>

			<p>
	          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddElementTop" aria-expanded="false" aria-controls="collapseAddElementTop" id="btnShowAddTopElement">
	            Ajouter une oeuvre
	          </button>
	        </p>
	        <div class="collapse" id="collapseAddElementTop">
	          	<div class="card card-block">
	            	<form>
	            	<!-- Select avec recherche auto completion -->
	            		<div class="form-group">
	                        <label for="top_parent_cat" class="col-2 col-form-label">Catégorie : </label>
	                        <div class="col-10">
	                            <select class="form-control" id="top_parent_cat" name="top_parent_cat">*
                                	<option>Choisir une catégorie</option>	                           
	                                <option value="1">Livre</option>
	                                <option value="2">Film</option>
	                                <option value="3">Expo</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="top_creator" class="col-2 col-form-label">Auteur / réalisateur : </label>
	                        <div class="col-10">
	                            <select class="form-control" id="top_creator" name="top_creator" disabled>
	                            	<option>Vous devez choisir une catégorie</option>
	                                <option value="1">Victor Hugo</option>
	                                <option value="2">Molière</option>
	                                <option value="3">Emile Zola</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="top_element" class="col-2 col-form-label">Titre : </label>
	                        <div class="col-10">
	                            <select class="form-control" id="	" name="top_element" disabled>
	                            	<option>Vous devez choisir un auteur / réalisateur</option>
	                                <option value="1">Le petit chaperon rouge</option>
	                                <option value="2">Les misérables</option>
	                                <option value="3">...</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="pull-right">
	                    	<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddElementTop" aria-expanded="false" aria-controls="collapseAddElementTop" id="btnHideAddTopElement">
	           					Annuler
	          				</button>
	                    	<button type="submit" class="btn btn-success">Ajouter</button>
	                    </div>
	            	</form>
	            </div>
	            <br>
	        </div>

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
					<tr>
						<th>Le petit chaperon rouge</th>
						<th>Elise Poirier</th>
						<th>Livre</th>
						<th>Pour les bébé</th>
						<th>
							<i class="fa fa-trash" aria-hidden="true"></i>
						</th>            					
					</tr>
				</tbody>		
			</table>
		</div>
	</div>
</div>