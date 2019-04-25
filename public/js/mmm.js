var ll = [];
var i = 0;
var dt;
let msg = "",leads="",senderName = "", senderEmail = "", subject = "";
let link = "",SMTPServer="",SMTPPort = "", SMTPUser = "", SMTPAuth = "", SMTPEnc = "", SMTPPass = "";

(function($) {
  "use strict"; // Start of use strict
    hideErrorMessages();
         
  	$("#form-submit").click(function(e){
		hideErrorMessages();
		console.log("form submit");
		$('#mailer-results').html("");
		e.preventDefault();
	    senderName = $('#senderName').val(), senderEmail = $('#senderEmail').val(), subject = $('#subject').val(), link = $('#link').val();
	    SMTPServer = $('#SMTPServer').val(), SMTPUser = $('#SMTPUser').val(), SMTPPass = $('#SMTPPass').val(), SMTPAuth = $('#SMTPAuth').val(), SMTPEnc = $('#SMTPEnc').val(), SMTPPort = $('#SMTPPort').val();
		msg = $('#message').val(), leads = $('#leads').val();
		console.log(msg);
		
		
		if(senderName == "" || senderEmail == "" || subject == "" || SMTPServer == "" || SMTPPort == "" || SMTPUser == "" || SMTPPass == "" || msg == "" || leads == ""){
			if(senderName == "")  $("#error-sender-name").fadeIn();
			if(senderEmail == "")  $("#error-sender-email").fadeIn();
			if(subject == "")  $("#error-subject").fadeIn();
			if(SMTPServer == "")  $("#error-smtp-server").fadeIn();
			if(SMTPPort == "")  $("#error-smtp-port").fadeIn();
			if(SMTPUser == "")  $("#error-smtp-username").fadeIn();
			if(SMTPPass == "")  $("#error-smtp-password").fadeIn();
			if(msg == "")  $("#error-messages").fadeIn();
			if(leads == "")  $("#error-leads").fadeIn();
		}
		
		else{
			ll = leads.split("\n");
		   bomb();
		}
		
	});   	
	
	
})(jQuery); // End of use strict

function bomb(){
	var url = $('#uu').val();
	var em = ll[i];
	dt = {'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth,'sec':SMTPEnc};
	
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
		   $('#mailer-results').append("<br><p class='text-danger'>An error occured sending to " + dt.em + "</p>");
	   }
	   else if(ret['status'] == "ok"){
			 $('#mailer-results').append("<br><p class='text-success'>Email sent to " + dt.em + "</p>");    
	   }
	   
	   setTimeout(function(){
		   console.log("data sent: " + dt);
		   ++i; 
		   if(i < ll.length) bomb();
		   },5000);
     }
   });
}

function hideErrorMessages(){
	     $("#error-sender-name").hide();
         $("#error-sender-email").hide();
         $("#error-subject").hide();
         $("#error-smtp-server").hide();
         $("#error-smtp-port").hide();
         $("#error-smtp-username").hide();
         $("#error-smtp-password").hide();
         $("#error-messages").hide();
         $("#error-leads").hide();
}