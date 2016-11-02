<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body>

<header id="header">
	<div class="wrapper">
		<?php wp_nav_menu( array( 'theme_location' => 'lang-menu' ) ); ?>
        <ul class="lang-nav">
            <li class="active"><a href="#" class="active">sr</a></li>
            <li><a href="#">eng</a></li>
        </ul>
        <div class="searchbox-header">
            <input type="text" />
            <i class="icon-search"></i>
        </div>
        <a href="<?php echo site_url(); ?>" id="header-logo">
            <img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" srcset="<?php echo get_bloginfo('template_url'); ?>/images/logox2.png 2x" alt="Zent Magazine logo" />
        </a>
        <nav class="main-nav">
    		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
        </nav>

        <div id="mobile-menu">
	    	<div class="menu-wrapper">
	     	   <button class="hamburger">
	          		<ul>
	            		<li></li>
	                	<li></li>
	            	</ul>
	            </button>
	        </div>
        	<div id="menu">
	            <ul>
    				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
	            </ul>
	            <hr>
	            <ul class="lang-nav-mobile">
		            <li class="active"><a href="#" class="active">sr</a></li>
		            <li><a href="#">eng</a></li>
		        </ul>
		        <hr>
<!-- 		        <p>Pretraga:</p>
		        <input type="text"/> -->
	        </div>
        </div>

	</div>
</header>