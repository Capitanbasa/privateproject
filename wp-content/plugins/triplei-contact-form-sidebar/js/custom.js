//Make contact button scroll
$(document).ready(function () {  
	if(!isArchiveOrSingle){
		if($('#contactUsButton').length > 0){
		   //need to recalculate top in case window width has changed
		   var top = $('#contactUsButton').offset().top - parseFloat($('#contactUsButton').css('marginTop').replace(/auto/, 0)) -($(window).height()/2)+110;
		   $(window).resize(function(){
		   		//top = $('#contactUsButton').offset().top - parseFloat($('#contactUsButton').css('marginTop').replace(/auto/, 0)) -100;
		   });
		}
	  $(window).scroll(function (event) {
	  	// to get the height of sideAddress container and side blog preview
	  	var sideAddress = $('#contactUsButton').parent().parent().parent().parent().height(); 
	  	// to get the remaining height from the top of the screen to the of side adress and blogpreview
	  	var offsetTopSideAddress = $('#contactUsButton').parent().parent().parent().parent().offset().top;

	  	if($('#contactUsButton').length > 0){
		    // what the y position of the scroll is
		    var y = $(this).scrollTop();
		    // whether that's below the form
		    // console.log("this is y :"+y);
		    // console.log("this is sideaddress :"+((sideAddress-($(window).height()/4))));
		    if (y >= sideAddress+offsetTopSideAddress-45) {
		      // if so, add the fixed class
		    	$('#contactUsButton').addClass('fixed');
		   		if((y) <= ($('footer').offset().top-$('footer').height())){
		  			$('#contactUsButton').css('top', (854/2)-380);
		  			$('#contactUsButton').css('position', 'fixed');
		  		}else{
		  			$('#contactUsButton').css('top', $('footer').offset().top - $('footer').height() -700);
		  			$('#contactUsButton').css('position', 'absolute');

		  		}
		    } else {
		      // otherwise remove it
		      $('#contactUsButton').removeClass('fixed');
		      $('#contactUsButton').css('top', '0px');
		      $('#contactUsButton').css('position', 'absolute');
		    }
		}   
	  });
	}

  $('#datetimepickerMeeting').datetimepicker({
    format: 'dd/MM/yyyy hh:mm:ss',
    language: 'en-US',
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: 500,
                left: 200
            });
        }, 0);
     }   
  });

  //dynamically add meeting time field + set label + make required
  $('#inputMeetingType').change(function(){
  		var selectedIndex = $(this).prop("selectedIndex");

  		if(selectedIndex == 1)
  			$('#lbl_inputMessage').text('Please enter your preferred call time');
  		else if(selectedIndex == 2)
  			$('#lbl_inputMessage').text('Please enter your preferred meeting time');

  		if(selectedIndex != 0){
  			$('#datetimepickerContainer').show();  			
  			$('#inputDatetime').rules('add', {
			    required: true			    
			});
  		}
  		else{  			
  			$('#datetimepickerContainer').hide();
  			$('#inputDatetime').rules('remove');
  		}

  });

  $.validator.addMethod("phone_number", function(value, element) {
	var re = /^[\d\s()+-]+$/;

    return this.optional(element) || value.match(re);
	}, "Please enter a valid number");

  $('#contact-form').validate({		
	  rules: {
	    inputName: {
	      minlength: 2,
	      required: true
	    },
	    inputPhone: {
	      phone_number: true,
	      minlength:5,
	    },
	    inputEmail: {
	      required: true,
	      email: true
	    },
	    inputSubject: {
	      minlength: 2,
	      required: true
	    },		    
	    inputMessage: {
	      minlength: 10,
	      required: true
	    },

	  },
	  messages:{
	  	inputMessage:{
	  		minlength: "Please enter a longer message"
	  	},
	  	inputSubject:{
	  		minlength: "Please enter a longer subject"
	  	},
	  	inputName:{
	  		minlength: "Please enter your full name"
	  	}

	  },
	  highlight: function(element) {
	    $(element).closest('.control-group').removeClass('success').addClass('error');
	  },
	  success: function(element) {
	    	element
	    		.addClass('valid')
	    		.closest('.control-group').removeClass('error').addClass('success');
	    }
	});
	// $('#contact-form').submit(function(){
	// 	return false;
	// });
	
	$('#modalContactForm').on('hidden', function () {
    	$("#contactUsButton .btn").blur();
	});	

});
