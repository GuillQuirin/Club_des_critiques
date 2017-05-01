<div id="exchange" role="tabpanel" class="tab-pane fade">
  {!! Form::open(['url' => '/']) !!}
  <div class="modal-body">
        
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    {!! Form::submit("Modifier", ['class' => 'btn btn-success pull-right']) !!}
  </div>
  {!! Form::close() !!}
</div>