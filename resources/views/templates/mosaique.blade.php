<div class='row' id="grid">
    @foreach ($grid as $key => $value)
        <div class='col-xs-6 col-md-3'>
    
            @if(isset($redirection))
                <a  href="{{ route($redirection,[ 'id' => $value->id ]) }}" class="thumbnail">
            @else
                <a  href="#" 
                    class="thumbnail"
                    data-picture="{{$value->picture}}" 
                    data-name="{{$value->name}}" 
                    data-subName="{{$value->subName}}" 
                    data-description="{{$value->description}}"
                    
                    @if(isset($value->id_category))
                        data-id_category = {{$value->id_category}}
                    @endif

                    @if(isset($value->date))
                        data-date="{{strtotime($value->date)}}"
                    @endif 
                    
                    data-toggle="modal" 
                    data-target="#openModal">
            @endif

                <figure style="background-image: url({{$value->picture}})">
                    <figcaption>
                        <p class="name">{{$value->name}}</p>
                        <p class="subName">{{$value->subName}}</p>
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