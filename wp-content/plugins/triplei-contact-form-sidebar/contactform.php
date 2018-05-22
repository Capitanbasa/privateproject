	<div id="modalContactForm" tabindex="-1" aria-hidden="true" class="modal hide fade" role="dialog">
		<script type="text/javascript"> var fpl_ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
		<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      		<button type="button" class="close close_link" data-dismiss="modal" aria-hidden="true">&times;</button>
					<form action="" method="POST" role="form" class="contactFormFields" id="contact-form">
					  <h2>We endeavor to reply to all inquiries within 24 business hours.</h2>
					  <h6>Please note that all fields are required.</h6>
					  <div class="form-group">
					    <select class="form-control" id="inputMeetingType" name="inputMeetingType">
					    	<option value="mtg_no">I don't want to schedule a meeting or call</option>
					    	<option value="mtg_call">I want to schedule a call</option>
					    	<option value="mtg_meeting">I want to schedule a meeting</option>
					    </select>
					  </div>
					  <div class="well" id="datetimepickerContainer">
					  	<label for="inputMessage" id="lbl_inputMessage">Enter your preferred meeting time</label>
						  <div id="datetimepickerMeeting" class="input-append">
						    <input data-format="yyyy-MM-dd" type="text" id="inputDatetime" name="inputDatetime"/>
						    <span class="add-on">
						      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
						      </i>
						    </span>
						  </div>
					   </div>
					  <div class="form-group">
					    <label for="inputName">Name</label>
					    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Enter your name">
				  	  </div>
						<div class="form-group">
					    <label for="inputPhone">Phone number</label>
					    <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Enter your phone number">
					  </div>
					  <div class="form-group">
					    <label for="inputEmail">Email address</label>
					    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter your email">
					  </div>
					  <div class="form-group hide">
					    <label for="inputAddress">Address</label>
					    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Enter your address">
					  </div>
					  <!-- <div class="form-group">
					    <label for="inputSubject">Message subject</label>
					    <input type="text" class="form-control" id="inputSubject" name="inputSubject" placeholder="Enter your subject">
					  </div> -->					  
					  <div class="form-group">
					    <label for="inputMessage">Message</label>
					    <textarea class="form-control" id="inputMessage" name="inputMessage" placeholder="Enter your message"></textarea>
					  </div>
					  <input type='hidden' value='fpl_submitContactForm' id="action" name="action"/>
					  <button type="submit" class="btn btn-primary" name="fpl_submitContactForm">Submit</button>
					  <div id="contactFormResult"></div>
					</form>
				</div>
			</div>
		</div>
	</div>