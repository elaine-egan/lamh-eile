<?php
/**
 * When viewed on a phone, display a click to call button.
 * On a non phone device, show the phone number.
 */
?>
<span class="hidden-xs">
  <span class="btn btn-default<?= $btn_class; ?>"><i class="glyphicon glyphicon-phone"></i>&nbsp;<?php echo !empty( $prefix ) ? $prefix . ' ' : null; ?><?= $number; ?></span>
</span>
<span class="hidden-sm hidden-md hidden-lg">
  <a href="tel:<?= $clickable_number; ?>" class="click-phone btn btn-default<?= $btn_class; ?>">
    <span class="phone-text"><?= $button_text; ?></span>
    <i class="glyphicon glyphicon-phone"></i>
  </a>
</span>
