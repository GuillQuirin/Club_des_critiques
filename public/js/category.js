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

});