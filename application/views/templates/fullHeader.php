
<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>CPA - Coloproctologistas Associados | Sistema de gestão médica</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="CPA Associados - Sistema Médico">
        <meta name="author" content="mdesenv.com.br>

              <!-- Mobile Metas -->
              <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

              <!-- Web Fonts  -->
              <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />


        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
        
        <!-- Libraries fora do tema -->
        <script src="<?php echo base_url(); ?>assets/javascripts/functions.js"></script>
        <script src="<?php echo base_url(); ?>assets/javascripts/jquery.mask.js"></script>

        <script>
            $(document).ready(function () {
                $(".<?php echo $page; ?>").addClass("nav-active").parent().parent().addClass("nav-active nav-expanded");
            });
        </script>


    </head>
    <body>
 <!-- end: sidebar -->
        <?php
        if (isset($debug)) { ?>
            <pre class="debug" style="position: absolute;top: 0;z-index: 9999;">
                <div class="closeDebug" style="cursor: pointer;float:right;">X</div>
                <?php print_r($debug); ?>
            </pre>
        <?php }
        ?>  
        <section class="body">
            <!-- start: header -->
            <header class="header">
                
                <!--INÍCIO MODAL-->
                <?php if (isset($msg)) { ?>
                    <script>
                        $(document).ready(function () {
                            $(".<?php echo $page; ?>").addClass("nav-active").parent().parent().addClass("nav-active nav-expanded");

                            $.magnificPopup.open({
                                items: {
                                    src: '#modalPrimary'
                                },
                                type: 'inline'
                            });

                        });
                    </script>
                    <div id="modalPrimary" class="modal-block modal-block-primary mfp-hide">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Atenção</h2>
                            </header>
                            <div class="panel-body">
                                <div class="modal-wrapper">
                                    <div class="modal-text">
                                        <h4><?php echo $msg; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary modal-dismiss">Ok</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </div>
                <?php } ?>
                     <?php if (isset($_REQUEST['msg'])) { ?>
                    <script>
                        $(document).ready(function () {
                            $(".<?php echo $page; ?>").addClass("nav-active").parent().parent().addClass("nav-active nav-expanded");

                            $.magnificPopup.open({
                                items: {
                                    src: '#modalPrimary'
                                },
                                type: 'inline'
                            });

                        });
                    </script>
                    <div id="modalPrimary" class="modal-block modal-block-primary mfp-hide">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Atenção</h2>
                            </header>
                            <div class="panel-body">
                                <div class="modal-wrapper">
                                    <div class="modal-text">
                                        <h4><?php echo $_REQUEST['msg']; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary modal-dismiss">Ok</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </div>
                <?php } ?>
                <!--FIM MODAL-->


                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="<?php echo base_url(); ?>assets/images/logo.png" height="35" alt="Porto Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">
                    <!--
                    <form action="pages-search-results.html" class="search nav-form">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    
                    <span class="separator"></span>

                    <ul class="notifications">
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="badge">3</span>
                            </a>

                            <div class="dropdown-menu notification-menu large">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Tasks
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Generating Sales Report</span>
                                                <span class="message pull-right text-dark">60%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Importing Contacts</span>
                                                <span class="message pull-right text-dark">98%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Uploading something big</span>
                                                <span class="message pull-right text-dark">33%</span>
                                            </p>
                                            <div class="progress progress-xs light mb-xs">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="badge">4</span>
                            </a>

                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">230</span>
                                    Messages
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="<?php echo base_url(); ?>assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Doe</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="<?php echo base_url(); ?>assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="<?php echo base_url(); ?>assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joe Junior</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="<?php echo base_url(); ?>assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <hr />

                                    <div class="text-right">
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge">3</span>
                            </a>

                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Alerts
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-thumbs-down bg-danger"></i>
                                                </div>
                                                <span class="title">Server is Down!</span>
                                                <span class="message">Just now</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-lock bg-warning"></i>
                                                </div>
                                                <span class="title">User Locked</span>
                                                <span class="message">15 minutes ago</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-signal bg-success"></i>
                                                </div>
                                                <span class="title">Connection Restaured</span>
                                                <span class="message">10/10/2014</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <hr />

                                    <div class="text-right">
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    -->
                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?php echo base_url(); ?>assets/images/<?php echo $this->session->user['image'] ?>" alt="" class="img-circle" data-lock-picture="<?php echo base_url(); ?>assets/images/<?php echo $this->session->user['image'] ?>" />
                            </figure>
                            <div class="profile-info" data-lock-name="<?php echo $this->session->user['firstName'] . " " . $this->session->user['lastName']; ?>" data-lock-email="">
                                <span class="name"><?php echo $this->session->user['firstName'] . " " . $this->session->user['lastName']; ?></span>
                                <span class="role"><?php echo $this->session->user['profileName']; ?></span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>index.php/Perfil"><i class="fa fa-user"></i> Meu perfil</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>index.php/Home/logout"><i class="fa fa-power-off"></i> Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Menu
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li class="home">
                                        <a href="<?php echo base_url(); ?>index.php/Home">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Início</span>
                                        </a>
                                    </li>
                                    <li class="home">
                                        <a href="<?php echo base_url(); ?>index.php/Perfil">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>Meu perfil</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Pacientes</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li class="pacientes">
                                                <a class="" href="<?php echo base_url(); ?>index.php/Pacientes">
                                                    <span class="">Buscar</span>
                                                </a>
                                            </li>
                                            <li class="cadastrar">
                                                <a href="<?php echo base_url(); ?>index.php/Pacientes/cadastrar">
                                                    <span>Cadastrar</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>


                                </ul>
                            </nav>

                            <hr class="separator" />
                        </div>
                    </div>
                </aside>









                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2><?php echo $title; ?></h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Home">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Início</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                        </div>
                    </header>

                    <!-- start: page -->



