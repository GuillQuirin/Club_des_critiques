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
          @include('user.form_edit_infos')
          
          <!-- Modification du mot de passe -->
          @include('user.form_edit_exchange')

          <!-- Modification du mot de passe -->
          @include('user.form_edit_pwd')

          <!-- Suppression du compte-->    
          @include('user.form_delete_account')
      </div>
    </div>
  </div>
</div>