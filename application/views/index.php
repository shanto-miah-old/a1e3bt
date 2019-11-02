<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo($title); ?></title>

	<!-- bootstrap -->
	<?php echo(link_tag('assets/bootstrap/css/bootstrap.min.css')); ?>
	<!-- Ionicon -->
	<?php echo(link_tag('assets/Ionicons/css/ionicons.min.css')); ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Project Name</a>
</nav>


<div class="container">
  <div class="row justify-content-center py-4">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashbord</div>
        <div class="card-body">
          <div class="h5 card-title">Welcome Back</div>
          <table class="table">
            <tr>
              <th>Full Name</th>
              <td><?php echo($user->first_name.' '.$user->last_name); ?></td>
            </tr>
            <tr>
              <th>Email Address</th>
              <td><?php echo($user->email); ?></td>
            </tr>
            <tr>
              <td colspan="2">
                <?php echo(anchor('logout', '<i class="ion ion-log-out"></i> Log-Out', array('class'  =>  'btn btn-sm btn-block btn-warning', 'onclick' =>  "return confirm('Are you sure to logout?');"))); ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Javascript -->

<script type="text/javascript" src="<?php echo(base_url('assets/jquery/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo(base_url('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>

</body>
</html>