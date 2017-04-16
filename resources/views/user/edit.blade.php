<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul id="popUpEdit" class="nav nav-pills" role="tablist">
          <li role="informations" class="active">
            <a href="#informations" aria-controls="informations" role="tab" data-toggle="tab">Informations</a>
          </li>
          <li role="exchange">
            <a href="#exchange" aria-controls="exchange" role="tab" data-toggle="tab">Echanges</a>
          </li>
          <li role="password">
            <a href="#password" aria-controls="password" role="tab" data-toggle="tab">Mot de passe</a>
          </li>
          <li role="delete">
            <a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Suppression</a>
          </li>
        </ul>
      </div>
      
      <div class="tab-content">
          <!-- Modification des informations générales -->
          <div id="informations" role="tabpanel" class="tab-pane fade in active">
                {!! Form::open(['url' => '/']) !!}
                <div class="modal-body row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Nom :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Prénom :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Adresse email :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Région :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Joignable par email :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Image de profil :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Localisation :</p>
                        <select name="dep">
                            <?php 
                              $departements = ['(00) Hors France', '(01) Ain', '(02) Aisne', '(03) Allier', '(04) Alpes de Haute Provence', '(05) Hautes Alpes', '(06) Alpes Maritimes', '(07) Ardèche', '(08) Ardennes', '(09) Ariège', '(10) Aube', '(11) Aude', '(12) Aveyron', '(13) Bouches du Rhône', '(14) Calvados', '(15) Cantal', '(16) Charente', '(17) Charente Maritime', '(18) Cher', '(19) Corrèze', '(2A) Corse du Sud', '(2B) Haute-Corse', '(21) Côte d\'Or', '(22) Côtes d\'Armor', '(23) Creuse', '(24) Dordogne', '(25) Doubs', '(26) Drôme', '(27) Eure', '(28) Eure et Loir', '(29) Finistère', '(30) Gard', '(31) Haute Garonne', '(32) Gers', '(33) Gironde', '(34) Hérault', '(35) Ille et Vilaine', '(36) Indre', '(37) Indre et Loire', '(38) Isère', '(39) Jura', '(40) Landes', '(41) Loir et Cher', '(42) Loire', '(43) Haute Loire', '(44) Loire Atlantique', '(45) Loiret', '(46) Lot', '(47) Lot et Garonne', '(48) Lozère', '(49) Maine et Loire', '(50) Manche', '(51) Marne', '(52) Haute Marne', '(53) Mayenne', '(54) Meurthe et Moselle', '(55) Meuse', '(56) Morbihan', '(57) Moselle', '(58) Nièvre', '(59) Nord', '(60) Oise', '(61) Orne', '(62) Pas de Calais', '(63) Puy de Dôme', '(64) Pyrénées Atlantiques', '(65) Hautes Pyrénées', '(66) Pyrénées Orientales', '(67) Bas Rhin', '(68) Haut Rhin', '(69) Rhône', '(70) Haute Saône', '(71) Saône et Loire', '(72) Sarthe', '(73) Savoie', '(74) Haute Savoie', '(75) Paris', '(76) Seine Maritime', '(77) Seine et Marne', '(78) Yvelines', '(79) Deux Sèvres', '(80) Somme', '(81) Tarn', '(82) Tarn et Garonne', '(83) Var', '(84) Vaucluse', '(85) Vendée', '(86) Vienne', '(87) Haute Vienne', '(88) Vosges', '(89) Yonne', '(90) Territoire de Belfort', '(91) Essonne', '(92) Hauts de Seine', '(93) Seine Saint Denis', '(94) Val de Marne', '(95) Val d\'Oise', '(971) Guadeloupe', '(972) Martinique', '(973) Guyane', '(974) Réunion', '(975) Saint Pierre et Miquelon', '(976) Mayotte'];
                              foreach ($departements as $key => $value)
                                echo '<option value="'.$key.'">'.$value.'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <p>Image de profil :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::text('email','', ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Description :</p>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::textarea('email','', 
                                  ['class' => 'form-control', 'size' => '30x5', ]) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                {!! Form::submit("Mettre à jour", ['class' => 'btn btn-success pull-right']) !!}
              </div>
              {!! Form::close() !!}
          </div>
          
          <!-- Modification du mot de passe -->
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

          <!-- Modification du mot de passe -->
          <div id="password" role="tabpanel" class="tab-pane fade">
              {!! Form::open(['url' => '/']) !!}
              <div class="modal-body">
                    <p>Mot de passe actuel :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <p>Nouveau mot de passe :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <p>Confirmation du nouveau mot de passe :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                {!! Form::submit("Modifier le mot de passe", ['class' => 'btn btn-success pull-right']) !!}
              </div>
              {!! Form::close() !!}
          </div>

          <!-- Suppression du compte-->    
          <div id="delete" role="tabpanel" class="tab-pane fade">
              {!! Form::open(['url' => '/']) !!}
              <div class="modal-body">
                    <p>Mot de passe actuel :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <p>Recopiez cette phrase dans le champ "Je souhaite supprimer mon compte" :</p>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email','', ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                {!! Form::submit("Confirmer la suppression", ['class' => 'btn btn-danger pull-right']) !!}
              </div>
              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>
</div>