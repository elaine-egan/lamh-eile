<?php
/**
 * A HTML section with emphasis text and an optional call to action
 */
?>
<div class="lead text-center">
  <?= $content; ?>
  <div class="topspace">
    <?php
    Carawebs\Castleview\Display\Helpers::click_to_call();
    //include_once( get_template_directory() . '/partials/click-to-call.php' ); ?>
  </div>
</div>
