<?php
$asset = $view->helper('Asset');

// If page title has been set by sub-template
if($pageTitle = $view->head()->title()) {
	$title = $pageTitle;
} else {
	$title = "Alloy Framework App";
  $pageTitle = "Page Title";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Styles -->
    <?php echo $asset->stylesheet('bootstrap.min.css'); ?>
    <?php echo $asset->stylesheet('bootstrap-responsive.min.css'); ?>

    <?php echo $asset->script('jquery.min.js'); ?>
    <?php echo $asset->script('bootstrap.min.js'); ?>
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>
    <div class="navbar">
      <div class="navbar-inner">
	<div class="container">
	  <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="#">MotionWeb</a>
	  <div class="nav-collapse collapse">
	    <ul class="nav">
	      <li class="active"><a href="/">Home</a></li>
	      <li><a href="events">Recent Events</a></li>
	    </ul>
	  </div>
	</div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="page-header">
            <h1><?php echo $pageTitle; ?></h1>
        </div>
        </div>
      </div>

        <div class="row">
        <div class="span12">
          <div class="content">
          
            <?php
            // Display errors
            if($errors = $view->errors()):
            ?>
            <div class="alert alert-error">
              <p><strong>Oops!</strong> There were some errors with your request:</p>
              <ul>
              <?php foreach($errors as $field => $fieldErrors): ?>
                <?php foreach($fieldErrors as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
              <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <?php
            // Display main content
            echo $content;
            ?>

          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Company <?php echo date('Y'); ?></p>
      </footer>
    </div>

    <!-- Javascripts -->


  </body>
</html>