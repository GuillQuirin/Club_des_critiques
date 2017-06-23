      
<div id="collapseRoom" class="panel-collapse collapse">                     
    <div class="panel-body">                
        <p>
          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddSalon" aria-expanded="false" aria-controls="collapseAddSalon" id="btnShowAddRoom">
            Ajouter un salon
          </button>
        </p>
        <div class="collapse" id="collapseAddSalon">
            <div class="card card-block">
                {{ Form::open(['route' => 'add_room', 'method' => 'post', 'class' => 'col-md-12']) }}
                    <div class="form-group">
                        <label for="room_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="room_name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_category" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select id="room_category" name="category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir une catégorie">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_sub_category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select id="room_sub_category" name="sub_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
                                <option value="">Vous devez choisir une catégorie</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_element" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                           <select id="room_element" name="element" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" disabled>
                                <option value="">Vous devez choisir une sous catégorie</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input type='text' class="form-control" id='room_date_start' name="date_start" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input type='text' class="form-control" id='room_date_end' name="date_end" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_date_end" class="col-2 col-form-label">Status : </label>
                        <div class="col-10">
                            <select id="room_status" name="status" class="form-control selectpicker" required>
                                <option value="0">Inactif</option>
                                <option value="1">Actif</option>
                            </select>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddSalon" aria-expanded="false" aria-controls="collapseAddSalon" id="btnHideAddRoom">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-success">Ajouter un salon</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table id="roomTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
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
                        @foreach($rooms as $room)
                        <tr>
                            <td class="room-id">{{ $room->id }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->element->name }}</td>
                            <td>{{ $room->date_start }}</td>
                            <td>{{ $room->date_end }}</td>
                            <td>{{ $room->users()->count() }}</td>
                            <td>
                                @if($room->status == 0)
                                    Inactif
                                @else
                                    Actif
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn edit-room"><i class="fa fa-pencil"></i></a>
                                <i class="fa fa-users show-user-room" aria-hidden="true" id="{{ $room->id }}"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>        
                </table>
            </div>
        </div>       
    </div>
</div>


<!-- MODAL LISTE USER -->
<div class="modal fade" id="userRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Liste des utilisateurs</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="roomId">
                <ul class="list-group" id="listUsersRoom">
                </ul>
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
                <div class="modal-body">
                    {{ Form::open(['route' => 'edit_room', 'method' => 'put', 'class' => 'col-md-12']) }}
                    <input type="hidden" name="id" id="id_room">
                    <div class="form-group">
                        <label for="edit_room_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_room_name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_category" class="col-2 col-form-label">Catégorie : </label>
                        <div class="col-10">
                            <select id="edit_room_category" name="category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir une catégorie">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_sub_category" class="col-2 col-form-label">Sous catégorie : </label>
                        <div class="col-10">
                            <select id="edit_room_sub_category" name="sub_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_element" class="col-2 col-form-label">Oeuvre : </label>
                        <div class="col-10">
                           <select id="edit_room_element" name="element" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_date_start" class="col-2 col-form-label">Date début : </label>
                        <div class="col-10">
                            <input type='text' class="form-control" id='edit_room_date_start' name="date_start" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_date_end" class="col-2 col-form-label">Date fin : </label>
                        <div class="col-10">
                            <input type='text' class="form-control" id='edit_room_date_end' name="date_end" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_status" class="col-2 col-form-label">Status : </label>
                        <div class="col-10">
                            <select id="edit_room_status" name="status" class="form-control selectpicker" required>
                                <option value="0">Inactif</option>
                                <option value="1">Actif</option>
                            </select>
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
