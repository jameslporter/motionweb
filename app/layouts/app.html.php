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

    <!-- HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Styles -->
    <?php //echo $asset->stylesheet('bootstrap.css'); ?>
    <?php //echo $asset->stylesheet('app.css'); ?>

  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="/assets/foundation/stylesheets/foundation.min.css">
  <link rel="stylesheet" href="/assets/foundation/stylesheets/app.css">

  <script src="/assets/foundation/javascripts/modernizr.foundation.js"></script>
  <script src="/assets/foundation/javascripts/jquery.js"></script>
  <script src="/assets/foundation/javascripts/jquery.foundation.topbar.js"></script>
<script>$(document).foundationTopBar();</script>
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <div class="container">

<nav class="top-bar">
  <ul>
    <li class="name"><h1><a href="/">Home</a></h1></li>
    <li class="toggle-topbar"><a href="#"></a></li>
  </ul>
  <section>
    <ul class="left">
      <li><a href="/events">events</a></li>
    </ul>

  </section>
</nav>

      <div class="content twelve columns">
	<div class="row">
          <h1 class="twelve columns"><?php echo $pageTitle; ?></h1>
	</div>
        <div class="row">
            <?php
            // Display errors
            if($errors = $view->errors()):
            ?>
            <div class="alert-message block-message error">
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

      <footer class="twelve columns">
        <p><a href="/">Home</a></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
