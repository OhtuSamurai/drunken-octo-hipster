$(document).ready(function(){	
	$(".users").click(function(){
	
		id = $(this).data('id');		
		usercheckbox = $("[value='" + id + "']");
		usercheckbox.prop("checked", !usercheckbox.prop("checked"));
	    if($(this).hasClass("active")){
      		$(this).removeClass("active");
      	}
      	else{
      		$(this).addClass("active");
      	}      	
	});
});
