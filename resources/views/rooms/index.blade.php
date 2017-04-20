@extends('templates/template')

@section('css')
     <link rel="stylesheet" type="text/css" href="{{asset('css/rooms.css')}}">    
@endsection

@section('title')
    Liste des salons à venir
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Les salons à venir</h1>
        </div>
        <table id="salons" class="table table-hover table-responsive" cellspacing="0">
            <thead>
                <tr>
                    <th>Titre (auteur)</th>
                    <th>Dates du salon</th>
                    <th>Numéro du salon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 15; $i++) { ?>
                <tr>
                    <td>Harry Potter <?php echo $i;?> (J.K Rowling)</td>
                    <td>Du 01/05/2017 au 01/07/2017</td>
                    <td>Salon 1</td>
                    <td><button type="button" class="btn btn-success">Rejoindre le salon</button></td>
                </tr>
                <?php } ?>
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
        } );
    </script>
@endsection