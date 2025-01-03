
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="text-center fw-bold" style="background-color:#e34724;">
            <a style="font-size: 20px;font-weight: bold;" href="{{ url('panel/dashboard') }}">SCHOOL</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="John Doe"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">John Doe</div>
                    <div class="profile-data-title">Web Developer/Designer</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
                          
        <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
            <a href="{{ url('panel/dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>

    @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)

        <li class="{{ (Request::segment(2) == 'admin') ? 'active' : '' }}">
            <a href="{{ url('panel/admin') }}"><span class="fa fa-user"></span> <span class="xn-text">Admin</span></a>
        </li>

        <li class="{{ (Request::segment(2) == 'school') ? 'active' : '' }}">
            <a href="{{ url('panel/school') }}"><span class="fa fa-user"></span> <span class="xn-text">School</span></a>
        </li>

    @endif

    @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)
    
        <li class="{{ (Request::segment(2) == 'school_admin') ? 'active' : '' }}">
            <a href="{{ url('panel/school_admin') }}"><span class="fa fa-user"></span> <span class="xn-text">School Admin</span></a>
        </li>
    
        <li class="{{ (Request::segment(2) == 'teacher') ? 'active' : '' }}">
            <a href="{{ url('panel/teacher') }}"><span class="fa fa-user"></span> <span class="xn-text">Teacher</span></a>
        </li>
    @endif

        <li class="xn-openable">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
            <ul>
                <li><a href="layout-boxed.html">List</a></li>
            </ul>
        </li>                
    </ul>   
    <!-- END X-NAVIGATION -->
</div>