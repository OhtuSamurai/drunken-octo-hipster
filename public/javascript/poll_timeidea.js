function countsum(){ //laskee summatietoihin vihreät ja keltaiset
	$(".timeidea").each(function(){ //looppaa kaikki rivit ja laskee jokaisen summat
		best = $(this).find(".parhaiten").length;
		isokay = $(this).find(".sopii").length;
		no = $(this).find(".eisovi").length;
		$(this).find(".howmany>.best").text(best + " /");  //asetetaan parhaiden summa oikeaan paikkaan showiin
		$(this).find(".howmany>.isokay").text(isokay + " /");
		$(this).find(".howmany>.no").text(no);
	});
	
}

$(document).ready(function(){
	countsum();
	document.getElementById("pollform").reset();
	
	$(".timeidea>.options").click(function(){ //muuttaa laatikoiden värejä klikkailujen mukaan
		
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
	    countsum();
	});
	
	$("#pollform").submit( function() {
    	$(this).find("select[data-clicked|='false']").remove();
	});

	timeideas = $(".timeidea>th");
	timeideas.click(function(){  //hoitaa valittavan timeidean klikkailun
		id = $(this).data('id');
		description = $(this).data('description');
		$(".valittuaika").val(description);
	    timeideas.removeClass("active");		
    	$(this).addClass("active");
	});
	
	$(".users").click(function(){  //hoitaa valittavien käyttäjien klikkailun	
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
	
	$(".allred").click(function(){  //muutetaan tietyn sarakkeen kaikki boxit punaiseksi
		redbuttonuserid = $(this).data("userid");
		selectedcolumn = $(".timeidea>.options[data-userid|='"+redbuttonuserid+"']");
		selectedcolumn.removeClass(); //removes all classes
		selectedcolumn.find(".selectedvalue").attr('data-clicked', 'true');
		selectedcolumn.find(".selectedvalue").val('eisovi');
		selectedcolumn.addClass("eisovi");
	});
	
});

