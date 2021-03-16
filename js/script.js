$(function(){
	$('[data-toggle="tooltip"]').tooltip({
		'html' : true
	});	
	$('.supp').submit(function(){
		if (confirm("Etes vous sûr de votre choix?")) {
		}
		else {
			return false;
		}
        
	});
});