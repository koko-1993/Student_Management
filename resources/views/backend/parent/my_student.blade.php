@extends('backend.layouts.app') 

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item active">Parent</li>
    </ul>
    <!-- END BREADCRUMB -->
                
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> Parent My Student</h2>
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
                        <h3 class="panel-title">Search Student</h3>
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

                            <div style="clear: both;"></div>
                            <br/>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('panel/parent/my-student/'.$parent_id) }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Search Student List</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Parent Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('lastname')) || !empty(Request::get('email')))
                                    @forelse($getMyStudent as $value)                                         
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            @if(!empty($value->getProfile()))
                                                <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}" alt="{{ $value->id }}" />
                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->lastname }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>
                                            @if(!empty($value->getParentData))
                                                {{ $value->getParentData->name }} {{ $value->getParentData->lastname }}
                                            @endif
                                        </td>
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
                                        <a href="{{ url('panel/parent/add-student/'.$value->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm">Add To Parent</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
                                    </tr>
                                    
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">My Student List</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Mobile Number</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)                                         
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            @if(!empty($value->getProfile()))
                                                <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}" alt="{{ $value->id }}" />
                                            @endif
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->lastname }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ $value->mobile_number }}</td>
                                        <td>
                                            {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                        </td>
                                        <td>
                                            <a href="{{ url('panel/parent/my-student-delete/'.$value->id) }}" onclick="return confirm('Are you sure do you want to delete?');" class="btn btn-danger btn-rounded btn-sm"><span class="fa fa-times"></span></a>
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

            </div>
        </div>
        <!-- END RESPONSIVE TABLES -->

    </div>      
    <!-- END PAGE CONTENT WRAPPER --> 
    @endsection

@section('script')
       


@endsection