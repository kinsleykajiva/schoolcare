<?php include "includes/render-engine.php"; ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> <?php print $viewObject->pageTitle(); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<?php include "includes/include_css.php"; ?>
	<?php print $viewObject->loadModuleCSS(); ?>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Header Top Area -->
<?php include "includes/include_header.php"; ?>

<!-- End Header Top Area -->
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
							<li><a href="#">Home</a>
								<ul class="collapse dropdown-header-top">
									<li><a href="index.html">Dashboard One</a></li>
									<li><a href="index-2.html">Dashboard Two</a></li>
									<li><a href="index-3.html">Dashboard Three</a></li>
									<li><a href="index-4.html">Dashboard Four</a></li>
									<li><a href="analytics.html">Analytics</a></li>
									<li><a href="widgets.html">Widgets</a></li>
								</ul>
							</li>
							<li><a href="#">Email</a>
								<ul id="demoevent" class="collapse dropdown-header-top">
									<li><a href="inbox.html">Inbox</a></li>
									<li><a href="view-email.html">View Email</a></li>
									<li><a href="compose-email.html">Compose Email</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#democrou" href="#">Interface</a>
								<ul id="democrou" class="collapse dropdown-header-top">
									<li><a href="animations.html">Animations</a></li>
									<li><a href="google-map.html">Google Map</a></li>
									<li><a href="data-map.html">Data Maps</a></li>
									<li><a href="code-editor.html">Code Editor</a></li>
									<li><a href="image-cropper.html">Images Cropper</a></li>
									<li><a href="wizard.html">Wizard</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#demolibra" href="#">Charts</a>
								<ul id="demolibra" class="collapse dropdown-header-top">
									<li><a href="flot-charts.html">Flot Charts</a></li>
									<li><a href="bar-charts.html">Bar Charts</a></li>
									<li><a href="line-charts.html">Line Charts</a></li>
									<li><a href="area-charts.html">Area Charts</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#demodepart" href="#">Tables</a>
								<ul id="demodepart" class="collapse dropdown-header-top">
									<li><a href="normal-table.html">Normal Table</a></li>
									<li><a href="data-table.html">Data Table</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#demo" href="#">Forms</a>
								<ul id="demo" class="collapse dropdown-header-top">
									<li><a href="form-elements.html">Form Elements</a></li>
									<li><a href="form-components.html">Form Components</a></li>
									<li><a href="form-examples.html">Form Examples</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">App views</a>
								<ul id="Miscellaneousmob" class="collapse dropdown-header-top">
									<li><a href="notification.html">Notifications</a>
									</li>
									<li><a href="alert.html">Alerts</a>
									</li>
									<li><a href="modals.html">Modals</a>
									</li>
									<li><a href="buttons.html">Buttons</a>
									</li>
									<li><a href="tabs.html">Tabs</a>
									</li>
									<li><a href="accordion.html">Accordion</a>
									</li>
									<li><a href="dialog.html">Dialogs</a>
									</li>
									<li><a href="popovers.html">Popovers</a>
									</li>
									<li><a href="tooltips.html">Tooltips</a>
									</li>
									<li><a href="dropdown.html">Dropdowns</a>
									</li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages</a>
								<ul id="Pagemob" class="collapse dropdown-header-top">
									<li><a href="contact.html">Contact</a>
									</li>
									<li><a href="invoice.html">Invoice</a>
									</li>
									<li><a href="typography.html">Typography</a>
									</li>
									<li><a href="color.html">Color</a>
									</li>
									<li><a href="login-register.html">Login Register</a>
									</li>
									<li><a href="404.html">404 Page</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php print $viewObject->renderTitlesNavigationBar(); ?>

				<div class="tab-content custom-menu-content">
					<?php print $viewObject->renderLinksNavigationBar(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Main Menu area End-->
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="breadcomb-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="breadcomb-wp">
								<div class="breadcomb-icon">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="breadcomb-ctn">
									<h3>Module Page</h3>

								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
							<div class="breadcomb-report">
								<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn">
									<i class="notika-icon notika-sent"></i></button>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
<!-- content area start-->
<div class="container">
	<?php $viewObject->setModuleCotentFile(); ?>
</div>
<!-- content area End-->
<!-- Start Footer area-->
<?php require 'includes/include_footer.php'; ?>

<!-- End Footer area-->
<?php require 'includes/include_js.php'; ?>
<?php print $viewObject->loadModuleJSS(); ?>

</body>

</html>