<div id="collapseUser" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddUser" aria-expanded="false" aria-controls="collapseAddUser" id="btnShowAddUser">
            Ajouter un utilisateur
          </button>
        </p>
        <div class="collapse" id="collapseAddUser">
            <div class="card card-block">
                {{ Form::open(['route' => 'add_user', 'method' => 'post', 'class' => 'col-md-12']) }}
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="user_last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-2 col-form-label">Prénom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="user_first_name" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" id="user_description" name="description" rows="3"></textarea>
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
                            <select id="user_department" name="department" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir un département">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->code}} {{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-2 col-form-label">Email : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="user_email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-2 col-form-label">Status : </label>
                        <div class="col-10">
                            <select id="user_status" name="status" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required" title="Choisir un status"> 
                                 @foreach($status as $st)
                                    <option value="{{$st->id}}">{{$st->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddUser" aria-expanded="false" aria-controls="collapseAddUser" id="btnHideAddUser">
                            Annuel
                        </button>
                        <button type="submit" class="btn btn-success">Ajouter un utilisateur</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="userTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Département</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allUsers as $user)
                        <tr>
                            <td class="user-id">{{ $user->id }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->department->name }}</td>
                            <td>{{ $user->picture }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="user-status">{{ $user->status->label }}</td>
                            <td>
                                <a href="#" class="btn edit-user"><i class="fa fa-pencil"></i></a>
                                @if($user->id_status != 5)
                                    <i class="fa fa-ban ban-user" aria-hidden="true" id="{{ $user->id }}"></i> 
                                @endif
                                @if($user->status->id_status != 6)
                                    <i class="fa fa-trash delete-user" aria-hidden="true" id="{{ $user->id }}" style="padding: 6px 12px;"></i>
                                @endif
                            </td>                               
                        </tr>
                        @endforeach
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
                <h4 class="modal-title">Modifier l'utilisateur</h4>
            </div>
            {{ Form::open(['route' => 'edit_user', 'method' => 'put']) }}
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_user">
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_user_last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-2 col-form-label">Prénom : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_user_first_name" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-2 col-form-label">Description : </label>
                        <div class="col-10">
                            <textarea class="form-control" id="edit_user_descrition" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture" class="col-2 col-form-label">Url image : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="edit_user_picture" name="picture">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-2 col-form-label">Département : </label>
                        <div class="col-10">
                            <select id="edit_user_department" name="department" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->code}} {{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-2 col-form-label">Email : </label>
                        <div class="col-10">
                            <input class="form-control" type="email" id="edit_user_email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-2 col-form-label">Status : </label>
                        <div class="col-10">
                            <select id="edit_user_status" name="status" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required"> 
                                 @foreach($status as $st)
                                    <option value="{{$st->id}}">{{$st->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
