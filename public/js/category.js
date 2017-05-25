$(document).ready(function(){

	//Selection d'une sous-catégorie
	$("select[name='category']").change(function(){
		var id = $(this).val();

		$("#grid div").each(function(){
			if($(this).find('a').data('id_category') == id || id == 0)
				$(this).show();
			else
				$(this).hide();
		});
	});

	//Tri chronologique
	$("select[name='order']").change(function(){
		var order = parseInt($(this).val());
		var list = $('#grid');

		list.find('div').sort(function(a,b){
			return (order==0) ? ($(a).find('a').attr('data-date') - $(b).find('a').attr('data-date')) : ($(b).find('a').attr('data-date') - $(a).find('a').attr('data-date'));
		}).appendTo(list);

		console.log(list);
	});
});