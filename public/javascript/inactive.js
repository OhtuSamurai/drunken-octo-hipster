$(document).ready(function(){
  $(".userselector").prop("checked", false);
	
  $(".pooltable>tbody>tr").click(function(){
    checkbox = $(this).find(".userselector")
     
    if(!checkbox.prop("checked")){
      $(this).addClass("active");
    }else{
      $(this).removeClass("active");
    }
    checkbox.prop("checked", !checkbox.prop("checked"));	
  });
  
  
  $("#deleteuser").click(function(){
  	$('#MoveorRemove').attr('action', "/delete");
    $('#MoveorRemove').submit();
  });
  
});

