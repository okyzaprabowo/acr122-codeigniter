<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absensi Beta</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/plugins/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/adminlte/AdminLTE.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url();?>dist/plugins/select2/select2.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/adminlte/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url();?>" class="navbar-brand"><b>Absensi</b>Beta</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url();?>">Beranda <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Daftar</a></li>
                <li><a href="<?php echo site_url('absensi');?>">Absensi</a></li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                 

                  <!-- Notifications Menu -->
                 
                  <!-- Tasks Menu -->
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs">Administrator</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        <p>
                          Alexander Pierce - Web Developer
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="#" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
	        <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Pendaftaran
            </h1>
            <ol class="breadcrumb">
              <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h1 class="box-title">Daftar</h1>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-lg-10">
						<p><?php echo validation_errors();?></p>
							<form action="<?php echo site_url('daftar');?>" method="POST" class="form-horizontal">
								<div class="form-group">
									<label for="nim" class="col-lg-1 control-label">NIM</label>
									<div class="col-lg-4">
									<input type="text" name="nim" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="nama" class="col-lg-1 control-label">Nama</label>
									<div class="col-lg-4">
										<input type="text" name="nama" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="uid" class="col-lg-1 control-label">UID</label>
									<div class="col-lg-4">
										<input type="text" name="uid" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label for="angkatan" class="col-lg-1 control-label">Angkatan</label>
									<div class="col-lg-4">
										<select class="form-control select2" name="angkatan" data-placeholder="Pilih Tahun"style="width: 100%;" >
											<option value="2000">2000</option>
											  <option>2000</option>
											  <option>2001</option>
											  <option>2002</option>
											  <option>2003</option>
											  <option>2004</option>
											  <option>2005</option>
											  <option>2006</option>
											  <option>2007</option>
											  <option>2008</option>
											  <option>2009</option>
											  <option>2010</option>
											  <option>2011</option>
											  <option>2012</option>
											  <option>2013</option>
											  <option>2014</option>
											  <option>2015</option>
											  <option>2016</option>
										</select>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-flat pull-right" style="margin-right:550px;">Daftar</button>
							</form>
							
						</div>
						</div>
					</div>
				</div>
			</div>
		  </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
	  <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
          </div>
          <strong>Copyright &copy; 2016 <a href="http://indisbuilding.com">Indisbuilding</a>.</strong> Beta Version.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>dist/jquery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>dist/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="<?php echo base_url();?>dist/plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/dist/js/app.min.js"></script>
	<script>
		 $(function () {
        $(".select2").select2();
		});
	</script>
  <script>
  $(document).ready(function(){
    
    $("input[name=uid]").focusin(function(){
      var uidtext;
      $(this).css("background-color", "#FFFFFF");
        setInterval(function(){
            $.get("http://localhost/abs_beta/index.php/welcome/getuid", function(data, response){
              $("input[name=uid]").val(data);
            console.log(data);
          });
        }, 3000);
        
        
      });
      $("input[name=uid]").focusout(function(){
          //$(this).css("background-color", "#000000");
      });
  });
  </script>
  </body>
</html>
