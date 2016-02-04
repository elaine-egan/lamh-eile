<?php
?>
<p>Click a category fo filter projects:</p>
<?php

foreach ( $terms as $term ) {

?>
<button class="filter btn btn-default" data-filter=".<?= $term->slug; ?>"><?= $term->name; ?></button>
<?php

}

?>
<button class="filter btn btn-default" data-filter="all">Show All</button>
