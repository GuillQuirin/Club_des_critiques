<div class='row'>
    @foreach ($xx as $user)
    <div class='col-xs-6 col-md-3'>
        <a href="{{ route('show_user',[ 'id' => 1 ]) }}" class='thumbnail'>
            <figure>
                <img src='/images/oeuvre.jpg' alt=''>
                <figcaption>
                	<p class='title'>Utilisateur</p>
                    <p class='author'>Auteur</p>
                </figcaption>
            </figure>
        </a>
    </div>
    @endforeach
</div>