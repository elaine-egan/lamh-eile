<?php
/**
 * When viewed on a phone, display a click to call button.
 * On a non phone device, show the phone number.
 */
?>
<span class="hidden-xs">
  <span class="phone-text non-click-phone"><h4><i class="fa fa-phone fa-fw fa-rotate-270"></i>&nbsp;<?php echo !empty( $prefix ) ? $prefix . ' ' : null; ?><?= $number; ?></h4></span>
</span>
<span class="hidden-sm hidden-md hidden-lg">
  <a href="tel:<?= $clickable_number; ?>" class="click-phone btn btn-default btn-lg">
    <span class="phone-text"><?= $button_text; ?></span>
    <i class="fa fa-phone fa-fw fa-rotate-270"></i>
  </a>
</span>
