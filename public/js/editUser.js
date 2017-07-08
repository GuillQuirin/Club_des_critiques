$(document).ready(function(){
	//Bouton de modification du compte
	$('#popUpEdit a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});

	//Autocompletion des oeuvres
    $('#autocomplete_element').autocomplete({
        minLength: 2,
        source: function (req, add) {
            $.ajax({
                url: 'autocompleteExchange',
                dataType: 'json',
                type: 'POST',
                data: req
            })
            .done(function (data) {
                if (data.response === 'true') {
                    //console.log(data)
                    add(data.message);
                }
            });
        }
    });

    $.ui.autocomplete.prototype._renderItem = function (ul, item) {
        item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
        return $("<li class='form-control'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };

    //Gestion des oeuvres déjà échangeables
    loadExchanged();

    $('#addExchange').submit(function(event){
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize()
        })
        .done(function(data) {
            console.log(data)
            loadExchanged();
        });
        return false;
    });

    function loadExchanged(){
        //Affichage des oeuvres echangée
        $.ajax({
            url: 'loadExchange',
            type: 'POST'
        })
        .done(function(data) {
            console.log(data)
            data = JSON.parse(data);
            if(data){
                var html="";
                $.each(data, function(key, value){        
                    html+="<li data-id_element="+value.idElement+">";
                        html+="["+value.categoryPName+"] ";
                        html+="<strong>"+value.elementName+"</strong>";
                        html+=" ( "+value.categoryName+" ) ";
                        html+="<button class='btn btn-danger deleteExchange'>Ne plus échanger</button>";
                    html+="</li>";
                });
                $('#listExchanged').html(html);
                deleteExchange();
            }
        });
    }

    //Retrait d'une oeuvre de la liste échangeable
    function deleteExchange(){
        $('ul#listExchanged button.deleteExchange').on('click',function(){
            var id = parseInt($(this).parent().data('id_element'));
            if(id){
                $.ajax({
                    url: 'deleteExchange',
                    type: 'POST',
                    data: {idElement: id}
                })
                .done(function(data) {
                    loadExchanged();
                });
            }
        });
    }
});	