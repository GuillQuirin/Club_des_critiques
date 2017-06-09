<div id="collapseFooter" class="panel-collapse collapse">
    <div class="panel-body">
        <p>
          <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseAddFooter" aria-expanded="false" aria-controls="collapseAddFooter" id="btnShowAddFooter">
            Ajouter un lien
          </button>
        </p>
        <div class="collapse" id="collapseAddFooter">
            <div class="card card-block">
                {{ Form::open(['route' => 'add_footer', 'method' => 'post', 'class' => 'col-md-12']) }}
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Libellé : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="footer_label" name="label" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-2 col-form-label">Route : </label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="footer_route" name="route">
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseAddFooter" aria-expanded="false" aria-controls="collapseAddFooter" id="btnHideAddFooter">
                            Annuel
                        </button>
                        <button type="submit" class="btn btn-success">Ajouter un lien</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="footerTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Label</th>
                            <th>Route</th>
                            <th>Action</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($footers as $footer)
                            <tr>
                                <td class="footer-id">{{ $footer->id }}</td>
                                <td class="footer-label">{{ $footer->label }}</td>
                                <td class="footer-route">{{ $footer->route }}</td>                                
                                <td>
                                    <a href="#" class="btn edit-footer"><i class="fa fa-pencil"></i></a>
                                    <i class="fa fa-trash delete-footer" aria-hidden="true" id="{{ $footer->id }}"></i>
                                </td>                               
                            </tr>
                        @endforeach
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>


<!-- MODAL MODIFICATION FOOTER -->
<div class="modal fade" id="editFooterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modifier le lien</h4>
            </div>            
                <div class="modal-body">
                    {{ Form::open(['route' => 'edit_footer', 'method' => 'put', 'class' => 'col-md-12']) }}
                    <input type="hidden" name="id" id="id_footer">
                        <div class="form-group">
                            <label for="last_name" class="col-2 col-form-label">Libellé : </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="edit_footer_label" name="label" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-2 col-form-label">Route : </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="edit_footer_route" name="route">
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
</div>
