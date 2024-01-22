 <div class="benefits-cards" <?= reveal('D2U<>') ?>>
    <?php
    $data = data('benefits');
    $icons = ['financia', 'garantia', 'entrega'];
    foreach ($icons as $i => $icon):
        $i++;
    ?>
    <div class="cardd">
        <img class="vector" src="<?= img("$icon.svg") ?>" alt>
        <h3 class="c-title"><?= $data["title-$i"] ?></h3>
        <h4 class="subtitle"><?= $data["subtitle-$i"] ?></h4>
    </div>
    <?php
    endforeach;
    ?>
 </div>
