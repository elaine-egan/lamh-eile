<footer class="content-info footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3"><?php do_action( 'carawebs_address' ); ?></div>
      <div class="col-md-6 col-md-offset-3">
        <?php echo Carawebs\LamhEile\Display\Contact::social_follow(); ?>
      </div>
    </div>
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>
