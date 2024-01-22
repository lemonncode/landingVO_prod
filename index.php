<?php
require __DIR__."/inc/builder.php";
launch([
    /* Options */
    'render_prod' => true,


    /* CSS */
    'css-head' => [
        'src/css/reveal.css',
        'src/css/global.css'
    ],
    'css-foot' => [
        'src/css/style.css'
    ],

    /* JS */
    'js-head' => [
        'https://code.jquery.com/jquery-3.7.0.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.3/swiper-bundle.min.js',
    ],
    'js-foot' => [
        'src/js/global.js',
        'src/js/reveal.js',
    ],
]);
