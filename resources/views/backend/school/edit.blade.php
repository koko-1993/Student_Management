@extends('backend.layouts.app')  

@section('content')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">School</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Edit School</h2>
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
                                        <h3 class="panel-title">Edit School</h3>
                                    </div>

                                    <div class="panel-body">                                                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">School Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $getSchool->name) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                            <div class="col-md-6 col-xs-12">                                                                                                                                        
                                                <input type="file" name="profile_pic" class="form-control" style="padding: 5px;" title="Browse file"/>                                            

                                                @if(!empty($getSchool->getProfile()))
                                                    <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $getSchool->getProfile() }}" alt="{{ $getSchool->id }}" />
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Email <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $getSchool->email) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('email') }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">                                        
                                            <label class="col-md-3 col-xs-12 control-label">Password <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                    <input type="text" name="password" class="form-control"/>
                                                </div>
                                                ( Do you want to change password so please enter otherwise leave it blank )
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Address <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <textarea class="form-control" rows="5" name="address" required>{{ old('address', $getSchool->address) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control select" name="status" required>
                                                    <option {{ ($getSchool->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ ($getSchool->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Clear Form</button>                                    
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