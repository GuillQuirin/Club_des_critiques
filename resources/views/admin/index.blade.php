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
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
		        		Page d'accueil</a>
		      		</h4>
		    	</div>
		    	<div id="collapse1" class="panel-collapse collapse in">
		      		<div class="panel-body">
		      			<div class="row">
			      			<form class="col-md-12">
				      			<div class="form-group">
								    <h4>Le concept : </h4>
								    <textarea class="form-control" id="contenu" rows="3"></textarea>
								</div>
								<button type="submit" class="btn btn-danger pull-right">Submit</button>
							</form>
						</div>	

						<div class="row">
							<div class="col-md-12">
								<h4>A la une : </h4><br>
								<table id="elementTable" class="display" cellspacing="0" width="100%">
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
		            							<i class="fa fa-pencil" aria-hidden="true"></i>

											</th>            					
		        						</tr>
		    						</tbody>		
								</table>
							</div>
						</div>
		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		     		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
		        		Catégories</a>
		      		</h4>
		    	</div>
		    	<div id="collapse2" class="panel-collapse collapse">
		      		<div class="panel-body">
		      			<div class="row">
							<div class="col-md-12">
								<h4>A la une : </h4><br>
								<table id="categoryTable" class="display" cellspacing="0" width="100%">
									<thead>
		            					<tr>
		            						<th>Nom</th>
		            						<th>Parent</th>
		            						<th>Url image</th>
		            						<th>Action</th>
		        						</tr>
		    						</thead>
		    						<tbody>
										<tr>
		            						<th>Livre</th>
		            						<th></th>
		            						<th>petite url</th>
		            						<th>
		            							<i class="fa fa-trash" aria-hidden="true"></i>
		            							<i class="fa fa-pencil" aria-hidden="true"></i>
											</th>            					
		        						</tr>
		        						<tr>
		            						<th>Film</th>
		            						<th></th>
		            						<th>petite url</th>
		            						<th>
		            							<i class="fa fa-trash" aria-hidden="true"></i>
		            							<i class="fa fa-pencil" aria-hidden="true"></i>
											</th>            					
		        						</tr>
		        						<tr>
		            						<th>Roman policier</th>
		            						<th>Livre</th>
		            						<th>petite url</th>
		            						<th>
		            							<i class="fa fa-trash" aria-hidden="true"></i>
		            							<i class="fa fa-pencil" aria-hidden="true"></i>
											</th>            					
		        						</tr>
		    						</tbody>		
								</table>
							</div>
						</div>
		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		     		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
		        		Contenus</a>
		      		</h4>
		    	</div>
		    	<div id="collapse2" class="panel-collapse collapse">
		      		<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
		      		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
		      		minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
		      		commodo consequat.
		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
		        		Pages statiques</a>
		      		</h4>
		    	</div>
		    	<div id="collapse3" class="panel-collapse collapse">
		      		<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
		      		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
		      		minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
		      		commodo consequat.
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
		    	<div id="collapse4" class="panel-collapse collapse">
		      		<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
		      		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
		      		minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
		      		commodo consequat.
		      		</div>
		    	</div>
		  	</div>
		  	<div class="panel panel-default">
		    	<div class="panel-heading">
		      		<h4 class="panel-title">
		        		<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
		        		Membres</a>
		      		</h4>
		    	</div>
		    	<div id="collapse5" class="panel-collapse collapse">
		      		<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
		      		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
		      		minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
		      		commodo consequat.
		      		</div>
		    	</div>
		  	</div>
		</div> 
    </div>
@endsection


@section('js')
<script type="text/javascript">
	$(document).ready(function() {
    	 initializedDataTable('elementTable');
	} );
</script>
@endsection