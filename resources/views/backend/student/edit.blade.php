@extends('backend.layouts.app')  

@section('content')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('panel/student') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Student</h2>
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
                                        <h3 class="panel-title">Edit Student</h3>
                                    </div>

                                    <div class="panel-body">
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">First Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name',$getRecord->name) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Last Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname',$getRecord->lastname) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('lastname') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Admission Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="admission_number" class="form-control" value="{{ old('admission_number',$getRecord->admission_number) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('admission_number') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Roll Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number',$getRecord->roll_number) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('roll_number') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Class <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control" name="class_id" required>
                                                    <option value="">Select</option>
                                                    @foreach($getClass as $class)
                                                        <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Gender <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control select" name="gender" required>
                                                    <option value="">Select</option>
                                                    <option {{ ($getRecord->gender == 'male') ? 'selected' : '' }} value="male">Male</option>
                                                    <option {{ ($getRecord->gender == 'female') ? 'selected' : '' }} value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Date Of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="date" name="dob" class="form-control" value="{{ old('dob',$getRecord->dob) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('dob') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Caste <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="caste" class="form-control" value="{{ old('caste',$getRecord->caste) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('caste') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Religion <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="religion" class="form-control" value="{{ old('religion',$getRecord->religion) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('religion') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Mobile Number <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number',$getRecord->mobile_number) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('mobile_number') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Admission Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date',$getRecord->admission_date) }}" required/>
                                                </div>
                                                <div class="required">{{ $errors->first('admission_date') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                            <div class="col-md-6 col-xs-12">                                                                                                                                        
                                                <input type="file" name="profile_pic" class="form-control" style="padding: 5px;" title="Browse file"/>                                            
                                                @if(!empty($getRecord->getProfile()))
                                                    <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $getRecord->getProfile() }}" alt="{{ $getRecord->id }}" />
                                                @endif
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Blood Group <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="blood_group" class="form-control" value="{{ old('blood_group',$getRecord->blood_group) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('blood_group') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Height <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="height" class="form-control" value="{{ old('height',$getRecord->height) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('height') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Weight <span class="required"></span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="weight" class="form-control" value="{{ old('weight',$getRecord->weight) }}"/>
                                                </div>
                                                <div class="required">{{ $errors->first('weight') }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Current Address <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <textarea class="form-control" rows="5" name="address" required>{{ old('address',$getRecord->address) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Parmanent Address <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <textarea class="form-control" rows="5" name="parmanentaddress" required>{{ old('parmanentaddress',$getRecord->parmanentaddress) }}</textarea>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Email <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email',$getRecord->email) }}" required/>
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

                                        <hr/>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select class="form-control select" name="status" required>
                                                    <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
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