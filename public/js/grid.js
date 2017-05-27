$(document).ready(function(){

	//Enregistrement des infos dans une variable pour manipulation DOM par la suite
	var mosaique = [];
	$("#grid div").each(function(){
		mosaique.push($(this).find('a').data('id'));
	});


	//Tri des élèments
	$('#searchElement button').click(function(event){
		event.preventDefault();

		$('#grid div').each(function(){
			$(this).hide();
		});

		//Récupération des infos recherchées
		var searchInfos = {};
		var div = $("#searchElement");
		div.find('input, select').each(function(){
			var name = $(this).attr('name');
			var value = $(this).val();
	
			if(value!="" && value!=undefined)
				searchInfos[name]=value;
		});

		//Selection des élèments concordants
		$.each(mosaique, function(key, value){
			var element = $("#grid div").find("[data-id='"+value+"']");
			var show = true;
			
			$.each(searchInfos, function(key, value){
				if($(element).data(key) != value)
					show=false;
			});

			if(show)
				$(element).parent().show();
		});
		return false;
	});

	//Tri chronologique
    /*$("select[name='order']").change(function(){
        var order = parseInt($(this).val());
        var list = $('#grid');

        list.find('div').sort(function(a,b){
            return (order==0) ? ($(a).find('a').attr('data-date') - $(b).find('a').attr('data-date')) : ($(b).find('a').attr('data-date') - $(a).find('a').attr('data-date'));
        }).appendTo(list);

        console.log(list);
    });*/
});