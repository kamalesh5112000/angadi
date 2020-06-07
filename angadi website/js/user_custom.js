jQuery(document).ready(function($) {
	$('#search').focus(
    function(){
        $(this).val('');
    });
	
	$('#wcfmmp_store_zip').focus(
    function(){
        $(this).val('');
    });
	

	$('#wcfmmp_store_country option[value!="IN"]').remove();
	
	/*if ($("#select2-wcfmmp_store_country-results").length) {
  alert("idDiv exists!!");
}else{
  alert("Does not exists!!");
}*/
	
	
});

