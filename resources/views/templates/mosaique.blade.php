<!--Mosaique-->
<div class='row' id="grid">
    @foreach ($grid as $key => $value)
        <div class='col-xs-6 col-md-3'>    
            <a  class="thumbnail"
                data-id="{{$value->id}}" 
                data-picture="{{$value->picture}}" 
                data-name="{{$value->name}}" 
                data-subName="{{$value->subName}}" 
                data-description="{{$value->description}}"         

                @if(isset($value->id_parent))
                    data-id_element = "{{$value->id_parent}}"
                @elseif(isset($value->id_category))
                    data-id_element = "{{$value->id_category}}"
                @endif
                
                @if(isset($value->name_category))
                    data-name_category = "{{$value->name_category}}"
                @endif

                @if(isset($value->date))
                    data-date="{{strtotime($value->date)}}"
                @endif
                
                @if(isset($value->location))
                    data-location="{{$value->location}}"
                @endif
    
                @if(isset($value->link))
                    data-link="{{$value->link}}"
                @endif

                @if(isset($value->mark))
                    data-mark="{{$value->mark}}"
                @endif

                @if(isset($redirection))
                    href="{{ route($redirection,[ 'id' => $value->id ]) }}"
                @else
                    data-toggle="modal" 
                    data-target="#openModal"
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


<!--Pagination-->
<div class="row text-center">
    <ul class="pagination">
    <?php 
        /*
            Pour modifier le nombre d'élements affichés au load de la page 
                changer template.css : #grid div:nth-of-type(n+9)
        */
        for($i=0;$i<count($grid)/$nbElements;$i++){
            echo ($i==0) ? "<li class='active'>" : "<li>";
            echo "<a>".($i+1)."</a></li>";
        }
    ?>
    </ul>
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