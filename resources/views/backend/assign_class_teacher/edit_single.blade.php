@extends('backend.layouts.app')  

@section('content')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Assign Class Teacher</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Assign Class Teacher</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            
                            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Edit Assign Class Teacher</h3>
                                    </div>

                                    <div class="panel-body">                                                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Class <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">
                                                <select class="form-control" name="class_id" required>
                                                    <option value="">Select Class</option>
                                                    @foreach($getClass as $class)
                                                        <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Teacher <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">
                                                
                                                <select class="form-control" name="teacher_id" required>
                                                    <option value="">Select Teacher</option>
                                                    @foreach($getTeacher as $teacher)
                                                        <option {{ ($getRecord->teacher_id == $teacher->id) ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->lastname }}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control" name="status" required>
                                                <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                                <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel-footer">                              
                                        <button class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->
@endsection

@section('script')
        
@endsection