$(document).ready(function(){

	//Enregistrement des infos dans une variable pour manipulation DOM par la suite
	var mosaique = [];
	$("#grid div").each(function(){
		mosaique.push($(this).find('a').data('id'));
	});


	//Pagination
	$('ul.pagination li').click(function(e){
		e.preventDefault();
		
		var currentActive = parseInt($('ul.pagination li.active a').html());
		var new_page = parseInt($(this).find('a').html());
		$('ul.pagination li').removeClass('active');
		$(this).addClass("active");
		
		var start_display = (new_page-1)*12;
		var i=0;
		console.log(start_display);
		$.each(mosaique, function(key, value){
			var element = $("#grid div").find("[data-id='"+value+"']");
			$(element).parent().toggle(i>=start_display && i<start_display+12);
			i++;
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