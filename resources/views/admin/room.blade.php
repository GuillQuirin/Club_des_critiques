        
<div id="collapse4" class="panel-collapse collapse">                     
    <div class="panel-body">                
        <p>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAddSalon" aria-expanded="false" aria-controls="collapseAddSalon">
            Ajouter un salon
          </button>
        </p>
        <div class="collapse" id="collapseAddSalon">
            <div class="card card-block">
                <form>
                    <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                            <select class="form-control" id="parent" name="parent">
                                <option>Choisir une oeuvre</option>
                                <option value="">Le petit haperon rouge</option>
                                <option value="1">La belle et la bete</option>
                                <option value="2">Le roi lion</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="date_start" name="date_start">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="date_end" name="date_end">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Ajouter un salon</button>
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
                        <label for="name" class="col-2 col-form-label">Nom : </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="parent" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                            <select class="form-control" id="parent" name="parent">
                                <option>Choisir une oeuvre</option>
                                <option value="">Le petit haperon rouge</option>
                                <option value="1">La belle et la bete</option>
                                <option value="2">Le roi lion</option>
                                <option value="3">...</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="date_start" class="col-2 col-form-label">Date début : </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="date_start" name="date_start">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="date_end" name="date_end">
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
