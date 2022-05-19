<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE u_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$ut=mysql_query("SELECT COUNT(*) FROM users;");
$ucount=mysql_result($ut,0);

$ic=mysql_query("SELECT SUM(s_price) FROM vehicle;");
$icount=mysql_result($ic,0);

$ut2=mysql_query("SELECT COUNT(*) FROM vehicle;");
$vehcount=mysql_result($ut2,0);

$vt=mysql_query("SELECT COUNT(*) FROM customer;");
$vcount=mysql_result($vt,0);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VSMS Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="dashboard.php"><span> Vehicle Sales</span> Management System</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $userRow['f_name']; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="profile.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="logout.php?logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div>
		
		<a class="nav menu" href="#">
                    <img src="img/lg3.png" alt="" height="165" width="190" style="margin-left: 9%; margin-top: 3%; "></a>
		<br></div>
		
		<ul class="nav menu side-nav">
		
			<li class="<?php if($page=='dash'){ echo 'active'; }?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
			<?php
		if($userRow['u_type']=="Admin") 
			if($page=='emp'){
				echo '<li class="active"><a href="manage_employee.php"><i class="fas fa-users"></i> Manage Employee</a></li>';
			} else {
				echo '<li><a href="manage_employee.php"><i class="fas fa-users"></i> Manage Employee</a></li>';
			}
		?>
			<li class="<?php if($page=='model'){ echo 'active'; }?>"><a href="model.php"><i class="fas fa-th"></i> Vehicle Model</a></li>
			<li class="<?php if($page=='vehicles'){ echo 'active'; }?>"><a href="vehicles.php"><i class="fas fa-car"></i> Vehicle Management</a></li>
			<li class="<?php if($page=='sold'){ echo 'active'; }?>"><a href="sold.php"><i class="fas fa-hand-holding-usd"></i> Sold Vehicles</a></li>
			
		</ul>

	</div><!--/.sidebar-->
		<!--/.main-->
	<script src="js/jquery-1.12.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="js/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/lumino.glyphs.js"></script>
	
    
   
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>
</html>