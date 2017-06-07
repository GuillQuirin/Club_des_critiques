<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="TVA3m8pMDsnZVrewoidSwfikQtr8esxp1ftFD55VsSc" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title')</title>
    
        <!-- CSS -->
        {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
        {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css') !!}
        {!! HTML::style('font-awesome-4.7.0/css/font-awesome.css') !!}
        {!! HTML::style('DataTables/datatables.min.css') !!}
        {!! HTML::style('bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}
        {!! HTML::style('css/jquery-ui.min.css') !!}
        {!! HTML::style('css/jquery-ui.structure.min.css') !!}
        {!! HTML::style('css/jquery-ui.theme.min.css') !!}
        <!-- {!! HTML::style('bootstrap-select/dist/css/bootstrap-select.min.css') !!} -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        {!! HTML::style('css/template.css') !!}
        @yield('css')
    </head>
    <body>
        <header id="wrapper">
            <nav id="page-content-wrapper" class="navbar navbar-default navbar-fixed-top">
              <div class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" 
                            class="navbar-toggle collapsed" 
                            data-toggle="collapse" 
                            data-target="#bs-example-navbar-collapse-1" 
                            id="menu-toggle"
                            aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="/"><img class="logo" src="/images/logo.png" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 <div id="sidebar-wrapper"> 
                  <ul class="nav navbar-nav sidebar-nav">

                    <li class="visible-xs-block"><a href="{{ route('home') }}"><img class="logo" src="/images/logo.png" alt="logo"></a></li>
                  
                    <li class="hidden-xs hidden-sm"><a href="{{ route('home') }}">Accueil<span class="sr-only">(current)</span></a></li>

                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Oeuvres <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" id="listCategory" data-route="{{ route('listCategory') }}">
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('elements') }}">Toutes les oeuvres</a></li>
                            
                            @if(Auth::check())
                                <li role="separator" class="divider"></li>
                                <li><a href="" data-toggle="modal" data-target="#submitElement">Proposer une oeuvre</a></li>
                            @endif
                        </ul>
                    </li>

                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a  href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">Salons <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('futur_rooms') }}">Les salons à venir</a></li>
                            @if(Auth::check())
                                <li><a href="{{ route('my_rooms') }}">Mes salons</a></li>
                            @endif
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('rooms') }}">Tous les salons</a></li>
                        </ul>
                    </li>
 
                    <hr class="visible-xs-block">

                    <li class="dropdown">
                        <a href="{{ route('users') }}">
                            <span class="hidden-sm">La communauté</span>
                            <i class="visible-sm-block fa fa-users" aria-hidden="true"></i>
                            </a>
                    </li>

                    <hr class="visible-xs-block">

                    <li class="dropdown dropdownCountdown">
                        <a  id="nextRoomCountdown"
                            data-route="{{route('future_room')}}" 
                            data-countdown=""
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false"></a>

                        <div id="nextRoomDetails" class="dropdown-menu">
                            <p>Prochain salon : <span class="room"></span></p>
                            <p>Oeuvre : <span class="element"></span></p>
                            <p>Date de lancement : <span class="date"></span></p>
                            @if(Auth::check())
                                <a data-redirect="{{route('next_room')}}">Accèdez à la fiche du salon</a>
                            @else
                                <p>Connectez-vous pour accèder à la page du salon</p>
                            @endif
                        </div>
                    </li>
                    
                    <hr class="visible-xs-block">
                  </ul>

                  <ul class="nav navbar-nav navbar-right sidebar-nav">
                    <li class="dropdown">
                        
                        <a  href="#" 
                            class="dropdown-toggle hidden-sm" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">

                            @if(Auth::guest())
                                Connexion
                            @endif
                            @if(Auth::check())
                                Mon compte
                            @endif

                            <span class="caret"></span>
                        </a>
                        
                        <a  href="#" 
                            class="dropdown-toggle visible-sm-block" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                                <i  class="fa fa-sign-in" aria-hidden="true"></i>
                                <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            @if(Auth::guest())
                                <li>
                                    <a href="" data-toggle="modal" data-target="#loginModal">Authentification 
                                        <span class="badge">42</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="" data-toggle="modal" data-target="#registerModal">Inscription</a>
                                </li>
                            @endif
                            
                            @if(Auth::check())
                                <li>
                                    <a href="{{ route('show_user', ['id' => Auth::user()->id ]) }}">Mon compte</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}">Déconnexion</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('admin') }}">Administration</a></li>
                            @endif
                        </ul>
                    </li>
                  </ul>
                 </div>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav>
            
        </header>
        
        <?php 
        //FIL D'ARIANE
        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs; 
        $breadcrumbs->addCrumb('Accueil', '/');
        $breadcrumbs->addCrumb('Livres', '/livres');
        //echo $breadcrumbs->render();
        ?>
        
        <!-- <div class="container">
            <ol class="breadcrumb">
              <li><a href="#">Un </a></li>
              <li><a href="#">fil</a></li>
              <li class="active">d'ariane</li>
            </ol>
        </div> -->
        
        <span id="content">
            @yield('content')
        </span>
        
        @if(!isset($_COOKIE['alert_cookies']))
            <div id="alert_cookies" class="alert alert-warning alert-dismissible fade in" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p>En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies afin d'améliorer son fonctionnement. Pour en savoir plus et paramétrer les cookies, cliquez ici.</p>
            </div>
        @endif
        <hr>
        <footer class="footer">
			<div class="container text-center">
				<span class="text-muted">
                        <a href="{{ route('home')}}#contact_us">Nous contacter</a>
                        <a href="/"><img class="logo" src="/images/logo.png" alt="logo"></a>
                        <a href="#">Copyright</a>
                </span>
			</div>
		</footer>
       
        <!-- MODAL CONNEXION -->
        @include('templates.modalLogin')
    
        <!-- MODAL INSCRIPTION -->
        @include('templates.modalRegister')

        <!-- MODAL PROPOSITION OEUVRE -->
        @include('templates.modalSubmitElement')


        <!-- JAVASCRIPT -->
        {!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
        {!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
        {!! HTML::script('js/jquery-ui.min.js') !!}
        {!! HTML::script('js/jquery.countdown.min.js') !!}
        {!! HTML::script('DataTables/datatables.min.js') !!}
        {!! HTML::script('bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
        <!-- {!! HTML::script('bootstrap-select/dist/js/bootstrap-select.mins.js') !!} -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        {!! HTML::script('js/autocomplete.js') !!}
        {!! HTML::script('js/template.js') !!}
        
        @yield('js')
        
        <script>
            $(document).ready(function(){
                /* Liste des catégories */
                $.ajax({
                    url: $('ul#listCategory').data('route'),
                    type: 'GET'
                })
                .done(function (data) {
                    var listCategory = JSON.parse(data);

                    var html = "";
                    $.each(listCategory, function(key, value){
                        html+='<li><a href="{{ route('list_category') }}/'+value.id+'">'+value.name+'</a></li>';
                    });

                    $('ul#listCategory').prepend(html);
                })                      
                .fail(function (data) {
                    console.log(data);
                });

                /* Filtre des élèments */
                $('#searchElement button').click(function(event){
                    event.preventDefault();

                    var url = $(this).data('route');
                    var redirect = $(this).data('redirect');

                    $('#grid').html("");

                    //Récupération des infos recherchées
                    var searchInfos = {};
                    var div = $("#searchElement");
                    div.find('input, select').each(function(){
                        var name = $(this).attr('name');
                        var value = $(this).val();
                
                        if(value!="" && value!=undefined)
                            searchInfos[name]=value;
                    });

                    //console.log(searchInfos);

                    //Selection des élèments concordants
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: searchInfos,
                        async: false
                    })
                    .done(function (data) {
                        //console.log(data);
                        var grid = JSON.parse(data);
                        var html="";
                        $.each(grid, function(key, value){
                            html+="<div class='col-xs-6 col-md-3'>";
                                html+='<a  class="thumbnail"';
                                    html+= ' data-id="'+value.id+'"' ;
                                    html+= ' data-picture="'+value.picture+'"'; 
                                    html+= ' data-name="'+value.name+'"';
                                    html+= ' data-subName="'+value.subName+'"' ;
                                    html+= ' data-description="'+value.description+'"';

                                    if(value.id_parent != undefined)
                                        html+= ' data-id_element ="'+value.id_parent+'"';
                                    else if(value.id_category != undefined)
                                        html+= ' data-id_element="'+value.id_category+'"';
                                    
                                    if(value.name_category != undefined)
                                        html+= ' data-name_category="'+value.name_category+'"';

                                    if(value.date != undefined)
                                        html+= ' data-date="'+strtotime(value.date)+'"';
                                    
                                    if(value.location != undefined)
                                        html+= ' data-location="'+value.location+'"';

                                    if(redirect != undefined)
                                        html+= ' href="'+redirect+'/'+value.id+'"';
                                    else
                                        html+= ' href="#" data-toggle="modal" data-target="#openModal"';

                                html+=">";
                                    html+='<figure';
                                        if(value.picture) 
                                            html+=' style="background-image: url('+value.picture+')">';
                                        else
                                            html+=">";
                                        html+='<figcaption>';
                                            html+='<p class="name">'+value.name+'</p>';
                                            html+='<p class="subName">'+value.subName+'</p>';
                                        html+='</figcaption>';
                                    html+='</figure>';
                                html+='</a>';
                            html+='</div>';

                            $('#grid').html(html);
                        });
                    })
                    .fail(function (data) {
                        console.log(data);
                    });


                    //Mise à jour de la pagination et de l'affichage
                    var html="";
                    <?php 
                        if(isset($nbElements)):
                    ?>
                        for(var i=0;i<parseInt($(grid).find('div').length)/<?php echo $nbElements; ?>;i++){
                            if(i==0)
                                html += "<li class='active'>";
                            else
                                html += "<li>";
                            html += "<a>"+(i+1)+"</a></li>";
                        }
                    <?php endif; ?>
                    $('ul.pagination').html(html);
                    return false;
                });

                //Enregistrement des infos dans une variable pour manipulation DOM par la suite
                var mosaique = [];
                $("#grid div").each(function(){
                    mosaique.push($(this).find('a').data('id'));
                });

                <?php if(isset($nbElements)): ?>
                    //Pagination
                    $('ul.pagination').on("click","li",function(e){
                        e.preventDefault();
                        
                        var currentActive = parseInt($('ul.pagination li.active a').html());
                        var new_page = parseInt($(this).find('a').html());
                        $('ul.pagination li').removeClass('active');
                        $(this).addClass("active");
                        
                        var start_display = (new_page-1)*<?php echo $nbElements; ?>;
                        var i=0;
                        console.log(start_display);
                        $.each(mosaique, function(key, value){
                            var element = $("#grid div").find("[data-id='"+value+"']");
                            $(element).parent().toggle(i>=start_display && i<start_display+<?php echo $nbElements; ?>);
                            i++;
                        });
                        return false;
                    });
                <?php endif; ?>
            });   
        </script>
    </body>
</html>
