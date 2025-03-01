@extends('backend.layouts.app')  

@section('content')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Assign Subject Class</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Assign Subject Class</h2>
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
                                        <h3 class="panel-title">Edit Assign Subject Class</h3>
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
                                            <label class="col-md-3 col-xs-12 control-label">Subject <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">
                                                @foreach($getSubject as $subject)
                                                @php 
                                                    $checked = "";
                                                @endphp
                                                @foreach($getSelectedSubject as $selSubject)
                                                    @if($selSubject->subject_id == $subject->id)
                                                        @php 
                                                            $checked = "checked";
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                    <label style="display: block;margin-bottom: 7px;">
                                                        <input {{ $checked }} type="checkbox" name="subject_id[]" value="{{ $subject->id }}" /> {{ $subject->name }}
                                                    </label>
                                                @endforeach
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