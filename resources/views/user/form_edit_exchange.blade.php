<div id="exchange" role="tabpanel" class="tab-pane fade">
  	{!! Form::model($listElements, ['method' => 'PATCH','route' => ['update_exchange', $infos->id]]) !!}
  	<div class="modal-body">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	        @if(isset($listElements))
	        	<?php $lastCategory = ""; ?>
	        	@foreach($listElements as $key => $element)
				
					@if($lastCategory != $element->category_id)
						@if($lastCategory!="")
								</div>
							</div>
						@endif

					<div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingOne">
					    	<a 	class="collapsed" role="button" data-toggle="collapse" 
					    		data-parent="#accordion" href="#category-{{$element->category_id}}" 
					    		aria-expanded="false" aria-controls="category-{{$element->category_id}}">
					        	<h4 class="panel-title">
					        		{{$element->category_name}}
					        	</h4>
					        </a>
					    </div>
					    <div 	id="category-{{$element->category_id}}" class="panel-collapse collapse" 
					    		role="tabpanel" aria-labelledby="headingOne">
					@endif

				    	<div class="panel-body">
							<label>
								<input 	type="checkbox" name="element_checked[]" value="{{$element->id}}"
									@if(isset($element->is_exchanged))
										checked="checked"
									@endif 
								>
								{{$element->name}}
							</label>
				    	</div>
					<?php $lastCategory = $element->category_id; ?>
	        	@endforeach
	        		</div>
	        	</div> <!-- <div> de cloture des volets -->
	        @endif
		</div>
  	</div>
  	<div class="modal-footer">
   		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    	{!! Form::submit("Modifier", ['class' => 'btn btn-success pull-right']) !!}
  	</div>
  	{!! Form::close() !!}
</div>