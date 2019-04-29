                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">PrettyData 1.1</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{url('import')}}" method="post" enctype="multipart/form-data">
								   {!! csrf_field() !!}
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Upload Excel file</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Sender Name</label>
                                                    <input type="file" id="senderName" class="form-control" name="dataa" required>
												</div>
                                            </div>
                                            <!--/span-->                                  
                                        </div>
                                        <!--/row-->
                                    </div>
                                   <!--/form-body-->
										
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->