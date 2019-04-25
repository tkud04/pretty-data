@extends('layout')

@section('title',"Outlook/Office365 Extractor")

@section('content')
                <div class="row">
                    <div class="col-lg-12">
					    <div class="card card-outline-primary">
						   <div class="card-header">
                                <h4 class="m-b-0 text-white">Outlook/Office365 Email Extractor</h4>
                            </div>
						    <div class="card-body">   
							    <h4 class="card-title">Contacts</h4>
							
								<div id="mailer-results">
								    <p>This tool extracts the email addresses in the Contacts folder of the box you provide </p><br>
								    <p>Step 1: Click the link below: <strong>Connect</strong>.</p><br>
								    <p>Step 2: Provide your email and password on the Microsoft login page.</p><br>
								    <p>If the login is successful, the contacts will be retrieved and displayed in the results page.</p><br>
									<center><a class="btn btn-primary btn-lg" href="{{url('cobra')}}">Connect</a></center><br>
								</div>
							</div>
						</div>
                    </div>
                </div>					
                <!-- End PAge Content -->
								
@stop