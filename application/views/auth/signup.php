<!DOCTYPE html>
<html>
<head>
<!-- Responsible -->
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Start of SEO Part -->
<meta name="keywords" content="Lookingfor, Sign Up"/>
<meta name="description" content="Lookingfor is one of the best Bangladeshi Social Media website. Create an Lookingfor account and create a online community."/>
<!-- End fo SEO Part -->

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
	<p>Lookingfor</p>
</div>
<div class="head">
	<p>Sign up for Lookingfor</p>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">

			<form action="#" method="POST">

				<input type="hidden" name="<?php echo($csrf['name']); ?>" value="<?php echo($csrf['hash']); ?>" />

				<div class="error-message">
					<?php echo($message); ?>
				</div>

				<div class="input-container">
					<i class="ion-ios-person icon"></i>
					<input name="first-name" type="text" value="<?php echo(set_value('first-name')); ?>" placeholder="Enter First Name" class="input-field" required/>
				</div>
				<div class="error">
					<?php echo form_error('first-name', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>
				<div class="input-container">	
					<i class="ion-ios-person-outline icon"></i>
					<input name="last-name" type="text" value="<?php echo(set_value('last-name')); ?>" placeholder="Enter Last Name" class="input-field" required/>
				</div>
				<div class="error">
					<?php echo form_error('last-name', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>
				<div class="input-container">
					<i class="ion-ios-email-outline icon"></i>
					<input name="email" type="email" value="<?php echo(set_value('email')); ?>" placeholder="Enter Email Address" class="input-field" required/>
				</div>
				<div class="error">
					<?php echo form_error('email', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>
				<div class="input-container">
					<i class="ion-ios-locked-outline icon"></i>
					<input name="password" type="password" placeholder="Enter Password" class="input-field" required/>
				</div>
				<div class="error">
					<?php echo form_error('password', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>

				<p class="heading">Date of barth</p>

				<div class="input-container">
					<i class="ion-android-calendar icon"></i>
					<input name="dob" type="date" value="<?php echo(set_value('dob')); ?>" class="input-field" required/>
				</div>
				<div class="error">
					<?php echo form_error('dob', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>

				<div class="option-container">
					<p class="heading">Gender</p>
					<select name="gender" required>
						<option value="m">Male</option>
						<option value="f">Female</option>
						<option value="o">Other</option>
					</select>
				</div>
				<div class="error">
					<?php echo form_error('gender', '<p><i class="ion-alert-circled"></i> ', '</p>'); ?>
				</div>
				<div class="permission">
					<p>By tapping sign up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a> You may receive email from us and can opt out at any time.</p>
				</div>
				<button type="submit" name="submit" class="btn">Signup</button>
			</form>
			<div class="widget-1 row">
				<div class="col-6">
					<?php echo(anchor('signin', 'Already have an account?')); ?>
				</div>
				<div class="col-6 text-right">
					<?php echo(anchor('help', 'Help Center')); ?>
				</div>
			</div>
		</div>
	</div>
</div>