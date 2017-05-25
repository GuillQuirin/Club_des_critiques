<div id="collapseElement" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddElement" aria-expanded="false" aria-controls="collapseAddElement" id="btnShowAddElement">
            Ajouter une oeuvre
          </button>
        </p>
        <div class="collapse" id="collapseAddElement">
          <div class="card card-block">
            <form>
                <fieldset class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" id="radioElementManual" name="radioElement" value="manual" checked>
                        Création manuelle
                      </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" id="radioElementAutomatic" name="radioElement" value="automatic">
                        Création automatique
                      </label>
                    </div>                    
                </fieldset>

                <div id="elementAutomatic">
                    <div class="form-group">
                        <label for="url_api" class="col-2 col-form-label">Url du produit : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="url_api" name="url_api">
                        </div>
                    </div>
                </div>

                <div id="elementManual">
                    <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Titre : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="creator" class="col-2 col-form-label">Aueur / réalisateur : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="creator" name="creator">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent_cat" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="parent_cat" name="parent_cat">
                                <option>Choisir une catégorie</option>
                                <option value="1">Livre</option>
                                <option value="2">Film</option>
                                <option value="3">Expo</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="category" name="category">
                                <option>Choisir une sous catégorie</option>
                                <option value="1">Roman policier</option>
                                <option value="2">Nouvelle</option>
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

                    <div class="form-group" id="datePublication">
                        <label for="date_publication" class="col-2 col-form-label">Date publication : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_publication" name="date_publication">
                        </div>
                    </div>

                    <div class="form-group" id="dateStart">
                        <label for="date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_start" name="date_start">
                        </div>
                    </div>

                    <div class="form-group " id="dateEnd">
                        <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_end" name="date_end">
                        </div>
                    </div>

                </div>
                <div class="pull-right">
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddElement" aria-expanded="false" aria-controls="collapseAddElement" id="btnHideAddElement">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-success">Ajouter l'oeuvre</button>
                </div>                
            </form>
            <br><br>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="elementTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Auteur</th>
                            <th>Catégorie</th>
                            <th>Sous catégorie</th>
                            <th>Action</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->name }}</td>
                                <td>{{ $element->creator }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <i class="fa fa-trash delete-element" aria-hidden="true" id="{{ $element->id }}"></i>
                                    <i class="fa fa-pencil edit-element" data-toggle="modal" data-target="#editElementModal" aria-hidden="true" id="{{ $element->id }}"></i>
                                </td>                               
                            </tr>
                        @endforeach
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>





<!-- MODAL MODIFICATION ELEMENT -->
<div class="modal fade" id="editElementModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modifier l'oeuvre</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Titre : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="name_edit" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="creator" class="col-2 col-form-label">Aueur / réalisateur : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="creator_edit" name="creator">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent_cat" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="parent_cat_edit" name="parent_cat">
                                <option>Choisir une catégorie</option>
                                <option value="1">Livre</option>
                                <option value="2">Film</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="category_edit" name="category">
                                <option>Choisir une sous catégorie</option>
                                <option value="1">Roman policier</option>
                                <option value="2">Nouvelle</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="url_picture_edit" name="url_picture">
                        </div>
                    </div>

                    <div class="form-group" id="datePublicationEdit">
                        <label for="date_publication" class="col-2 col-form-label">Date publication : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_publication_edit" name="date_publication">
                        </div>
                    </div>

                    <div class="form-group" id="dateStartEdit">
                        <label for="date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_start_edit" name="date_start">
                        </div>
                    </div>

                    <div class="form-group " id="dateEndEdit">
                        <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_end_edit" name="date_end">
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
