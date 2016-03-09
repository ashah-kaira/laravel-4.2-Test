<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MI, Market Insight">
    <link rel="icon" href="#">

    <title>Market Insight- @yield('Title')</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset('/assets/css/bootstrap.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/bootstrap.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/font-awesome.min.css"');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/ionicons.min.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/morris/morris.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/toaster/toaster.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/jvectormap/jquery-jvectormap-1.2.2.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/datepicker/datepicker3.css');?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo asset('/assets/css/daterangepicker/daterangepicker-bs3.css');?>" rel="stylesheet" type='text/css'/>
    <link href="<?php echo asset('/assets/css/iCheck/all.css');?>" rel="stylesheet" type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Lato' rel="stylesheet" type='text/css'/>
    <link href="<?php echo asset('/assets/css/style.css');?>" rel="stylesheet" type='text/css'/>
    <link href="<?php echo asset('/assets/css/iCheck/all.css');?>" rel="stylesheet" type='text/css'/>


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo asset('/assets/js/ie-emulation-modes-warning.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="skin-black">
    <!-- Header Section -->
    <header class="header">
        <a href="<?php echo URL::to('/').'/dashboard'; ?>" class="logo">
            Market Insight
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>

                    <!-- Task : style can be found in dropdown.less-->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span>Jane Doe <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                            <li class="dropdown-header text-center">Account</li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o fa-fw pull-right"></i>
                                    <span class="badge badge-success pull-right">10</span> Updates</a>
                                <a href="#">
                                    <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                    <span class="badge badge-danger pull-right">5</span> Messages</a>
                                <a href="#"><i class="fa fa-magnet fa-fw pull-right"></i>
                                    <span class="badge badge-info pull-right">3</span> Subscriptions</a>
                                <a href="#"><i class="fa fa-question fa-fw pull-right"></i> <span class="badge pull-right">11</span> FAQ</a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    Profile
                                </a>
                                <a data-toggle="modal" href="#modal-user-settings">
                                    <i class="fa fa-cog fa-fw pull-right"></i>
                                    Settings
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="#"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Header Section End-->

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="img/26115.jpg" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Hello, Jane</p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                    </div>
                </form>
                <!-- /.search form -->

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="index.html">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="general.html">
                            <i class="fa fa-gavel"></i> <span>General</span>
                        </a>
                    </li>

                    <li>
                        <a href="basic_form.html">
                            <i class="fa fa-globe"></i> <span>Basic Elements</span>
                        </a>
                    </li>

                    <li>
                        <a href="simple.html">
                            <i class="fa fa-glass"></i> <span>Simple tables</span>
                        </a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- /.right-side  Section Start -->
        <aside class="right-side">
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
            <!-- Footer section-->
            <div class="footer-main">
                Copyright &copy Director, 2014
            </div>
            <!-- Footer End -->
        </aside>
        <!-- /.right-side End-->

    </div><!-- ./wrapper -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.baseUrl = "<?php echo URL::to('/')?>"</script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

	<script src="<?php echo asset('/assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo asset('/assets/js/jquery-ui-1.10.3.min.js');?>"></script>
	<script src="<?php echo asset('/assets/js/ie10-viewport-bug-workaround.js');?>"></script>
    <script src="<?php echo asset('/assets/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo asset('/assets/js/plugins/daterangepicker/daterangepicker.js');?>"></script>
    <script src="<?php echo asset('/assets/js/plugins/iCheck/icheck.min.js');?>"></script>
    <script src="<?php echo asset('/assets/js/plugins/fullcalendar/fullcalendar.js');?>"></script>
    <script src="<?php echo asset('/assets/js/Director/app.js');?>"></script>

    <script src="<?php echo asset('/assets/js/pagelibraries/jquery.history.js');?>"></script>
	<script src="<?php echo asset('/assets/js/pagelibraries/knockout-2.1.0.js');?>"></script>
	<script src="<?php echo asset('/assets/js/pagelibraries/knockout.mapping.js');?>"></script>
	<script src="<?php echo asset('/assets/js/pagelibraries/knockout.validation.js');?>"></script>
	<script src="<?php echo asset('/assets/js/toaster/toaster.js');?>"></script>
    <script src="<?php echo asset('/assets/js/pagejs/jquery.cookie.js');?>"></script>
	<script src="<?php echo asset('/assets/js/pagejs/Common.js');?>"></script>
    <script src="<?php echo asset('/assets/js/pagejs/moment.js');?>"></script>
	<script src="<?php echo asset('/assets/js/BootstrapDialogJs/bootstrap-dialog.js');?>"></script>

    <script type="text/javascript">
        $('input').on('ifChecked', function(event) {
            // var element = $(this).parent().find('input:checkbox:first');
            // element.parent().parent().parent().addClass('highlight');
            $(this).parents('li').addClass("task-done");
            console.log('ok');
        });
        $('input').on('ifUnchecked', function(event) {
            // var element = $(this).parent().find('input:checkbox:first');
            // element.parent().parent().parent().removeClass('highlight');
            $(this).parents('li').removeClass("task-done");
            console.log('not');
        });

    </script>
    <script>
        $('#noti-box').slimScroll({
            height: '400px',
            size: '5px',
            BorderRadius: '5px'
        });

        $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
            checkboxClass: 'icheckbox_flat-grey',
            radioClass: 'iradio_flat-grey'
        });
    </script>
   @yield('script')
</body>
</html>

