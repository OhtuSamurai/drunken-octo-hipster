$(document).ready(function(){
  $(".userselector").prop("checked", false);

	sortlist($(".department"));	//oletusjärkkä laitoksen mukaan

	function sortlist(bythis){
    	var table = bythis.parents('table').eq(0)
    	var rows = table.find('tr:gt(0)').toArray().sort(comparer(bythis.index()))
    	this.asc = !this.asc
    	if (!this.asc){rows = rows.reverse()}
    	for (var i = 0; i < rows.length; i++){table.append(rows[i])}
	}

	function comparer(index) {
	    return function(a, b) {
	    	var valA = getCellValue(a, index), valB = getCellValue(b, index)
	  	    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
	    	}
	}
	function getCellValue(row, index){ return $(row).children('td').eq(index).html() }

	$('th').click(function(){  //järjestetään klikatun th:n perusteella
		if($(this).is(".firstname")){ //ekan nimen perusteella ei jostain syystä toimi, varmaan kun se on semmoinen linkki? eli pitäisi jotenkin ottaa niistä .text() tjsp
			return;
		}
		else{
	    	var table = $(this).parents('table').eq(0)
	    	var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
	    	this.asc = !this.asc
	    	if (!this.asc){rows = rows.reverse()}
	    	for (var i = 0; i < rows.length; i++){table.append(rows[i])}
	    }
	})
	
  $(".pooltable>tbody>tr").click(function(){
    checkbox = $(this).find(".userselector")
     
    if(!checkbox.prop("checked")){
      $(this).addClass("active");
    }else{
      $(this).removeClass("active");
    }
    checkbox.prop("checked", !checkbox.prop("checked"));	
  });
});

