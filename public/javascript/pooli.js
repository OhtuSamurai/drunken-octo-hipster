$(document).ready(function(){
	
  $(".pooltable>tbody>tr").click(function(){
    checkbox = $(this).find(".userselector")
     
    if(!checkbox.prop("checked")){
      $(this).addClass("active");
    }else{
      $(this).removeClass("active");
    }
    checkbox.prop("checked", !checkbox.prop("checked"));	
  });
  
  $(".selectall").click(function(){
     $(".pooltable>tbody>tr").each(function(){
     	checkbox = $(this).find(".userselector")
     	if(!checkbox.prop("checked")){
			$(this).addClass("active");
    	}else{
      		$(this).removeClass("active");
    	}
    	checkbox.prop("checked", !checkbox.prop("checked"));
  	});
  });
});

