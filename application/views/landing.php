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
    <!-- sweet alert -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/adminlte/skins/_all-skins.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>dist/jquery/jQuery-2.1.4.min.js"></script>
    <!-- Sweet alert 2.1.4 -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>dist/bootstrap/js/bootstrap.min.js"></script>

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
                <li class="active"><a href="#">Beranda<span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo site_url('daftar');?>">Daftar</a></li>
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
              Dashboard
            </h1>
            <ol class="breadcrumb">
              <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
			<div class="row">
				<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $this->db->count_all('tbl_mahasiswa');?></h3>
                  <p>Mahasiswa Terdaftar</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-people"></i>
                </div>
                <a href="<?php echo site_url('absensi');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
				</div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
                <div class="inner" id="aktif" style="display:none">
                  <h3>Silakan</h3>
                  <p>Tap Kartu Anda</p>
                  
                </div>
                <!--<a href="<?php echo site_url('absensi');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                <div class="small-box-footer">
                  <label><input id="state" type="checkbox" name="mode" value="absensi"> Mode Absensi</label>
                  <div id="txtMode" style="display:none">Absensi Diaktifkan</div>
                </div>
              </div>
            </div><!-- ./col -->
        </div>
			</div>
		  </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
</body>



<script>

$(document).ready(function(){
  setInterval(function(){
    if ($("input:checked").length > 0)
    {
      $.get("http://localhost/abs_beta/index.php/welcome/getuid", function(data, response){
            $.post("http://localhost/abs_beta/index.php/welcome/postuid", {uid: data}, function(result){
                console.log(result);
                /*
                if (result == '0')
                {
                    console.log('Silakan Tap Kartu');
                }
                else if (result == '1')
                {
                    console.log('Betul');
                    alert('Silakan Masuk');
                }
                else if (result == '2')
                {
                    console.log('Salah');
                    alert('Maaf, Anda belum terdaftar');
                }
                */
            });
          });
    }
    else
    {
      console.log("Mode Daftar");
    }
  }, 3000);
});

/*
  $('#state').click(function() {
    $("#aktif").toggle(this.checked);
    
    
    setInterval(function(){
            $.get("http://localhost/abs_beta/index.php/welcome/getuid", function(data, response){
            console.log(data);
          });
        }, 3000);
    
*/

</script>

</html>