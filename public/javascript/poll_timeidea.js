$(document).ready(function(){
	document.getElementById("pollform").reset();
	$(".timeidea>.options").click(function(){
		$(this).removeClass("eivastattu");		
	    selected = $(this).find(".selectedvalue");
	    selected.attr('data-clicked', 'true'); 
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
	    else if(selected.val()=='eivastattu'){
	    	selected.val('parhaiten');
	    	$(this).removeClass("eivastattu");
	    	$(this).addClass("parhaiten");
	    } 	
	});
	$("#pollform").submit( function() {
    	$(this).find("select[data-clicked|='false']").remove();
	});
});

