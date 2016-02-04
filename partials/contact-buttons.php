<?php

?>
<h2>Contact Buttons</h2>
<?php if ( !empty( $email ) ): ?>
<span itemprop="email" class="social-icons btn btn-block">
  <a href="mailto:<?= $email; ?>" title="Email Us">Email Us&nbsp;<i class="fa fa-fw fa-envelope"></i></a>
</span>
<?php endif; ?>
<?php if ( !empty ( $twitter ) ): ?>
<a class="social-icons btn btn-block" href="<?= $twitter; ?>" title="Follow us on Twitter">Follow Us on Twitter&nbsp;<i class="fa fa-fw fa-twitter"></i></a>
<?php endif; ?>
<?php if ( !empty ( $facebook ) ): ?>
<a class="social-icons btn btn-block" href="<?= $facebook; ?>" title="Find us on Facebook">Find Us on Facebook&nbsp;<i class="fa fa-fw fa-facebook"></i></a>
<?php endif; ?>
<?php if ( !empty ( $landline ) ): ?>
<div class="social-icons btn btn-block nonclick-phone">
  <?= $landline; ?>&nbsp;<i class="fa fa-phone fa-fw fa-rotate-270"></i>
</div>
<?php endif; ?>
