                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Office365 Mailer</h4>
                            </div>
                            <div class="card-body">
                                <form action="#">
								   <input type="hidden" id="uu" value="{{url('send')}}">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Sender Info</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sender Name</label>
                                                    <input type="text" id="senderName" class="form-control" placeholder="John doe">
                                                    <small id="error-sender-name" class="form-control-feedback text-danger"> This field is required. </small>  
												</div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Sender Email</label>
                                                    <input type="text" id="senderEmail" class="form-control form-control-danger" placeholder="john@yahoo.com">
                                                    <small id="error-sender-email" class="form-control-feedback text-danger"> This field is required. </small> 
													</div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
										<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Subject</label>
                                                    <input type="text" id="subject" class="form-control" placeholder="Enter subject">
                                                    <small id="error-subject" class="form-control-feedback text-danger"> This field is required. </small>  
													</div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
                                                    <input type="text" id="link" class="form-control form-control-danger" placeholder="www.yourlink.com"> 
													</div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        
                                        <h3 class="box-title m-t-40">SMTP Info</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP Server</label>
                                                    <input type="text" class="form-control" id="SMTPServer" placeholder="SMTP server domain or IP address">
													<small id="error-smtp-server" class="form-control-feedback text-danger"> This field is required. </small> 
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP Port</label>
                                                    <input type="number" class="form-control" id="SMTPPort" placeholder="SMTP port">
													<small id="error-smtp-port" class="form-control-feedback text-danger"> This field is required. </small> 
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP Username</label>
                                                    <input type="text" class="form-control" id="SMTPUser" placeholder="SMTP username">
													<small id="error-smtp-username" class="form-control-feedback text-danger"> This field is required. </small> 
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP Password</label>
                                                    <input type="password" class="form-control" id="SMTPPass" placeholder="SMTP password">
													<small id="error-smtp-password" class="form-control-feedback text-danger"> This field is required. </small> 
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
										<div class="row">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>Authentication Type</label>
                                                    <select class="form-control custom-select" id="SMTPAuth">
                                                        <option>--Use authentication?--</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>Encryption Type</label>
                                                    <select class="form-control custom-select" id="SMTPEnc">
                                                        <option>--Select encryption type--</option>
                                                        <option value="ssl">SSL/TLS</option>
                                                        <option value="tls">TLS</option>
                                                        <option value="none">None</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										  <h3 class="box-title m-t-40">Content</h3>
										  <hr>
										 <div class="row">
                                            <div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Messages</h4>
                                                    <h6 class="card-subtitle">Type your message here</h6>
                                                    <form method="post">
                                                        <div class="form-group">
                                                            <textarea id="message" class="textarea_editor form-control" rows="15" placeholder="Enter message here..." style="height:450px"></textarea>
															<small id="error-messages" class="form-control-feedback text-danger"> This field is required. </small> 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
											<div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Leads</h4>
                                                    <h6 class="card-subtitle">Paste your leads here</h6>
                                                    <form method="post">
                                                        <div class="form-group">
                                                            <textarea  id="leads" class="form-control" rows="15" placeholder="Enter leads here (one per line)" style="height:450px"></textarea>
															<small id="error-leads" class="form-control-feedback text-danger"> This field is required. </small> 
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="form-actions">
                                        <button id="form-submit" class="btn btn-success"> <i class="fa fa-check"></i> Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-lg-12">
					    <div class="card">
						    <div class="card-body">
							    <h4 class="card-title">Results</h4>
								<div id="logs-loading"></div><br>
								<div id="mailer-results">
								    Click Send above to start sending messages!
								</div>
							</div>
						</div>
                    </div>
                </div>					
                <!-- End PAge Content -->