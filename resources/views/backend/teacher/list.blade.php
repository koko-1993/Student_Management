@extends('backend.layouts.app') 

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item active">Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->
                
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> Teacher</h2>
    </div>
    <!-- END PAGE TITLE -->                
                
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Teacher Search</h3>
                    </div>
                    <div class="panel-body">

                        <form action="" method="GET">
                            <div class="col-md-2">
                                <label for="id">ID</label>
                                <input type="text" name="id" id="" class="form-control" value="{{ Request::get('id') }}" placeholder="ID"/>
                            </div>

                            <div class="col-md-2">
                                <label for="name">First Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ Request::get('name') }}" placeholder="First Name"/>
                            </div>

                            <div class="col-md-2">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ Request::get('lastname') }}" placeholder="Last Name"/>
                            </div>

                            <div class="col-md-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email"/>
                            </div>

                            <div class="col-md-2">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Select</option>
                                    <option {{ (Request::get('gender') == 'male') ? 'selected' : '' }} value="male">Male</option>
                                    <option {{ (Request::get('gender') == 'female') ? 'selected' : '' }} value="female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ (Request::get('status') == '100') ? 'selected' : '' }} value="100">Inactive</option>
                                </select>
                            </div>

                            <div style="clear: both;"></div>
                            <br/>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('panel/teacher') }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Teacher List</h3>
                        <a href="{{ url('panel/teacher/create') }}" class="btn btn-primary pull-right">Create Teacher</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                            <th>School Name</th>
                                        @endif
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Date Of Joining</th>
                                        <th>Mobile Number</th>
                                        <th>Martial Status</th>
                                        <th>Address</th>
                                        <th>status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)                                         
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                            <td>
                                                @if(!empty($value->getCreatedBy))
                                                    {{ $value->getCreatedBy->name }}
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            @if(!empty($value->getProfile()))
                                                <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}" alt="{{ $value->id }}" />
                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->lastname }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->dob)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->date_of_join)) }}</td>
                                        <td>{{ $value->mobile_number }}</td>
                                        <td>{{ $value->martial_status }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                            @if($value->status == 1)
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                        </td>
                                        <td>
                                            <a href="{{ url('panel/teacher/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                            <a href="{{ url('panel/teacher/delete/'.$value->id) }}" onclick="return confirm('Are you sure do you want to delete?');" class="btn btn-danger btn-rounded btn-sm"><span class="fa fa-times"></span></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
                                    </tr>
                                    
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>   
                            
                <div class="pull-right">
                    {{ $getRecord->links() }}
                </div> 

            </div>
        </div>
        <!-- END RESPONSIVE TABLES -->

    </div>      
    <!-- END PAGE CONTENT WRAPPER --> 
    @endsection

@section('script')
       


@endsection