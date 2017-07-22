@extends('templates/template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">
@endsection

@section('title')
    Liste de tous les salons
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Liste de tous les salons
                @if(Auth::guest())
                    <small>Pour rejoindre un salon à venir, veuillez vous connecter.</small>
                @endif
            </h1>
            @if($rooms)
                <table id="salons" class="table table-hover table-responsive" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nom du salon</th>
                        <th>Titre (auteur)</th>
                        <th>Dates du salon</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{$room->name}}</td>
                            <td>{{$room->element->name}} ({{$room->element->creator}})</td>
                            <td>Du {{date("d/m/Y", strtotime($room->date_start))}}
                                au {{date("d/m/Y", strtotime($room->date_end))}}
                            </td>
                            <td>
                                @if($room->status === 1)
                                    @if ($user_room->contains(function ($user_room, $key) use ($room) {
            return $user_room->id_room == $room->id && $user_room->id_user == Auth::id();
            }))
                                        <a class="btn" href="{{route('show_room', [ 'id' => $room->id ])}}">
                                            Accéder au salon
                                        </a>
                                    @else
                                        Salon en cours
                                    @endif
                                @elseif(($room->status === 2))
                                    @if(Auth::check())
                                        @if(!($user_element->contains('id_element', $room->element->id)))
                                            <button type="button"
                                                    class="btn btn-success"
                                                    data-toggle="modal"
                                                    data-target="#joinRoom"
                                                    data-title="{{$room->element->name}}"
                                                    data-autor="{{$room->element->creator}}"
                                                    data-salon="Salon 1">
                                                M'inscrire au salon
                                            </button>
                                            <div class="modal fade" id="joinRoom" tabindex="300" role="dialog"
                                                 aria-labelledby="myModalLabel">
                                                {{ Form::open(['route' => 'join_room', 'method' => 'post', 'class' => 'col-md-12']) }}
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h1 class="text-center text-uppercase col-xs-10 col-sm-12">{{$room->element->name}}
                                                                <small>({{$room->element->creator}})</small>
                                                            </h1>
                                                            <div class="text-center" id="div_note">
                                                                <h3>Donnez une note !</h3>
                                                                <div class="rating">
                                                                    <a href="#4" title="Donner 4 étoiles">☆</a>
                                                                    <a href="#3" title="Donner 3 étoiles">☆</a>
                                                                    <a href="#2" title="Donner 2 étoiles">☆</a>
                                                                    <a href="#1" title="Donner 1 étoile">☆</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="element" value="{{$room->element->id}}"/>
                                                            <input type="hidden" id="note" name="note"/>
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button type="submit" class="btn btn-success btn-lg">Rejoindre
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{Form::close()}}
                                        @else
                                            Salon déjà rejoint !
                                        @endif
                                    @endif
                                    </div>
                                @elseif(($room->status === 3))
                                    Salon interrompu
                                @else
                                    Salon terminé
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                Il n'y a pas de salons existants. Revenez plus tard !
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
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

            $('#joinRoom').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var title = button.data('title')
                var autor = button.data('autor')
                var salon = button.data('salon')
                var id_room = button.data('id_room')
                var modal = $(this)
                modal.find('.modal-body #title').text(title + " - " + salon)
                modal.find('.modal-body #autor small').text(autor)
                modal.find('.modal-title').text(salon)
                modal.find('.modal-body #room').val(id_room)
            })

            $('.rating').children('a').each(function(){
                $(this).click(function(){
                    //alert(this.getAttribute("href"));
                    document.getElementById('note').value = this.getAttribute("href").substring(1);
                })
            })
        });
    </script>
@endsection