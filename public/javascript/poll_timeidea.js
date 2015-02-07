$(document).ready(function(){
	$(".timeidea>.options").click(function(){
		
	    selected = $(this).find(".selectedvalue");
	     
	    if(selected.val()=='P'){
	    	selected.val('S');
	    	$(this).removeClass("parhaiten");
	    	$(this).addClass("sopii");
	    }
	    else if(selected.val()=='S'){
	    	selected.val('E');
	    	$(this).removeClass("sopii");
	    	$(this).addClass("eisovi");
	    }
	    else if(selected.val()=='E'){
	    	selected.val('P');
	    	$(this).removeClass("eisovi");
	    	$(this).addClass("parhaiten");
	    } 	
  });
});
