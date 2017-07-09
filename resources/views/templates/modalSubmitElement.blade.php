<div class="modal fade" id="submitElement" tabindex="-1" role="dialog" aria-labelledby="myModalProposition">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalProposition">Proposer une oeuvre</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'proposition_element', 'class' => 'notRedirect', 'id' => 'proposition_element']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('label_type',"Type d'oeuvre") !!}
                            {!! Form::text('category','',['id'=>'label_type',
                                                                    'class' => 'form-control',
                                                                    'required' => 'required',
                                                                    'placeholder' => 'Livres, Films, Jeux...']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('label_author',"Nom de l'auteur") !!}
                            {!! Form::text('creator','',['id'=>'label_author',
                                                        'class' => 'form-control',
                                                        'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('label_element',"Nom de l'oeuvre") !!}
                            {!! Form::text('name','',['id'=>'label_element',
                                                        'class' => 'form-control',
                                                        'required' => 'required']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('label_room',"Proposer un salon pour cette oeuvre") !!}
                            {!! Form::checkbox('want_room', '1', null,[
                                                                        'id' => 'label_room',
                                                                        'class' => 'form-control'
                                                                      ]) !!}
                        </div>
                    </div>
                </div>
                    <div class="alert alert-dismissible alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Votre proposition a été envoyée correctement.
                    </div>
                    <div class="alert alert-dismissible alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Les zones de saisies sont incompletes ou erronées.
                    </div>
                    <div class="alert alert-dismissible alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Envoi impossible.
                    </div>
                
                <div class="row">
                    <span class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 text-center">
                        {!! Form::submit("Envoyer la proposition", ['class' => 'btn btn-success']) !!}
                    </span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>