<div id="collapse5" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddUser" aria-expanded="false" aria-controls="collapseAddUser" id="btnShowAddUser">
            Ajouter un utilisateur
          </button>
        </p>
        <div class="collapse" id="collapseAddUser">
            <div class="card card-block">
                <form>
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-2 col-form-label">Prénom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture" class="col-2 col-form-label">Url image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="picture" name="picture">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-2 col-form-label">Département : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="location" name="location">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-2 col-form-label">Email : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="email" name="email">
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddUser" aria-expanded="false" aria-controls="collapseAddUser" id="btnHideAddUser">
                            Annuel
                        </button>
                        <button type="submit" class="btn btn-success">Ajouter un utilisateur</button>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="userTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Département</th>
                            <th>Url image</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Poirier</th>
                            <th>Elise</th>
                            <th>Yvelines</th>
                            <th>url</th>
                            <th>elise@test.fr</th>
                            <th>Valide</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editUserModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>                               
                        <tr>
                            <th>Poirier</th>
                            <th>Elise</th>
                            <th>Yvelines</th>
                            <th>url</th>
                            <th>elise@test.fr</th>
                            <th>Valide</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editUserModal" aria-hidden="true"></i>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<!-- MODAL MODIFICATION UTILISATEUR-->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modifier l'utilisateur</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-2 col-form-label">Prénom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture" class="col-2 col-form-label">Url image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="picture" name="picture">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-2 col-form-label">Département : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="location" name="location">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-2 col-form-label">Email : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_reported" id="is_reported">
                            Bannir
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
