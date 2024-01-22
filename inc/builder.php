<?php
require __DIR__."/fx.php";
require __DIR__."/components.php";

class Builder
{
    public static $langs = ['es', 'ca', 'en'];
    public $prod = false;
    public $current_lang;
    public $data;

    public $output_file;
    private $css = ['head' => [], 'foot' => []];
    private $js  = ['head' => [], 'foot' => []];
    private $components = [];

    public static function name() {
        return basename($_SERVER['DOCUMENT_ROOT']);
    }

    function __construct($lang, $options)
    {
        $this->current_lang = $lang;
        $this->data = json_decode(file_get_contents(get_path('src/data.json')), true);
        if (array_key_exists('css-head', $options)) $this->css['head'] = $options['css-head'];
        if (array_key_exists('css-foot', $options)) $this->css['foot'] = $options['css-foot'];
        if (array_key_exists('js-head', $options)) $this->js['head'] = $options['js-head'];
        if (array_key_exists('js-foot', $options)) $this->js['foot'] = $options['js-foot'];
    }

    public function register_component($component)
    {
        $already = array_key_exists($component, $this->components);
        if ($already) return;

        $path = get_path("components/$component");
        if (file_exists("$path/$component.css")) {
            $this->css['head'][] = "components/$component/$component.css";
        }
        if (file_exists("$path/$component.js")) {
            $this->js['head'][] = "components/$component/$component.js";
        }
        $this->components[$component] = true;
    }
    private function echo_css($position)
    {
        foreach($this->css[$position] as $filepath)
        {
            $path = get_path($filepath);
            echo file_get_contents($path);
        }
    }
    private function echo_js($position)
    {
        foreach($this->js[$position] as $filepath)
        {
            // Skip jQuery or Swiper in PROD, since Wivai already has it:
            if ($this->prod && strpos($filepath, 'jquery') !== false
            || $this->prod && strpos($filepath, 'swiper') !== false)
                continue;

            // If JS path is a URL, leave as is:
            if (strpos($filepath, '://') !== false) $path = $filepath;
            else $path = get_path($filepath);
            echo file_get_contents($path);
        }
    }

    public function get_data($key, $group)
    {
        if (array_key_exists($key, $this->data[$group]))
        {
            $value = $this->data[$group][$key];
            return $value;
        }
        else return false;
    }

    public function render_local()
    {
        $this->prod = false;
        ob_start();
        require get_path("src/template.php");
        $content = ob_get_clean();
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            @import url('https://fonts.cdnfonts.com/css/montserrat');
            body { margin: 0; background-color: #f2f2f3; }
            *, *::before, *::after { box-sizing: border-box; }
            <?php $this->echo_css('head') ?>
        </style>
        <script>
            <?php $this->echo_js('head') ?> 
            const carouselManager = {
                carousels: {},
                initCarousel: function()
                {
                    jQuery('.swiper-container').filter(function() {
                        return this.id && !carouselManager.carousels[this.id];
                    }).each(function(i, el) {
                        var config = {};
                        var value = $(el);
                        try {
                            if (value.attr('data-config') && value.attr('data-config') !== '') {
                                config = value.attr('data-config');
                            }
                            config = JSON.parse(config);
                        } catch (err) {}
                        carouselManager.carousels[this.id] = new Swiper(this,config);
                    });
                }
            }
            window.addEventListener('load', carouselManager.initCarousel);
        </script>

        <main id="maincontent">
            <?= $content ?>
            <style type="text/css">
                <?php $this->echo_css('foot') ?>
            </style>
            <script>
                <?php $this->echo_js('foot') ?>
            </script>
        </main><?php
    }

    public function render_prod()
    {
        $this->prod = true;
        ob_start();
        require get_path("src/template.php");
        $content = ob_get_clean();

        $this->output_file = fopen(get_path("out/{$this->current_lang}.html"), 'w');
        ob_start('save_buffer');
        
        $name = Builder::name();
        if (count($this->css['head']) > 0)
        {
            echo "<style id='$name-css-head' type='text/css'>\n";
                $this->echo_css('head');
            echo "\n</style>\n";
        }
        if (count($this->js['head']) > 0)
        {
            echo "<script id='$name-js-head' type='text/javascript'>\n";
                $this->echo_js('head');
            echo "\n</script>\n";
        }
        
        echo $content;

        if (count($this->css['foot']) > 0)
        {
            echo "\n<style id='$name-css-foot' type='text/css'>\n";
                $this->echo_css('foot');
            echo "\n</style>\n";
        }
        if (count($this->js['foot']) > 0)
        {
            echo "<script id='$name-js-foot' type='text/javascript'>\n";
                $this->echo_js('foot');
            echo "\n</script>";
        }
        ob_end_flush();
    }
}


function launch($options)
{
    function render_local_page($options)
    {
        // Get lang from URL:
        $lang = 'es';
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, '/ca') !== false) $lang = 'ca';
        if (strpos($url, '/en') !== false) $lang = 'en';
    
        global $builder;
        $builder = new Builder($lang, $options);
        $builder->render_local();
    }
    function output_prod_pages($options)
    {
        // Save all lang pages to disk:
        foreach (Builder::$langs as $lang)
        {
            global $builder;
            $builder = new Builder($lang, $options);
            $builder->render_prod();
        }
    }
    render_local_page($options);
    if ($options['render_prod']) output_prod_pages($options);
}
