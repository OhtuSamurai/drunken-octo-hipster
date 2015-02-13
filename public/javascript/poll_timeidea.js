$(document).ready(function(){
	document.getElementById("pollform").reset();
	$(".timeidea>.options").click(function(){

	    selected = $(this).find(".selectedvalue");
	     
	    if(selected.val()=='parhaiten'){
	    	selected.val('sopii');
	    	$(this).removeClass("parhaiten");
	    	$(this).addClass("sopii");
	    }
	    else if(selected.val()=='sopii'){
	    	selected.val('eisovi');
	    	$(this).removeClass("sopii");
	    	$(this).addClass("eisovi");
	    }
	    else if(selected.val()=='eisovi'){
	    	selected.val('parhaiten');
	    	$(this).removeClass("eisovi");
	    	$(this).addClass("parhaiten");
	    } 	
  });
});

