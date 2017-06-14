$(document).ready(function(){
    //Autocompletion des utilisateurs
    $('#autocomplete_user').autocomplete({
        minLength: 2,
        source: function (req, add) {
            $.ajax({
                url: 'autocompleteUser',
                dataType: 'json',
                type: 'POST',
                data: req
            })
                .done(function (data) {
                    if (data.response === 'true') {
                        console.log(data)
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

    /*MAJ de la chatbox*/
    updateChatbox();

    function updateChatbox(){
        var id_room = $('#room').val();
        $.ajax({
            url : "getMessage",
            type : "POST",
            data : "id_room=" + id_room
        })
        .done(function(data){
            //console.log(data);
            var data = JSON.parse(data);
            var html="";
            //console.log(data);
            $.each(data, function(key, value){
                html+='<li class="left clearfix">';
                    html+='<span class="chat-img pull-left">';
                        if(value.picture)
                            html+='<img src="'+value.picture+'" alt="User Avatar" class="img-circle favicon_user"/>';
                        else
                            html+='<img src="/images/user.png" alt="User Avatar" class="img-circle favicon_user"/>';
                    html+='</span>';
                    html+='<div class="chat-body clearfix">';
                        html+='<div class="header">';
                            html+='<strong class="primary-font">'+value.first_name+' '+value.last_name+'</strong>';
                            html+='<small class="pull-right text-muted">';
                                html+='<span class="glyphicon glyphicon-time"></span>';
                                html+=value.date;
                            html+='</small>';
                        html+='</div>';
                        html+='<p>'+value.message+'</p>';
                    html+='</div>';
                html+='</li>';
                $('ul#chatbox').html(html);
            });
            $("#messages").scrollTop($("#messages").prop('scrollHeight'));
        })
        .fail(function(data){
            console.log(data);
        })
        .always(function() {           // on completion, restart
           setTimeout(updateChatbox, 2000);  // function refers to itself
        });
    }

    /*Envoi d'un message en chatbox*/
    $('#send').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

        var message = $('#message').val();

        var today = new Date();
        var dd = today.getDate() < 10 ? '0' + today.getDate() : today.getDate();
        var mm = today.getMonth()+1 < 10 ? '0' + (today.getMonth()+1) : today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes()< 10 ? '0' + today.getMinutes() : today.getMinutes();
        var s = today.getSeconds() < 10 ? '0' + today.getSeconds() : today.getSeconds();
        var id_room = $('#room').val();

        today = dd+'/'+mm+'/'+yyyy+' '+h+':'+m+':'+s;

        if(message != ""){
            $.ajax({
                url : "addMessage",
                type : "POST",
                data : "id_room=" + id_room + "&message=" + message,
            })
            .done(function(data){
                updateChatbox();
                $('#message').val('');
            });
        }
    });
});