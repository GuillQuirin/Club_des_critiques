<div id="collapseCategory" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="btnShowAddCategory">
                Ajouter une catégorie
            </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-block">
            <form>
                <div class="form-group">
                    <label for="name" class="col-2 col-form-label">Nom : </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="name" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent" class="col-2 col-form-label">Parent : </label>
                    <div class="col-10">
                        <select class="form-control" id="parent" name="parent">
                            <option value="">Pas de parent</option>
                            <option value="1">Livre</option>
                            <option value="2">Film</option>
                            <option value="3">...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="url_picture" name="url_picture">
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="btnHideAddCategory">
                        Annuler
                    </button>   
                    <button type="submit" class="btn btn-success">Ajouter la catégorie</button>
                </div>
            </form>
            <br><br>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="categoryTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Parent</th>
                            <th>Url image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Livre</th>
                            <th></th>
                            <th>petite url</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editCategoryModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>
                        <tr>
                            <th>Film</th>
                            <th></th>
                            <th>petite url</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editCategoryModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>
                        <tr>
                            <th>Roman policier</th>
                            <th>Livre</th>
                            <th>petite url</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editCategoryModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>





<!-- MODAL MODIFICATION CATEORIE -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modifier la catégorie</h4>
            </div>
            <form>
                <div class="modal-body">
                        <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent" class="col-2 col-form-label">Parent : </label>
                        <div class="col-10">
                            <select class="form-control" id="parent" name="parent">
                                <option value="">Pas de parent</option>
                                <option value="1">Livre</option>
                                <option value="2">Film</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="url_picture" name="url_picture">
                        </div>
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
