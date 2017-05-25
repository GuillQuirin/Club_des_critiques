$(document).ready(function(){
	//Recherche des utilisateurs en fonction du département
	$("select[name='location']").change(function(){
		var selectLoc = parseInt($(this).val());
		$("#grid div").each(function(){
			var div = $(this);

			if(selectLoc!=00){
				if(parseInt(div.find('a').data('location')) == selectLoc)
					div.show();
				else
					div.hide();
			}
			else
				div.show();
		});
	});
});