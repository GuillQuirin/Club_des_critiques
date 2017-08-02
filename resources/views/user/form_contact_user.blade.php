{!! Form::open(['url' => 'contact', 'class' => 'notRedirect', 'id' => 'formContact']) !!}
  <div class="form-group">
      {!! Form::label('messageContact','Votre message') !!}
      {!! Form::textarea('message', null, 
          array('id' => 'messageContact',
                'required' => 'required', 
                'class'=>'form-control',
                'size' => '30x5', 
                'placeholder'=>'Rédigez votre message')) !!}
      
      {!! Form::hidden('id', $infos->id) !!}
  </div>
  <div class="form-group text-right">
      {!! Form::submit('Envoyer', 
          array('class'=>'btn btn-primary')) !!}
  </div>

  <div class="alert alert-dismissible alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      Un message vient d'être envoyé à l'utilisateur.
  </div>
  <div class="alert alert-dismissible alert-warning" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      Le message n'a pas pu être envoyé.
  </div>
  <div class="alert alert-dismissible alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      Vous devez être connecté pour envoyer un message à cette personne.
  </div>
{!! Form::close() !!}