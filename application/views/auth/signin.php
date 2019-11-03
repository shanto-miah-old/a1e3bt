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

				<div class="input-container">
					<i class="ion-ios-email-outline icon"></i>
					<input type="identity" name="identity" value="<?php echo(set_value('identity')); ?>" placeholder="Enter Email address" class="input-field"/>
				</div>

				<div class="input-container">
					<i class="ion-ios-locked-outline icon"></i>
					<input type="password" name="password" placeholder="Enter Password" class="input-field"/>
				</div>

				<button type="submit" name="submit" class="btn">Sign in</button>

				<div class="input-container mt-2">
					<label for="remember">Remember Me</label>
					<input type="checkbox" name="remember" value="1"  id="remember" />
				</div>

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