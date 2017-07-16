<div id="collapseCategory" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
            <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="btnShowAddCategory">
                Créer une catégorie
            </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-block">
            {{ Form::open(['route' => 'add_category', 'method' => 'post', 'class' => 'col-md-12']) }}
                <div class="form-group">
                    <label for="name" class="col-2 col-form-label">Nom : </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="name" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent_category" class="col-2 col-form-label">Parent : </label>
                    <div class="col-10">
                        <select id="parent_category" name="parent_category" class="form-control selectpicker"  data-size="7" data-live-search="true" required="required">
                            <option value="0" selected>Pas de parent</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
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
            {{ Form::close() }}
            <br><br>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="categoryTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><Id</th>
                            <th>Nom</th>
                            <th>Parent</th>
                            <th>Url image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allCategories as $category)
                        <tr>                        
                            <td class="category-id">{{ $category->id }}</td>
                            <td class="category-name">{{ $category->name }}</td>
                            <td class="category-parent" id="@if($category->isSubCategory()){{ $category->parent->id }}@else 0 @endif">
                                @if($category->isSubCategory())
                                    {{ $category->parent->name }}
                                @else
                                    /
                                @endif                                
                            </td>
                            <td class="category-picture">{{ $category->url_picture }}</td>
                            <td>
                                <a href="#" class="btn edit-category"><i class="fa fa-pencil"></i></a>
                                <i class="fa fa-trash delete-category" aria-hidden="true" id="{{ $category->id }}"></i>
                            </td>                               
                        </tr>
                        @endforeach
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
            {{ Form::open(['route' => 'edit_category', 'method' => 'put']) }}
                <div class="modal-body">
                        <input type="hidden" name="id" id="id_category">
                        <div class="form-group">
                        <label for="name" class="col-2 col-form-label">Nom : </label>
                        <div class="col-10">
                            <input class="form-control edit-category-name" type="text" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent" class="col-2 col-form-label">Parent : </label>
                        <div class="col-10">
                            <select id="edit_parent_category" name="parent_category" class="form-control selectpicker edit-category-parent"  data-size="7" data-live-search="true" required="required">
                                <option value="0" selected>Pas de parent</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label for="url_picture" class="col-2 col-form-label">Url de l'image : </label>
                        <div class="col-10">
                            <input class="form-control edit-category-picture" type="text" id="url_picture" name="url_picture">
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
