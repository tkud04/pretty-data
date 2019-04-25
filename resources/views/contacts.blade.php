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
								    <table class="table table-responsive">
									  <thead>
										<th>Name</th>
										<th>Email addresses</th>
                                      </thead>
                                      <tbody>
                                      	@foreach($contacts as $c)
                                           <tr>
                                           <td>{{$c['name']}}</td>
                                           <td>
                                           	@foreach($c['emails'] as $em)
                                                 {{$em}}<br>
                                               @endforeach
                                           </td>
                                           </tr>
                                          @endforeach
                                      </tbody>
                                    </table>
								</div>
							</div>
						</div>
                    </div>
                </div>					
                <!-- End PAge Content -->
								
@stop