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

<?php echo(link_tag('assets/bootstrap/css/bootstrap.min.css')); ?>

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
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Activation Succesfull!</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3 pl-4 pt-2 text-center">
							<div class="display-1 pr-2 text-success">
								<i class="ion ion-ios-checkmark-outline"></i>
							</div>
						</div>
						<div class="col-md-9">
							<div class="h5 card-title">Congratilion!</div>
							<div class="card-text">
								<p>Your email address is varify fuccesfull!</p>
								<?php echo(anchor('signin', 'Click to Signin', array('class'=>'card-link'))); ?>.
								<br><br>
								Thank You.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>