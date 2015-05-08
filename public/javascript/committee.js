$(document).ready(function(){
	$(".nimike").click(function(){
		if($(this).val()=='Muu, mikä:'){
			if ($(".anyrole").hasClass("hidden")){
				$(".anyrole").removeClass("hidden");
			}
		}
		else{
			if (!$(".anyrole").hasClass("hidden")){
				$(".anyrole").addClass("hidden");
			}		
		}
		$(".anyrole").val($(this).val());	
	});
	
});
