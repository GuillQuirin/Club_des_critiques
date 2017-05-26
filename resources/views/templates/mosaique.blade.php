<div class='row' id="grid">
    @foreach ($grid as $key => $value)
        <div class='col-xs-6 col-md-3'>    
            <a  class="thumbnail"
        
                @if(isset($redirection))
                    href="{{ route($redirection,[ 'id' => $value->id ]) }}"
                @else
                    @if(isset($value->id_parent))
                        data-id_element = {{$value->id_parent}}
                    @elseif(isset($value->id_category))
                        data-id_element = {{$value->id_category}}
                    @endif

                    @if(isset($value->date))
                        data-date="{{strtotime($value->date)}}"
                    @endif
                    
                    @if(isset($value->location))
                        data-location="{{$value->location}}"
                    @endif
 
                    data-toggle="modal" 
                    data-target="#openModal"
                    data-picture="{{$value->picture}}" 
                    data-name="{{$value->name}}" 
                    data-subName="{{$value->subName}}" 
                    data-description="{{$value->description}}"             
                    data-name_category = {{$value->name_category}}
                    href="#" 
                @endif
            >
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