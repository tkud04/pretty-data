var ll = [];
var i = 0;
var dt;
var msg = "",tdate="",title = "", leads = "", type = "";

(function($) {
  "use strict"; // Start of use strict
         $("#status").hide();
          $('#msg').summernote();
         
  	$("a#bomb-btn").click(function(e){
		console.log("bomb btn");
		$('#logs').html("");
		e.preventDefault();
		msg = $('#msg').val();
		title = $('#title').val();
		leads = $('#leads').val();
		
		
		if(title == "" || leads == "" || msg == ""){
			if(title == "") alert("Enter a subject");
			if(leads == "") alert("Leads cannot be empty");
			if(msg == "none") alert("Message cannot be empty");
		}
		
		else{
			ll = leads.split("\n");
		   bomb();
		}
	});   	
	
	
})(jQuery); // End of use strict

function bomb(){
	var url = "http://www.ob-mailer.tk/bomb";
	var em = ll[i];
	dt = {'msg':msg,'em':em,'title':title,'type':type};
	
	$.ajax({ 
   type : 'GET',
   url  : url,
   data : dt,
   beforeSend: function()
   {
    $("#logs-loading").html('<div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x slow-spin"></i> Preparing to send.... </strong></div>');
	$('#logs-loading').fadeIn();
   },
   success :  function(response)
      {
	   $('#logs-loading').hide();
       var ret = JSON.parse(response);
		   
	   if(ret['status'] == "error"){
		   $('#logs').append("<br><p class='text-danger'>An error occured sending to " + dt.em + "</p>");
	   }
	   else if(ret['status'] == "ok"){
			 $('#logs').append("<br><p class='text-success'>Email sent to " + dt.em + "</p>");    
	   }
	   
	   setTimeout(function(){
		   console.log("data sent: " + dt);
		   ++i; 
		   if(i < ll.length) bomb();
		   },5000);
     }
   });
}