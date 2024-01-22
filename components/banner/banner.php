<?php
$image = get('image');
$cta_comp = get('cta-comp');
$invert_order = get('invert-order');
$data_block = get('data-block');

$data = data($data_block);
?>
<div class="c-banner<?= $invert_order? ' is-inverted' : '' ?>">
    <h2 class="title" <?= reveal('D2U') ?>>
        <?= $data['head'] ?>
    </h2>

    <div class="inner">
        <div class="left">
            <h2 class="title"><?= $data['title'] ?></h2>
            <?php for ($i=1; $i <= 3; $i++): ?>
            <div class="line">
                <img class="ic" src="<?= img("_icono.svg") ?>" alt>
                <p><?= $data["text-$i"] ?></p>
            </div>
            <?php endfor ?>
            <?php comp($cta_comp) ?>
        </div>
        <div class="right">
            <img class="_D" src="<?= img("$image.png") ?>" alt>
            <img class="_M" src="<?= img("$image-m.png") ?>" alt>
        </div>
    </div>
</div>
