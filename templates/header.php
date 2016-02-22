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
<header class="navbar navbar-default navbar-static-top navbar-shrink" role="banner">
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
        <li><a href="mailto:#" title="Contact us by email"><i class="glyphicon glyphicon-envelope"></i></a></li>
        <li><a href="../navbar-fixed-top/">Fixed top</a></li>
      </ul>
    </nav>
  </div>
</header>
