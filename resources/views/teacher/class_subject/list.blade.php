@extends('backend.layouts.app')  

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item active">My Class & Subject</li>
                </ul>
    <!-- END BREADCRUMB -->
                
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> My Class & Subject</h2>
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
                        <h3 class="panel-title">My Class & Subject Search</h3>
                    </div>
                    <div class="panel-body">

                        <form action="" method="GET">

                            <div class="col-md-2">
                                <label for="name">Class Name</label>
                                <input type="text" name="class_name" class="form-control" value="{{ Request::get('class_name') }}" placeholder="Class Name"/>
                            </div>

                            <div class="col-md-2">
                                <label for="name">Subject Name</label>
                                <input type="text" name="subject_name" class="form-control" value="{{ Request::get('subject_name') }}" placeholder="Subject Name"/>
                            </div>

                            <div style="clear: both;"></div>
                            <br/>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('panel/school') }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">My Class & Subject List</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>My Class Timetable</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->subject_type }}</td>
                                            <td>
                                                @php
                                                    $getClassTimeTable = App\Models\ClassTimeTableModel::getRecordWeekName($value->class_id, $value->subject_id, date('1'));
                                                @endphp
                                                @if(!empty($getClassTimeTable))
                                                    {{ date('h:i A', strtotime($getClassTimeTable->start_time)) }}
                                                    to
                                                    {{ date('h:i A', strtotime($getClassTimeTable->end_time)) }} 
                                                    </br>
                                                    Room Number: {{ $getClassTimeTable->room_number }}

                                                @endif
                                            </td>
                                            <td>
                                                {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                            </td>
                                            <td>
                                                <a href="{{ url('teacher/my-class-subject/timetable/'.$value->class_id.'/'.$value->subject_id) }}" class="btn btn-primary">Class Timetable</a>
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
                    {{-- {{ $getRecord->links() }} --}}
                </div> 

            </div>
        </div>
        <!-- END RESPONSIVE TABLES -->

    </div>      
    <!-- END PAGE CONTENT WRAPPER --> 
@endsection

@section('script')
        
@endsection