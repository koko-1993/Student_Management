@extends('backend.layouts.app')  

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item active">My Class & Subject Timetable</li>
    </ul>
    <!-- END BREADCRUMB -->
                
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> My Class & Subject Timetable</h2>
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
                        <h3 class="panel-title">{{ $getClass->name }} - {{ $getSubject->name }}</h3>
                    </div>

                    <div class="panel-body panel-body-table">

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
                                                @if(!empty($value['start_time']))
                                                    {{ date('h:i A', strtotime($value['start_time'])) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($value['end_time']))
                                                    {{ date('h:i A', strtotime($value['end_time'])) }}
                                                @endif
                                            </td>
                                            <td>{{ $value['room_number'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>   
                            
                <div class="pull-right">
                   
                </div> 

            </div>
        </div>
        <!-- END RESPONSIVE TABLES -->

    </div>      
    <!-- END PAGE CONTENT WRAPPER --> 
@endsection

@section('script')
        
@endsection