<!doctype html>
<html>
<head>
    <title><?php bloginfo( 'name' ); wp_title() ?></title>

    <?php wp_head(); ?>
</head>
<body>

<div id="wrapper">
    <div class="header-container">
        <div id="header" class="row">
            <div class="comp_name col-sm-6 col-md-6 col-lg-6 text-center" >
                <img src=<?php echo get_option('site_logo')?>>
            </div>
            <div id="head_tel" class="head_tel col-sm-6 col-md-6 col-lg-6 text-center">
                <p>Call us: <?php echo get_option('telephone')?></p>
            </div>
        </div>
        <div class="header_navigation row">
                <?php
                    if( has_nav_menu('header_menu') ) { ?>
                    <div class="header_menu list-inline col-xs-12 col-sm-7 col-sm-offset-1 col-md-7 col-md-offset-1 col-lg-7 col-lg-offset-1">
                       <?php wp_nav_menu(array('theme_location' => 'header_menu', 'container' => false)); ?>
                    </div>

                    <div class="header_login col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <ul>
                            <li><a href="#">Sign In</a></li>
                            /
                            <li><a href="#">Sign Up</a></li>
                        </ul>
                    </div>
                   <?php }
                   else{ ?>
                       <div class="header_login col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <ul>
                               <li><a href="#">Sign In</a></li>
                               /
                               <li><a href="#">Sign Up</a></li>
                           </ul>
                       </div>
                   <?php } ?>
        </div>
    </div>