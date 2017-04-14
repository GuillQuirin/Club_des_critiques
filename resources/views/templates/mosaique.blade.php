<div class='row'>
    @foreach ($array['items'] as $key => $value)
    <div class='col-xs-6 col-md-3'>
        @if(isset($array['redirect']))
            <a  href="{{ route($array['redirect'],[ 'id' => $value['id'] ]) }}" class="thumbnail">
        @else
            <a  href="#" 
                class="thumbnail"
                data-toggle="modal" 
                data-target="#openModal">
        @endif
            <figure>
                <img src="{{ $value['url_img'] }}" alt="">
                <figcaption>
                	<p class="title">{{ $value['name'] }}</p>
                    <p class="author">{{ $value['subname'] }}</p>
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