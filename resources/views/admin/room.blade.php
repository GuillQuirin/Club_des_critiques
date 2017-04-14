        
<div id="collapse4" class="panel-collapse collapse">                     
    <div class="panel-body">                
        <p>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddSalon" aria-expanded="false" aria-controls="collapseAddSalon" id="btnShowAddRoom">
            Ajouter un salon
          </button>
        </p>
        <div class="collapse" id="collapseAddSalon">
            <div class="card card-block">
                <form>
                    <div class="form-group">
                        <label for="room_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="room_name" name="room_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_category" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="room_category" name="room_category">
                                <option>Choisir une catégorie</option>
                                <option value="1">Livre</option>
                                <option value="2">Film</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_element" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                            <select class="form-control" id="room_element" name="room_element">
                                <option>Choisir une oeuvre</option>
                                <option value="1">Le petit chaperon rouge</option>
                                <option value="2">La belle et la bete</option>
                                <option value="3">Le roi lion</option>
                                <option value="4">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="room_date_start" name="room_date_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="room_date_end" name="room_date_end">
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddSalon" aria-expanded="false" aria-controls="collapseAddSalon" id="btnHideAddRoom">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-success">Ajouter un salon</button>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table id="roomTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Oeuvre</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Nombre participant</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Un salon</th>
                            <th>Petit chaperon rouge</th>
                            <th>01/05/2017</th>
                            <th>04/05/2017</th>
                            <th>17</th>
                            <th>A venir</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editRoomModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>                               
                        <tr>
                            <th>Un autre salon</th>
                            <th>Le roi lion</th>
                            <th>10/04/2017</th>
                            <th>15/04/2017</th>
                            <th>9</th>
                            <th>En cours</th>
                            <th>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#editRoomModal" aria-hidden="true"></i>
                            </th>                               
                        </tr>   
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>



<!-- MODAL MODIFICATION -->
<div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modifier le salon</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="room_name_edit" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="room_name_edit" name="room_name_edit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_category_edit" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select class="form-control" id="room_category_edit" name="room_category_edit">
                                <option>Choisir une catégorie</option>
                                <option value="1">Livre</option>
                                <option value="2">Film</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_element_edit" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                            <select class="form-control" id="room_element_edit" name="room_element_edit">
                                <option>Choisir une oeuvre</option>
                                <option value="">Le petit haperon rouge</option>
                                <option value="1">La belle et la bete</option>
                                <option value="2">Le roi lion</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="room_date_start_edit" class="col-2 col-form-label">Date début : </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="room_date_start_edit" name="room_date_start_edit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="room_date_end_edit" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="room_date_end_edit" name="room_date_end_edit">
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
