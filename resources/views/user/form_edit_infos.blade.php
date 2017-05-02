<div id="informations" role="tabpanel" class="tab-pane fade in active">
    {!! Form::model($infos, ['method' => 'PATCH','files'=> true ,'route' => ['update_user', $infos->id]]) !!}
    <div class="modal-body row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('lastNameUpdate','Nom') !!}
              {!! Form::text('last_name', $infos->last_name,[ 'id' => 'lastNameUpdate',
                                                              'class' => 'form-control']) !!}
              {!! $errors->first('lastNameUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('firstNameUpdate','Prénom') !!}
              {!! Form::text('first_name', $infos->first_name,[ 'id' => 'firstNameUpdate',
                                                                'class' => 'form-control']) !!}
              {!! $errors->first('firstNameUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('emailUpdate','Adresse email') !!}
              {!! Form::email('email', $infos->email, ['id'=>'emailUpdate','class' => 'form-control']) !!}
              {!! $errors->first('emailUpdate', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('isContactable','Joignable par email') !!}
              {!! Form::checkbox('is_contactable', '1', $infos->is_contactable,['id' => 'isContactable','class' => 'form-control']) !!}
              {!! $errors->first('isContactable', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
              {!! Form::label('pictureInfo','Image de profil') !!}
              {!! Form::file('picture', ['id' => 'pictureInfo']) !!}
              {!! $errors->first('pictureInfo', '<small class="help-block">:message</small>') !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <?php 
            $departements = [
                    '(00) Hors France',
                    '(01) Ain',
                    '(02) Aisne',
                    '(03) Allier',
                    '(04) Alpes de Haute Provence',
                    '(05) Hautes Alpes',
                    '(06) Alpes Maritimes',
                    '(07) Ardèche',
                    '(08) Ardennes',
                    '(09) Ariège',
                    '(10) Aube',
                    '(11) Aude',
                    '(12) Aveyron',
                    '(13) Bouches du Rhône',
                    '(14) Calvados',
                    '(15) Cantal',
                    '(16) Charente',
                    '(17) Charente Maritime',
                    '(18) Cher',
                    '(19) Corrèze',
                    '(2A) Corse du Sud',
                    '(2B) Haute-Corse',
                    '(21) Côte d\'Or',
                    '(22) Côtes d\'Armor',
                    '(23) Creuse',
                    '(24) Dordogne',
                    '(25) Doubs',
                    '(26) Drôme',
                    '(27) Eure',
                    '(28) Eure et Loir',
                    '(29) Finistère',
                    '(30) Gard',
                    '(31) Haute Garonne',
                    '(32) Gers',
                    '(33) Gironde',
                    '(34) Hérault',
                    '(35) Ille et Vilaine',
                    '(36) Indre',
                    '(37) Indre et Loire',
                    '(38) Isère',
                    '(39) Jura',
                    '(40) Landes',
                    '(41) Loir et Cher',
                    '(42) Loire',
                    '(43) Haute Loire',
                    '(44) Loire Atlantique',
                    '(45) Loiret',
                    '(46) Lot',
                    '(47) Lot et Garonne',
                    '(48) Lozère',
                    '(49) Maine et Loire',
                    '(50) Manche',
                    '(51) Marne',
                    '(52) Haute Marne',
                    '(53) Mayenne',
                    '(54) Meurthe et Moselle',
                    '(55) Meuse',
                    '(56) Morbihan',
                    '(57) Moselle',
                    '(58) Nièvre',
                    '(59) Nord',
                    '(60) Oise',
                    '(61) Orne',
                    '(62) Pas de Calais',
                    '(63) Puy de Dôme',
                    '(64) Pyrénées Atlantiques',
                    '(65) Hautes Pyrénées',
                    '(66) Pyrénées Orientales',
                    '(67) Bas Rhin',
                    '(68) Haut Rhin',
                    '(69) Rhône',
                    '(70) Haute Saône',
                    '(71) Saône et Loire',
                    '(72) Sarthe',
                    '(73) Savoie',
                    '(74) Haute Savoie',
                    '(75) Paris',
                    '(76) Seine Maritime',
                    '(77) Seine et Marne',
                    '(78) Yvelines',
                    '(79) Deux Sèvres',
                    '(80) Somme',
                    '(81) Tarn',
                    '(82) Tarn et Garonne',
                    '(83) Var',
                    '(84) Vaucluse',
                    '(85) Vendée',
                    '(86) Vienne',
                    '(87) Haute Vienne',
                    '(88) Vosges',
                    '(89) Yonne',
                    '(90) Territoire de Belfort',
                    '(91) Essonne',
                    '(92) Hauts de Seine',
                    '(93) Seine Saint Denis',
                    '(94) Val de Marne',
                    '(95) Val d\'Oise',
                    '971' => '(971) Guadeloupe',
                    '972' => '(972) Martinique',
                    '973' => '(973) Guyane',
                    '974' => '(974) Réunion',
                    '975' => '(975) Saint Pierre et Miquelon',
                    '976' => '(976) Mayotte'];
                ?>
            <div class="form-group">
              {!! Form::label('locationInfo','Localisation') !!}
              {!! Form::select('location',$departements, $infos->location,['id' => 'locationInfo']) !!}
              {!! $errors->first('locationInfo', '<small class="help-block">:message</small>') !!}
            </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  {!! Form::label('descriptionInfo','Description') !!}
                  {!! Form::textarea('description', $infos->description,[ 'id' => 'descriptionInfo',
                                                                          'class' => 'form-control', 
                                                                          'size' => '30x5', ]) !!}
                  {!! $errors->first('descriptionInfo', '<small class="help-block">:message</small>') !!}
              </div>
          </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      {!! Form::submit("Mettre à jour", ['class' => 'btn btn-success pull-right']) !!}
    </div>
    {!! Form::close() !!}
</div>