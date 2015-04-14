function is_user_active(userid){
	selecteduser = $(".users[data-id|='"+userid+"']");
	return selecteduser.hasClass("active");
}

//countsum() tarvitsee vähän refaktorointia, palaan tähänkin

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
		currentuser = $(".kirjautunutuser").data('userid');
		thisrow = $(this).data('userid');
		islurker = ($(this).find(".selectedvalue").data('lurker'));
		if(currentuser === thisrow && islurker == false){
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
	    		selected.val('entieda');
	    		$(this).removeClass("eisovi");
	    		$(this).addClass("entieda");
	    	}
	    	else if(selected.val()=='entieda'){
	    		selected.val('parhaiten');
	    		$(this).removeClass("entieda");
	    		$(this).addClass("parhaiten");
	    	}
	    	else if(selected.val()=='eivastattu'){
	    		selected.val('parhaiten');
	    		$(this).removeClass("eivastattu");
	    		$(this).addClass("parhaiten");
	    	} 	
	    	countsum();
	    }
	});
	
	$(".timeidea>.lurkeroptions").click(function(){ //muuttaa lurkereiden laatikoiden värejä klikkailujen mukaan
			if(!$(".kirjautunutuser").data('userid')){
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
	    			selected.val('entieda');
	    			$(this).removeClass("eisovi");
	    			$(this).addClass("entieda");
	    		}
	    		else if(selected.val()=='entieda'){
	    			selected.val('parhaiten');
	    			$(this).removeClass("entieda");
	    			$(this).addClass("parhaiten");
	    		}
	    		else if(selected.val()=='eivastattu'){
	    			selected.val('parhaiten');
	    			$(this).removeClass("eivastattu");
	    			$(this).addClass("parhaiten");
	    		} 	
	    		countsum();
	    	}
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
	
	
	//huom huom palaan tänne, tämä rikki (oli jo aiemmin koska lurkereilla ja usereilla voi olla sama data-id mutta korjaan kyllä!
	
	/*$(".allred").click(function(){  //muutetaan tietyn sarakkeen kaikki boxit punaiseksi
		currentuser = $(".kirjautunutuser").data('userid');
		thisuser = $(this).data('userid');
		selectedcolumn = $(".timeidea>.options[data-userid|='"+thisuser+"']");
		islurker = selectedcolumn.find(".selectedvalue").data('lurker');
		//if(islurker == false){ //jos islurker == true tämän userid:n kohdalla, älä muuta semmoista jossa islurker false öm
		if(currentuser === thisuser){
		//redbuttonuserid = $(this).data("userid");
				//selectedcolumn = $(".timeidea>.options[data-userid|='"+thisrow+"']");			
			selectedcolumn.removeClass(); //removes all classes
			selectedcolumn.find(".selectedvalue").attr('data-clicked', 'true'); //nyt näitäkin on "klikattu"
			selectedcolumn.find(".selectedvalue").val('eisovi');
			selectedcolumn.addClass("eisovi");
			countsum();
		}
		alert(selectedcolumn);	
		alert(islurker);
		
		if(!$(".kirjautunutuser").data('userid')){
				selectedcolumn.removeClass(); //removes all classes
				selectedcolumn.find(".selectedvalue").attr('data-clicked', 'true'); //nyt näitäkin on "klikattu"
				selectedcolumn.find(".selectedvalue").val('eisovi');
				selectedcolumn.addClass("eisovi");
				countsum();
		}
	});*/
	$(".allredlurker").click(function(){
		if($(".kirjautunutuser").data('userid')){
			return;
		}
		thisuser = $(this).data('userid');
		selectedcolumn = $(".timeidea>.lurkeroptions[data-userid|='"+thisuser+"']");
		selectedcolumn.addClass("eisovi");
		if(selectedcolumn.find(".selectedvalue").data("lurker") == true){
			selectedcolumn.removeClass(); //removes all classes
			selectedcolumn.find(".selectedvalue").attr('data-clicked', 'true'); //nyt näitäkin on "klikattu"
			selectedcolumn.find(".selectedvalue").val('eisovi');
			selectedcolumn.addClass("eisovi");
			countsum();
		}
	});

	
	$(".allusersactive").click(function(){ //valitaan kaikki käyttäjät tai poistetaan kaikki valinnat
		var someistriggered = false;
		$(".users").each(function(){
			if($(this).hasClass("active")){ //jokin yksittäinen tai useampi käyttäjä on valittu
				someistriggered = true;
				$(".users").each(function(){
					$(this).removeClass("active"); //nollataan kaikki aluksi, jotta kaikki valinnat vaihtuvat samaksi
				});
			}			
		});
		
		$(".users").each(function(){
			id = $(this).data('id');
			usercheckbox = $("[value='" + id + "']");
			usercheckbox.prop("checked", !usercheckbox.prop("checked"));		
	    	if(someistriggered === false){	    
      			$(this).addClass("active"); //kaikki valituksi
      		}
      		else{
      			$(this).removeClass("active"); //joku tai kaikki oli valittu->poistetaan kaikki valinnat
      		}
		});      	
		countsum();
	});
	
});

