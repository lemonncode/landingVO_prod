<section id="slider" class="boxed">
    <?php comp('slider') ?>
</section>


<section id="show_vehicles" class="boxed">
    <?php $data = data('vehicles') ?>
    <div class="title">
        <h2 <?= reveal('D2U', ['delay' => 0.15]) ?>>
            <?= $data['title'] ?>
        </h2>
    </div>
    <div class="container-grid">
        <div class="car L" <?= reveal('L2R', ['delay' => 0.2]) ?>>
            <?php $data = data('vehicles') ?>
            <div class="info">
                <div class="text">
                    <h3><?= $data['renting']['title'] ?></h3>
                    <h4><?= $data['renting']['text'] ?></h4>
                </div>
                <?php comp('cta-r') ?>
            </div>
            <div class="pict">
                <img class="img-car" src="<?= img("coche-rent.png") ?>">
            </div>
        </div>

        <div class="car R" <?= reveal('R2L', ['delay' => 0.35]) ?>>
            <div class="info">
                <div class="text">
                    <h3><?= $data['coche']['title'] ?></h3>
                    <h4><?= $data['coche']['text'] ?></h4>
                </div>
                <?php comp('cta-o') ?>
            </div>
            <div class="pict">
                <img class="img-car" src="<?= img("coche-ocasion.png") ?>">
            </div>
        </div>

        <div class="bikes" <?= reveal('D2U') ?>>
            <div class="info">
                <h3><?= $data['motos']['title'] ?></h3>
                <h4><?= $data['motos']['text'] ?></h4>
                <?php comp('cta-m') ?>
            </div>
            <div class="pict">
                <div class="inner">
                    <div class="L">
                        <img src="<?= img("moto-1.png") ?>" alt>
                    </div>
                    <div class="R">
                        <img src="<?= img("moto-2.png") ?>" alt>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<?php $data = data('benefits') ?>
<section id="benefits">
    <div class="container">
        <div <?= reveal('D2U') ?>>
            <h2 class="head-title"><?= $data['title'] ?></h2>
        </div>
        <?php comp('benefits-cards') ?>
    </div>
</section>


<section id="renting">
    <div class="boxed" <?= reveal('L2R-mask') ?>>
        <?php comp('banner', [
            'image' => 'renting',
            'cta-comp' => 'cta-r',
            'data-block' => 'renting'
        ]) ?>
    </div>
    <?php comp('logos', [
        'title' => data('renting')['brands']
    ]) ?>
</section>

<div class="c-hr boxed">
    <div></div>
</div>

<section id="ocasion" class="boxed" <?= reveal('L2R-mask') ?>>
    <?php comp('banner', [
        'image' => 'ocasion',
        'cta-comp' => 'cta-o',
        'invert-order' => true,
        'data-block' => 'ocasion'
    ]) ?>
</section>


<section id="motos">
    <div class="boxed" <?= reveal('L2R-mask') ?>>
        <?php comp('banner', [
            'image' => 'motos',
            'cta-comp' => 'cta-m',
            'data-block' => 'motos'
        ]) ?>
    </div>
    <?php comp('logos', [
        'title' => data('motos')['brands'],
        'image-name' => 'm-'
    ]) ?>
</section>


<section id="legal">
    <?php $data = data('legal') ?>
    <p><?= $data['text-1'] ?></p>
    <p><?= $data['text-2'] ?></p>
</section>
