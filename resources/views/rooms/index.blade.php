@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">    
@endsection

@section('title')
    Liste des salons à venir
@endsection

@section('content')
    <div class="container">
            <h1 class="text-center">Les salons à venir @if(Auth::guest())<small>Pour rejoindre un salon à venir, veuillez vous connecter.</small>@endif</h1>

            <table id="salons" class="table table-hover table-responsive" cellspacing="0">
                <thead>
                    <tr>
                        <th>Titre (auteur)</th>
                        <th>Dates du salon</th>
                        @if(Auth::check())
                            <th>Information</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{$room->element->name}} ({{$room->element->creator}})</td>
                        <td>Du {{date("d/m/Y", strtotime($room->date_start))}} au {{date("d/m/Y", strtotime($room->date_end))}}</td>
                        @if(Auth::check())
                        <td> @if(!($user_room->contains('id_room', $room->id)))
                                <button type="button"
                                        class="btn btn-success"
                                        data-toggle="modal"
                                        data-target="#join"
                                        data-title="{{$room->room['element']['name']}}"
                                        data-autor="{{$room->room['element']['creator']}}"
                                        data-salon="Salon 1">
                                    Rejoindre le salon
                                </button>
                            @else
                                 Salon déjà rejoint !
                            @endif
                        </td>
                        @endif
                    </tr>
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
                                            <a href="#5" title="Donner 5 étoiles">☆</a>
                                            <a href="#4" title="Donner 4 étoiles">☆</a>
                                            <a href="#3" title="Donner 3 étoiles">☆</a>
                                            <a href="#2" title="Donner 2 étoiles">☆</a>
                                            <a href="#1" title="Donner 1 étoile">☆</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('join_room', ['id' => $room->id])}}" type="button" class="btn btn-primary">Rejoindre</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
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