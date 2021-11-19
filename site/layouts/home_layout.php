<?php ob_start(); ?>

    <div class="Banner">
        <img src="https://cdn.futura-sciences.com/buildsv6/images/wide1920/6/2/b/62b0677a23_129709_soleil-brille.jpg" alt="">
    </div>

    <?= $content; ?>
<?php
$content = ob_get_clean();
include("layouts/base_layout.php"); 