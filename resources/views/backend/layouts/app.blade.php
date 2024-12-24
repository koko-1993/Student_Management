
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Atlant - Responsive Bootstrap Admin Template</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('assets/dist/css/theme-default.css') }}"/>
        <!-- EOF CSS INCLUDE -->                                       
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            @include('backend.layouts.sidebar')
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                @include('backend.layouts.header')
                <!-- END X-NAVIGATION VERTICAL -->
                 @yield('content')
            </div>         
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->        
        
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{ asset('audio/alert.mp3') }}" preload="auto"></audio>
        <audio id="audio-fail" src="{{ asset('audio/fail.mp3') }}" preload="auto"></audio>
        <!-- END PRELOADS -->                      

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ asset('assets/dist/js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/dist/js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/dist/js/plugins/bootstrap/bootstrap.min.js') }}"></script>        
        <!-- END PLUGINS -->
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src="{{ asset('assets/dist/js/plugins/icheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/dist/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        
        <!-- END THIS PAGE PLUGINS-->  
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ asset('assets/dist/js/settings.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('assets/dist/js/plugins.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('assets/dist/js/actions.js') }}"></script>        
        <!-- END TEMPLATE -->

        @yield('script')
    <!-- END SCRIPTS -->                 
    </body>
</html>






