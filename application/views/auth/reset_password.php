<!DOCTYPE html>
<html>
<head>
<!-- Responsive -->
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Start of SEO Part -->
<meta name="keywords" content="Lookingfor, Login, Signin"/>
<meta name="description" content="Lookingfor is one of the best Bangladeshi Social Media website. Create an Lookingfor account and create a online community."/>
<!-- End of SEO Part -->

<title><?php echo($title); ?></title>

<!-- Stylesheet Linking -->
<?php echo(link_tag('assets/bootstrap/css/bootstrap-grid.min.css')); ?>

<?php echo(link_tag('assets/sheets/stylesheet/stylesheet.css')); ?>

<?php echo(link_tag('assets/sheets/stylesheet/fonts.min.css')); ?>

<!-- Ionicons -->
<?php echo(link_tag('assets/Ionicons/css/ionicons.min.css')); ?>

</head>
<body>
<div class="logo">
	<p>lookingfor</p>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">
			<div class="error-message">
				<?php echo($message); ?>
			</div>
			<form action="" method="POST">
				<input type="hidden" name="<?php echo($csrf['name']); ?>" value="<?php echo($csrf['hash']); ?>" />

				<input type="hidden" name="user_id" value="<?php echo($user_id); ?>" />

				<div class="input-container">
					<i class="ion-ios-locked-outline icon"></i>
					<input type="password" name="new" value="" placeholder="New Password" class="input-field"/>
				</div>

				<div class="input-container">
					<i class="ion-ios-locked-outline icon"></i>
					<input type="password" name="new_confirm" placeholder="Confirm New Password" class="input-field"/>
				</div>



				<button type="submit" name="submit" class="btn">Change Password</button>


			</form>
			<div class="widget-1 row">
				<div class="col-6">
					<?php echo(anchor('recover', 'Forgotten Password?')); ?>
				</div>
				<div class="col-6 text-right">
					<?php echo(anchor('help', 'Help Center')); ?>
				</div>
			</div>
			<div class="cna">
				<p>Don't you have any account? If you don't have any account, <?php echo(anchor('join', 'Create New Account.')); ?></p>
			</div>
		</div>
	</div>
</div>