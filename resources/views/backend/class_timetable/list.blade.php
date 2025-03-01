@extends('backend.layouts.app')  

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Class Timetable</li>
    </ul>
    <!-- END BREADCRUMB -->
                
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> Class Timetable</h2>
    </div>
    <!-- END PAGE TITLE -->                
                
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                @include('_message')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search Class Timetable</h3>
                    </div>
                    <div class="panel-body">

                        <form action="" method="GET">
                            <div class="col-md-2">
                                <label>Class Name</label>
                                <select name="class_id" class="form-control getClassChange" required>
                                    <option value="">Select</option>
                                    @foreach($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="name">Subject Name</label>
                                <select name="subject_id" class="form-control getSubject" required>
                                    <option value="">Select</option>
                                    @if(!empty($getSubject))
                                        @foreach($getSubject as $subject)
                                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div style="clear: both;"></div>

                            <br/>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('panel/class-timetable') }}" class="btn btn-success">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Class Timetable List</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}" />
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}" />

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th>Week Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                            <tr>
                                                <td>{{ $value['week_name'] }}</td>
                                                <td>
                                                    <input type="hidden" class="form-control" name="timetable[{{ $value['id'] }}][week_id]" value="{{ $value['id'] }}" />
                                                    <input type="time" class="form-control" name="timetable[{{ $value['id'] }}][start_time]" value="{{ $value['start_time'] }}" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="timetable[{{ $value['id'] }}][end_time]" value="{{ $value['end_time'] }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="timetable[{{ $value['id'] }}][room_number]" value="{{ $value['room_number'] }}" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if(!empty(Request::get('subject_id')) && !empty(Request::get('class_id')) )
                                <div style="text-align: right;padding:20px;">
                                    <button class="btn btn-success">Submit</button>        
                                </div>
                                @endif
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div> 
@endsection

@section('script')

    <script type="text/javascript">
        $('body').delegate('.getClassChange','change',function(){
            var class_id = $(this).val();
            $.ajax({
                url:"{{ url('panel/get_assign_subject_class') }}",
                type:"POST",
                data:{
                    _token:"{{ csrf_token() }}",
                    class_id:class_id,
                },
                dataType:"json",
                success:function(response){
                    $('.getSubject').html(response.success);
                },
            });
        });
    </script>

@endsection

