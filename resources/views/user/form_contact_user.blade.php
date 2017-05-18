{!! Form::open(['url' => '']) !!}
  <div class="form-group">
      {!! Form::label('Noms') !!}
      {!! Form::text('name', null, 
          array('required', 
                'class'=>'form-control', 
                'placeholder'=>'Inscrivez ici vos nom et prénom')) !!}
  </div>

  <div class="form-group">
      {!! Form::label('Email') !!}
      {!! Form::text('email', null, 
          array('required', 
                'class'=>'form-control', 
                'placeholder'=>'Inscrivez votre adresse email')) !!}
  </div>

  <div class="form-group">
      {!! Form::label('Sujet du message') !!}
      {!! Form::text('message', null, 
          array('required', 
                'class'=>'form-control', 
                'placeholder'=>'Indiquez un objet')) !!}
  </div>

  <div class="form-group">
      {!! Form::label('Votre message') !!}
      {!! Form::textarea('message', null, 
          array('required', 
                'class'=>'form-control',
                'size' => '30x5', 
                'placeholder'=>'Rédigez votre message')) !!}
  </div>

  <div class="form-group text-right">
      {!! Form::submit('Envoyer', 
          array('class'=>'btn btn-primary')) !!}
  </div>
{!! Form::close() !!}