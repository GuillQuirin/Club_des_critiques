@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">    
@endsection

@section('title')
    Mes salons
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Mes salons</h1>
            @if($test)
            <table id="salons" class="table table-hover table-responsive" cellspacing="0">
                <thead>
                <tr>
                    <th>Nom du salon</th>
                    <th>Titre (Auteur)</th>
                    <th>Catégorie</th>
                    <th>Date de publication</th>
                    <th>Dates du salon</th>
                    <th>Numéro du salon</th>
                    <th>Note attribuée</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($test as $room)
                    <tr>
                        <td>{{$room->room_name}}</td>
                        <td>{{$room->element_name}} ({{$room->creator}})</td>
                        <td>{{$room->category}}</td>
                        <td>{{date("d/m/Y i:m:s", strtotime($room->date_publication))}}</td>
                        <td>Du {{date("d/m/Y", strtotime($room->date_start))}} au {{date("d/m/Y", strtotime($room->date_end))}}</td>
                        <td>{{$room->number}}</td>
                        <td>{{$room->mark}}</td>
                        <td>@if($room->status_user != 0)
                                <a class="btn" href="{{route('show_room', [ 'id' => $room->id_room ])}}">Accéder au salon</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                Vous n'avez encore participé à aucun salon !
            @endif
        </div>
    </div>

    <div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center text-uppercase col-xs-10 col-sm-12" id="title"></h1>
                    <h1 class="text-center text-uppercase col-xs-10 col-sm-12" id="autor"><small></small></h1>

                    <div class="text-center" id="div_note">
                        <h3>Donnez une note !</h3>
                        <div class="rating">
                            <a href="#4" title="Donner 4 étoiles">☆</a>
                            <a href="#3" title="Donner 3 étoiles">☆</a>
                            <a href="#2" title="Donner 2 étoiles">☆</a>
                            <a href="#1" title="Donner 1 étoile">☆</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Rejoindre</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#salons').dataTable({
                "language": {
                    "infoEmpty": "No entries to show",
                    "info": "Affichage des enregistrements _START_ à _END_ sur _TOTAL_",
                    "paginate": {
                        "previous": "Précédent",
                        "next": "Suivant"
                    },
                    "search": "Recherche : ",
                    "lengthMenu": "Affichage par _MENU_ enregistrements"
                }
            });

            $('#join').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var title = button.data('title')
                var autor = button.data('autor')
                var salon = button.data('salon')
                var modal = $(this)
                modal.find('.modal-body #title').text(title + " - " + salon)
                modal.find('.modal-body #autor small').text(autor)
                modal.find('.modal-title').text(salon)
            })
        });
    </script>
@endsection