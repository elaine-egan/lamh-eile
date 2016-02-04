<?php
/**
 * Social Sharing Buttons
 */
?>
<div class="justified-social-container">
  <div class="social-sharing btn-group btn-group-justified">
    <a target="_blank" title="Share on Facebook" href="http://www.facebook.com/sharer/sharer.php?url=<?= the_permalink(); ?>" class="btn btn-default btn-md"><i class="fa fa-facebook"></i> </a>
    <a target="_blank" title="Share on Google+" href="https://plus.google.com/share?url=<?= the_permalink(); ?>" class="btn btn-default btn-md" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i> </a>
    <a target="_blank" title="Share on Twitter"href="https://twitter.com/intent/tweet?url=<?= the_permalink(); ?>&amp;text=<?= the_title(); ?>" class="btn btn-default btn-md"><i class="fa fa-twitter"></i> </a>
    <a target="_blank" title="Share on LinkedIn" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= the_permalink(); ?>&amp;title=<?= the_title(); ?>&amp;summary=&amp;source=" class="btn btn-default btn-md"><i class="fa fa-linkedin"></i> </a>
  </div>
</div>
