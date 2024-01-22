<?php $data = data('slider') ?>
<div class="revealer">
    <div class="c-slider" <?= reveal('L2R-mask') ?>>
        <div class="blue">
            <div class="b-back-mask" <?= reveal('L2R-mask', ['delay'=>0.4]) ?>>
                <img class="b-back" src="<?= img("rect.svg") ?>">
            </div>
            <div class="side">
                <h2 <?= reveal('R2L', ['delay'=>0.55]) ?>>
                    <?= $data['title'] ?>
                </h2>
                <div class="info-text">
                    <p class="_1" <?= reveal('R2L', ['delay'=>0.75]) ?>>
                        <?= $data['text-1'] ?>
                    </p>
                    <p class="_2" <?= reveal('R2L', ['delay'=>0.9]) ?>>
                        <span class="from">
                            <?= $data['text-2'] ?>
                        </span>
                        <span class="price">
                            <?= $data['text-3'] ?>
                        </span>
                    </p>
                    <p class="_3" <?= reveal('R2L', ['delay'=>0.75]) ?>>
                        <?= $data['text-4'] ?>
                    </p>
                    <p class="_4" <?= reveal('R2L', ['delay'=>1.05]) ?>>
                        <?= $data['text-5'] ?>
                    </p>
                </div>
                <div <?= reveal('D2U', ['delay'=>1.15]) ?>>
                    <?php comp('want') ?>
                </div>
            </div>
        </div>
        <div class="gray" <?= reveal('R2L',['delay'=>0.9]) ?>>
            <img src="<?= img("blue-c.png") ?>">
        </div>
    </div>
</div>

<?php if (false): ?>
<div class="s-points">
    <li>
        <ul> <img class="ic" src="<?= img("s-left.svg") ?>"></ul>
        <ul> <img class="ic" src="<?= img("active.svg") ?>"></ul>
        <ul> <img class="ic" src="<?= img("no-active.svg") ?>"></ul>
        <ul> <img class="ic" src="<?= img("no-active.svg") ?>"></ul>
        <ul> <img class="ic" src="<?= img("s-right.svg") ?>"></ul>
    </li>
</div>
<?php endif ?>
