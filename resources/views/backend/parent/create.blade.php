@extends('backend.layouts.app')  

@section('content')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('panel/student') }}">Home</a></li>
                    <li class="breadcrumb-item active">Parent</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Create Parent</h2>
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
                                        <h3 class="panel-title">Create Parent</h3>
                                    </div>

                                    <div class="panel-body">
                                        
                                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                            <div class="form-group">
                                                <label for="" class="col-md-3 col-xs-12 control-label">School Name <span class="required">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select class="form-control SchoolChange" required name="school_id">
                                                        <option value="">Select</option>
                                                        @foreach($getSchool as $school)
                                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">First Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Last Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('lastname') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Occupation <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('occupation') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Gender <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control select" name="gender" required>
                                                    <option value="">Select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Mobile Number <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('mobile_number') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                            <div class="col-md-6 col-xs-12">                                                                                                                                        
                                                <input type="file" name="profile_pic" class="form-control" style="padding: 5px;" title="Browse file"/>                                            
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Current Address <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <textarea class="form-control" rows="5" name="address" required>{{ old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Parmanent Address <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <textarea class="form-control" rows="5" name="parmanentaddress" required>{{ old('parmanentaddress') }}</textarea>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Email <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('email') }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">                                        
                                            <label class="col-md-3 col-xs-12 control-label">Password <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                    <input type="password" name="password" class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control select" name="status" required>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Back</button>                                    
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