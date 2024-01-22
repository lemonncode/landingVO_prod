<?php
$title = get('title');
$image_name = get('image-name', '');
?>
<h2 class="c-logos-title">
    <?= $title ?>
</h2>
<div class="c-logos">
    <?php for ($i=0; $i<2; $i++): ?>
    <div class="logos-slide" <?= reveal('L2R<>') ?>>

        <?php for ($j=1; $j<=8; $j++): ?>
        <div class="card-logo">
            <img src="<?= img("{$image_name}{$j}.png") ?>">
        </div>
        <?php endfor ?>

    </div>
    <?php endfor ?>
</div>
