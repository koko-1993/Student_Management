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
        <h2><span class="fa fa-arrow-circle-o-left"></span> Assign Class Teacher</h2>
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
                        <h3 class="panel-title">Assign Class Teacher Search</h3>
                    </div>
                    <div class="panel-body">

                        <form action="" method="GET">
                            <div class="col-md-2">
                                <label for="id">ID</label>
                                <input type="text" name="id" id="" class="form-control" value="{{ Request::get('id') }}" placeholder="ID"/>
                            </div>

                            <div class="col-md-2">
                                <label>Class Name</label>
                                <input type="text" name="class_name" class="form-control" value="{{ Request::get('class_name') }}" placeholder="Class Name"/>
                            </div>

                            <div class="col-md-2">
                                <label>Teacher Name</label>
                                <input type="text" name="teacher_name" class="form-control" value="{{ Request::get('teacher_name') }}" placeholder="Teacher Name"/>
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
                                <a href="{{ url('panel/assign-class-teacher') }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Assign Class Teacher List</h3>
                        <a href="{{ url('panel/assign-class-teacher/create') }}" class="btn btn-primary pull-right">Create Assign Class Teacher</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)                                         
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->class_name }}</td>
                                        <td>{{ $value->teacher_name }} {{ $value->teacher_lastname }}</td>
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
                                            <a href="{{ url('panel/assign-class-teacher/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                            <a href="{{ url('panel/assign-class-teacher/delete/'.$value->id) }}" onclick="return confirm('Are you sure do you want to delete?');" class="btn btn-danger btn-rounded btn-sm"><span class="fa fa-times"></span></a>
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

