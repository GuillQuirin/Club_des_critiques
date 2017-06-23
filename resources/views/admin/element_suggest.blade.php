<div id="collapseElementSuggest" class="panel-collapse collapse">
    <div class="panel-body">
    	<div class="row">
            <div class="col-md-12">
                <table id="elementSuggestTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Utilisateur</th>                            
                            <th>Nom</th>
                            <th>Auteur</th>
                            <th>Catégorie</th>
                            <th>Status</th>
                            <th>Action</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($elementSuggests as $elementSuggest)
                            <tr>
                                <td class="element-id">{{ $elementSuggest->id }}</td>
                                <td>{{ $elementSuggest->user->first_name }} {{ $elementSuggest->user->last_name }} ({{ $elementSuggest->id_user }})</td>
                                <td>{{ $elementSuggest->name }}</td>
                                <td>{{ $elementSuggest->creator }}</td>
                                <td>{{ $elementSuggest->category }}</td>
                                <td>{{ $elementSuggest->status }}</td>
                                <td>
                                    <i class="fa fa-trash valide-element-suggest" aria-hidden="true" id="{{ $elementSuggest->id }}"></i>
                                    <i class="fa fa-trash refuse-element-suggest" aria-hidden="true" id="{{ $elementSuggest->id }}"></i>                                    
                                </td>                               
                            </tr>
                        @endforeach
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>