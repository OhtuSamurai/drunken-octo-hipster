function is_user_active(userid){
	selecteduser = $(".users[data-id|='"+userid+"']");
	return selecteduser.hasClass("active");
}

function countsum(){ //laskee summatietoihin Paras/Sopii/Eisovi
	$(".timeidea").each(function(){ //looppaa kaikki rivit ja laskee jokaisen summat
		best = $(this).find(".parhaiten").filter(function(){
			return is_user_active($(this).data("userid")); //ottaa huomioon vain ne sarakkeet, joiden userid on valittu
		}).length;
		is_okay = $(this).find(".sopii").filter(function(){
			return is_user_active($(this).data("userid"));
		}).length;
		no = $(this).find(".eisovi").filter(function(){
			return is_user_active($(this).data("userid"));
		}).length;
		$(this).find(".howmany>.best").text(best + " /");  //asetetaan summa oikeaan paikkaan showiin
		$(this).find(".howmany>.isokay").text(is_okay + " /");
		$(this).find(".howmany>.no").text(no);
	});		
}

$(document).ready(function(){
	countsum();
	document.getElementById("pollform").reset();
	
	$(".timeidea>.options").click(function(){ //muuttaa laatikoiden värejä klikkailujen mukaan		
	    selected = $(this).find(".selectedvalue");
	    selected.attr('data-clicked', 'true'); //tieto siitä, että tätä elementtiä on klikattu
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
    	$(this).find("select[data-clicked|='false']").remove(); //formiin submitataan vain klikatut answerit
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
      	countsum();      	
	}); 
	
	$(".allred").click(function(){  //muutetaan tietyn sarakkeen kaikki boxit punaiseksi
		redbuttonuserid = $(this).data("userid");
		selectedcolumn = $(".timeidea>.options[data-userid|='"+redbuttonuserid+"']");
		selectedcolumn.removeClass(); //removes all classes
		selectedcolumn.find(".selectedvalue").attr('data-clicked', 'true'); //nyt näitäkin on "klikattu"
		selectedcolumn.find(".selectedvalue").val('eisovi');
		selectedcolumn.addClass("eisovi");
		countsum();
	});
	
	
});

