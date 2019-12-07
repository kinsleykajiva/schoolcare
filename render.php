<?php include "includes/render-engine.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> <?php print $viewObject->pageTitle(); ?></title>

	<?php include "includes/include_css.php"; ?>
	<?php print $viewObject->loadModuleCSS(); ?>
</head>

<body>

<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="loader-track">
        <div class="loader-bar"></div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

		<?php include "includes/include_header.php"; ?>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                    <div class="pcoded-inner-navbar main-menu">


                        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div>
						<?php print  $viewObject->renderRenderLeftNavigationBar(); ?>


                    </div>
                </nav>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">


                                <div class="page-body">
                                    <div class="container">
										<?php $viewObject->setModuleCotentFile(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/include_js.php'; ?>
<?php print $viewObject->loadModuleJSS(); ?>
</body>

</html>
