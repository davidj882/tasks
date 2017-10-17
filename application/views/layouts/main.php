<?php 
    $fullname       = $this->session->userdata('fullname');
    $picture        = $this->session->userdata('picture');
    $profile        = $this->session->userdata('profile');
    $id_user        = $this->session->userdata('id_user');
    $profile_name   = $this->session->userdata('profile_name');
    if (isset($title)) {
        $title = $title. " | CENCADE TASKS";
    }else{
        $title = "CENCADE TASKS";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('assets/css/AdminLTE.min.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('assets/css/skins/_all-skins.min.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- ////// SCRIPTS /////// -->

        <!-- jQuery 2.2.0 -->
        <script src="<?php echo site_url('assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('assets/plugins/fastclick/fastclick.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php #echo site_url('assets/js/AdminLTE/app.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/app.js'); ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('assets/js/AdminLTE/demo.js'); ?>"></script>

        <!-- Letter Avatar -->
        <script src="<?php echo site_url('assets/plugins/letteravatar/letteravatar.js'); ?>"></script>
        
        <!-- PUSH DATA -->
        <!-- https://github.com/pusher/pusher-http-php/releases/tag/v2.6.0 
        <script type="text/javascript" src="<?php #echo site_url('assets/js/rototype.js'); ?>"></script>-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">C<b>TK</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">CENCADE <b>TASKS</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <?php $total_new_messages = $this->Message_model->get_messages_not_read($id_user); ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <?php if ($total_new_messages > 0): ?>
                                        <span class="label label-success">
                                            <?php echo $total_new_messages; ?>
                                        </span>
                                    <?php endif ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php $messages_inbox = $this->Message_model->get_messages_inbox($id_user); ?>
                                    <li class="header">Tienes <?php echo count($messages_inbox); ?> mensajes</li>
                                    <?php if (count($messages_inbox) > 0): ?>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <?php foreach ($messages_inbox as $mi): ?>
                                                    <?php 
                                                        $id_m = $mi['id_message'];
                                                        $image_from = $this->Message_model->image_from($id_m);
                                                    ?>
                                                    <li><!-- start message -->
                                                        <a href="<?php echo site_url('message/view/'.$id_m) ?>">
                                                            <div class="pull-left">
                                                                <?php if (empty($image_from['picture'])): ?>
                                                                    <img class="user-image round" avatar="<?php echo $image_from['fullname']; ?>">
                                                                <?php else: ?>
                                                                    <img src="<?php echo site_url('uploads/users/'.$image_from['picture']); ?>" class="img-circle" width="160" height="160">
                                                                <?php endif ?>
                                                            </div>
                                                            <h4>
                                                                <?php echo $mi['subject']; ?>
                                                                <small>
                                                                    <i class="fa fa-clock-o"></i> 
                                                                    <?php echo $mi['date_send']; ?>
                                                                </small>
                                                            </h4>
                                                            <p>
                                                                <?php echo word_limiter(strip_tags($mi['message']), 4); ?>
                                                            </p>
                                                        </a>
                                                    </li>
                                                    <!-- end message -->
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="<?php echo site_url('message/') ?>">Ver todos los mensajes</a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </li>

                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <?php 
                                    $notifications = $this->Notification_model->get_notification_users($id_user);
                                ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>

                                    <?php if (count($notifications) > 0): ?>
                                        <span class="label label-warning">
                                            <?php echo count($notifications); ?>
                                        </span>
                                    <?php endif ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (count($notifications) > 0): ?>
                                        <li class="header">
                                            Tienes <?php echo count($notifications); ?> notificación(es)
                                        </li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <?php foreach ($notifications as $n): ?>
                                                    <li>
                                                        <?php if ($n['type'] == 'task'): ?>
                                                            <a href="<?php echo site_url('task/view/'.$n['id_item']); ?>">
                                                                <i class="fa fa-tasks text-aqua"></i>
                                                                <?php echo $n['task_name']; ?>
                                                            </a>
                                                        <?php elseif($n['type'] == 'project'): ?> 
                                                            <a href="<?php echo site_url('project/view/'.$n['id_item']); ?>">
                                                                <i class="fa fa-briefcase text-aqua"></i>
                                                                <?php echo $n['project_name']; ?>
                                                            </a>
                                                        <?php endif ?>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                        <!--  <li class="footer">
                                            <a href="#">
                                                Ver Todas
                                            </a>
                                        </li> -->
                                    <?php endif ?>
                                </ul>
                            </li>

                            <!-- Tasks: style can be found in dropdown.less
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- inner menu: contains the actual data
                                        <ul class="menu">
                                            <li><!-- Task item
                                                <a href="#">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item
                                            <li><!-- Task item
                                                <a href="#">
                                                    <h3>
                                                        Create a nice theme
                                                        <small class="pull-right">40%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item
                                            <li><!-- Task item
                                                <a href="#">
                                                    <h3>
                                                        Some task I need to do
                                                        <small class="pull-right">60%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item
                                            <li><!-- Task item
                                                <a href="#">
                                                    <h3>
                                                        Make beautiful transitions
                                                        <small class="pull-right">80%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">80% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li> -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if (empty($picture)): ?>
                                        <img class="user-image round" avatar="<?php echo $fullname; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo site_url('uploads/users/'.$picture); ?>" class="user-image" alt="<?php echo $fullname; ?>">
                                    <?php endif ?>
                                    <span class="hidden-xs"><?php echo $fullname; ?></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php if (empty($picture)): ?>
                                            <img class="img-circle round" width="160" height="160" avatar="<?php echo $fullname; ?>">
                                        <?php else: ?>
                                            <img src="<?php echo site_url('uploads/users/').$picture; ?>" class="img-circle" width="160" heigth="160">
                                        <?php endif ?>

                                        <p>
                                            <?php echo $fullname; ?>
                                            <small><?php echo $profile_name; ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="">
                                            <a href="<?php echo site_url('user/change_password'); ?>" class="btn btn-default btn-block btn-flat">
                                                Cambiar Contraseña
                                            </a>
                                        </div>
                                        <!-- <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">
                                                Mis Ajustes
                                            </a>
                                        </div> -->
                                    </li>
                                </ul>
                            </li>

                            <!-- LogOut Button -->
                            <li class="hidden-xxs">
                                <a href="<?php echo site_url('dashboard/logout'); ?>" title="Desconectarse">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </li>

                            <!-- Control Sidebar Toggle Button
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">NAVEGACIÓN PRINCIPAL</li>
                        <li>
                            <a href="<?php echo site_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <?php if ($profile == 1 || $profile == 2): ?>
                            <!-- Enterprises -->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-building"></i> <span>Clientes</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="active">
                                        <a href="<?php echo site_url('enterprise/add');?>">
                                            <i class="fa fa-plus"></i> Añadir
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('enterprise/index');?>">
                                            <i class="fa fa-list-ul"></i> Listado
                                        </a>
                                    </li>

                                    <?php if ($profile == 1): ?>
                                        <!-- Roles -->
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fa fa-user-circle-o"></i> <span>Roles</span>
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li class="active">
                                                    <a href="<?php echo site_url('role/add');?>">
                                                        <i class="fa fa-plus"></i> Añadir
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('role/index');?>">
                                                        <i class="fa fa-list-ul"></i> Listado
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </li>

                            <!-- Users -->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Usuarios</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="active">
                                        <a href="<?php echo site_url('user/add');?>">
                                            <i class="fa fa-plus"></i> Añadir
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('user/index');?>">
                                            <i class="fa fa-list-ul"></i> Listado
                                        </a>
                                    </li>

                                    <?php if ($profile == 1): ?>
                                        <!-- Profiles -->
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fa fa-id-badge"></i> Perfiles
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li class="active">
                                                    <a href="<?php echo site_url('profile/add');?>">
                                                        <i class="fa fa-plus"></i> Añadir
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('profile/index');?>">
                                                        <i class="fa fa-list-ul"></i> Listado
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </li>

                            <!-- Projects -->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-briefcase"></i> <span>Proyectos</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($profile < 3): ?>
                                        <li class="active">
                                            <a href="<?php echo site_url('project/add');?>">
                                                <i class="fa fa-plus"></i> Añadir
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('project/index');?>">
                                                <i class="fa fa-list-ul"></i> Listado
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="active">
                                            <a href="<?php echo site_url('project/index');?>">
                                                <i class="fa fa-list-ul"></i> Listado
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </li>

                            <!-- Tasks -->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-tasks"></i> <span>Tareas</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($profile < 3): ?>
                                        <li class="active">
                                            <a href="<?php echo site_url('task/add');?>">
                                                <i class="fa fa-plus"></i> Añadir
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('task/index');?>">
                                                <i class="fa fa-list-ul"></i> Listado
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="active">
                                            <a href="<?php echo site_url('task/index');?>">
                                                <i class="fa fa-list-ul"></i> Listado
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Calendar -->
                        <li>
                            <a href="<?php echo site_url('calendar/') ?>">
                                <i class="fa fa-calendar"></i> <span>Calendario</span>
                            </a>
                        </li>

                        <!-- Messages -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa fa-envelope"></i> <span>Mensajes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active">
                                    <a href="<?php echo site_url('message/add');?>">
                                        <i class="fa fa-plus"></i> Nuevo mensaje
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('message/index');?>">
                                        <i class="fa fa-list-ul"></i> Ver Mensajes
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php if (isset($breadcrumb) && isset($page_title)): ?>
                    <section class="content-header">
                        <h1>
                            <?php echo $page_title; ?>

                            <?php if (isset($small_title)): ?>
                                <small>
                                    <?php echo $small_title; ?>
                                </small>
                            <?php endif ?>
                        </h1>

                        <?php echo $breadcrumb; ?>
                    </section>
                <?php endif ?>

                <!-- Main content -->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Modal to Delete Row -->
            <div class="modal modal-danger" id="modal-delete-row">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Eliminar registro</h4>
                        </div>
                        <div class="modal-body text-center">
                            <font size="5">
                                ¿Realmente deseas eliminar el registro <b></b>?
                            </font>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">
                                Cerrar
                            </button>
                            <a id="link-del" class="btn btn-outline">
                                <i class="fa fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $(document).ready(function () {
                    $(".del-row").click(function(e) {
                        e.preventDefault();

                        var url     = this.href;
                        var title   = $(this).attr('data-title');

                        console.log(title);

                        $("#modal-delete-row").find(".modal-body b").text(title);
                        $("#modal-delete-row").find("#link-del").attr('href', url);
                        $("#modal-delete-row").modal("show");
                    });
                });
            </script>

            <!-- /.Modal to Delete Row -->
            
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>
                    &copy; Copyright <?php echo date('Y'); ?> <a href="http://cencade.com.mx">CENCADE</a>.
                </strong> Derechos Reservados.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
    </body>
</html>