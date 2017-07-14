<div id="collapseStat" class="panel-collapse collapse in">
    <div class="panel-body no-padding">
    	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  	<!-- Indicators -->
		  	<ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			    <li data-target="#myCarousel" data-slide-to="3"></li>
			    <li data-target="#myCarousel" data-slide-to="4"></li>
			    <li data-target="#myCarousel" data-slide-to="5"></li>
		  	</ol>

	  		<!-- Wrapper for slides -->
	  		<div class="carousel-inner">
    			<div class="item active">
	      			<div id="element_by_category"></div>
	    		</div>

			    <div class="item">
			      	<div id="room_by_category"></div>
			    </div>

			    <div class="item">
			      	<div id="evolution_nbr_user"></div>
			    </div>

			    <div class="item">
			      	<div id="user_room_by_month"></div>
			    </div>

			    <div class="item">
			      	<div id="nbr_suggest"></div>
			    </div>
			    <div class="item item-message-by-room">
			    	<div class="nbr_message_by_room">
				    	<div class="wrapper">
				    		<div class="row">
				    			<div class="counter col_fourth">
		      						<i class="fa fa-users fa-2x"></i>
		      						<h2 id="nbr_user" class="timer count-title count-number">{{ $nbrUsers }}</h2>
		       						<p class="count-text ">Nombre d'utilisateur</p>
		       					</div>

		    					<div class="counter col_fourth">
		      						<i class="fa fa-book fa-2x"></i>
		      						<h2 id="nbr_element" class="timer count-title count-number">{{ $nbrElements }}</h2>
		       						<p class="count-text ">Nombre d'oeuvre</p>
		    					</div>		    					
	    					</div>
	    					<div class="row">
		    					<div class="counter col_fourth">
		      						<i class="fa fa-calendar fa-2x"></i>
		      						<h2 id="nbr_room" class="timer count-title count-number">{{ $nbrRooms }}</h2>
		       						<p class="count-text ">Nombre total de salon</p>
		    					</div>

		    					<div class="counter col_fourth">
		      						<i class="fa fa-comments fa-2x"></i>
		      						<h2 id="nbr_message_by_room" class="timer count-title count-number"></h2>
		       						<p class="count-text ">Nombre moyen de message par salon</p>
		    					</div>		    					
		    				</div>
	    				</div>
	    			</div>
			      <!-- <div id="nbr_message_by_room" >Nombre moyen de message par salon : </div> -->
			    </div>
	  		</div>

	  		<!-- Left and right controls -->
	  		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
	  		</a>
	  		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			    <span class="sr-only">Next</span>
	  		</a>
		</div>
    </div>
</div>