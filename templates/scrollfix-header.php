<?php require_once( get_template_directory() . '/lib/nav.php' ); ?>
<header class="banner">
  <div class="container">
    <div class="brand-logo">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>">
        <img class="img-responsive" src="<?= get_template_directory_uri() . '/dist/images/home.svg'; ?>">
      </a>
    </div>
    <div class="brand-text">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a><br>
    </div>
    <p><?php bloginfo('description'); ?></p>
  </div>
</header>
<div id="sticky-nav-wrap">
  <header class="navbar navbar-default navbar-static-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> -->
      </div>

      <nav class="collapse navbar-collapse" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :

          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Carawebs\LamhEile\Nav\NavWalker(), 'menu_class' => 'nav navbar-nav']);

        endif;

        //wp_bootstrap_navwalker
        ?>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class="contact" href="mailto:#" title="Contact us by email"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Email</a>
          </li>
          <li>
            <a class="hidden-xs contact">
              <i class="glyphicon glyphicon-earphone"></i>&nbsp;087 111 2222
            </a>
            <span class="visible-xs hidden-sm hidden-md hidden-lg">
              <a class="contact" href="#"><i class="glyphicon glyphicon-earphone"></i> Click to Call</a>
            </span>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</div>
