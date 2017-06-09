<div id="collapseElement" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddElement" aria-expanded="false" aria-controls="collapseAddElement" id="btnShowAddElement">
            Ajouter une oeuvre
          </button>
        </p>
        <div class="collapse" id="collapseAddElement">
          <div class="card card-block">
            {{ Form::open(['route' => 'add_element', 'method' => 'post', 'class' => 'col-md-12']) }}
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
                            <input class="form-control" type="text" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="creator" class="col-2 col-form-label">Aueur / réalisateur : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="creator" name="creator" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent_cat" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select id="element_category" name="category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir une catégorie">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select id="element_sub_category" name="sub_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
                                <option value="">Vous devez choisir une catégorie</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="element_url_picture" name="url_picture">
                        </div>
                    </div>

                    <div class="form-group" id="datePublication">
                        <label for="date_publication" class="col-2 col-form-label">Date publication : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="element_date_publication" name="date_publication">
                        </div>
                    </div>

                    <div class="form-group" id="dateStart">
                        <label for="date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="element_date_start" name="date_start">
                        </div>
                    </div>

                    <div class="form-group " id="dateEnd">
                        <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="element_date_end" name="date_end">
                        </div>
                    </div>

                    <div class="form-group " id="description">
                        <label for="date_end" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" rows="5" id="element_description" name="description"></textarea>
                        </div>
                    </div>

                </div>
                <div class="pull-right">
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddElement" aria-expanded="false" aria-controls="collapseAddElement" id="btnHideAddElement">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-success">Ajouter l'oeuvre</button>
                </div>                
            {{ Form::close() }}
            <br><br>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="elementTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
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
                                <td class="element-id">{{ $element->id }}</td>
                                <td>{{ $element->name }}</td>
                                <td>{{ $element->creator }}</td>
                                <td>{{ $element->category['parent']['name'] }}</td>
                                <td>{{ $element->category['name'] }}</td>
                                <td>
                                    <i class="fa fa-trash delete-element" aria-hidden="true" id="{{ $element->id }}"></i>
                                    <a href="#" class="btn edit-element"><i class="fa fa-pencil"></i></a>
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
                <h4 class="modal-title">Modifier l'oeuvre</h4>
            </div>
            {{ Form::open(['route' => 'edit_element', 'method' => 'put']) }}
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_element">
                    <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Titre : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="creator" class="col-2 col-form-label">Aueur / réalisateur : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_creator" name="creator">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent_cat" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select id="edit_element_category" name="parent_category" class="form-control selectpicker edit_element_category"  data-size="7" data-live-search="true" required="required">
                                <option value="0" selected>Pas de parent</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select id="edit_element_sub_category" name="sub_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_url_picture" name="url_picture">
                        </div>
                    </div>

                    <div class="form-group" id="datePublicationEdit">
                        <label for="date_publication" class="col-2 col-form-label">Date publication : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_date_publication" name="date_publication">
                        </div>
                    </div>

                    <div class="form-group" id="dateStartEdit">
                        <label for="date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_date_start" name="date_start">
                        </div>
                    </div>

                    <div class="form-group " id="dateEndEdit">
                        <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_element_date_end_" name="date_end">
                        </div>
                    </div>
                    <div class="form-group " id="description">
                        <label for="date_end" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" rows="5" id="edit_element_description" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
