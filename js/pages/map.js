$( function(jQuery) {
    jQuery( ".draggable" ).draggable({
      start: function() {
       
      },
      drag: function() {
        
      },
      stop: function() {
        posx = parseFloat(jQuery(this).css('left'));
        posy = parseFloat(jQuery(this).css('top'));
		id = jQuery(this).attr('id');
		url = '?action=services';
		jQuery.post('?action=services',{ actionInterne : 'modifmap',id: id, posx: posx,	posy:posy});
      }
    });
	jQuery( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 300
      },
      hide: {
        effect: "blind",
        duration: 300
      }
    });
	jQuery( "#opener" ).click(function() {
      jQuery("#dialog" ).dialog( "open" );
    });
	jQuery( "#dialog" ).dialog( "option", "width", 600 );
	jQuery("#myForm").submit(function(e){
		e.preventDefault(); //empêcher une action par défaut
		var form_url = jQuery(this).attr("action"); //récupérer l'URL du formulaire
		var form_method = jQuery(this).attr("method"); //récupérer la méthode GET/POST du formulaire
		var form_data = jQuery(this).serialize(); //Encoder les éléments du formulaire pour la soumission
		jQuery.ajax({
			url : form_url,
			type: form_method,
			data : form_data
		}).done(function(response){ 
			document.location.reload(true);
		});
	});
});