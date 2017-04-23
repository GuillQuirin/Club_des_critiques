<div class='row'>
    @foreach ($array as $value)
    <div class='col-xs-6 col-md-3'>
        @if(isset($array->redirect))
            <a  href="{{ route($array->redirect,[ 'id' => $value->id ]) }}" class="thumbnail">
        @else
            <a  href="#" 
                class="thumbnail"
                data-picture="{{$value->picture}}" 
                data-first_text="{{$value->first_name}}" 
                data-second_text="{{$value->last_name}}" 
                data-description="{{$value->description}}" 
                data-toggle="modal" 
                data-target="#openModal">
        @endif
            <figure style="background-image: url({{$value->picture}})">
                <figcaption>
                	<p class="title">{{$value->first_name}}</p>
                    <p class="author">{{$value->last_name}}</p>
                </figcaption>
            </figure>
        </a>
    </div>
    @endforeach
</div>

<!-- MODAL -->
<div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="openModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if(isset($popUp))
                @include($popUp)
            @endif
        </div>
    </div>
</div>