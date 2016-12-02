//<!--
jQuery(document).ready(function() {
    
    $('#ver').click(function() {

      $.ajax({
	    type:  "POST",
		async:false,
	    url: "mensajes.php",	
        success:function( result ) {
       	 $("#mostrar").html(result); 
	    }});  
	
	});      
});
//-->