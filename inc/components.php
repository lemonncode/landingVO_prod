<?php
function comp($component, $options = [])
{
    global $builder;
    global $comp_options;
    $comp_options = $options;
    if (!function_exists('get'))
    {
        function get($key, $default = false)
        {
            global $comp_options;
            $value = array_key_exists($key, $comp_options);
            if ($value) return $comp_options[$key];
            else return $default;
        }
    }
    $builder->register_component($component);
    $path = get_path("components/$component");
    require "$path/$component.php";
}

function swiper($filename)
{
    $path = get_path("src/swiper/$filename.json");
    $conf = htmlspecialchars(file_get_contents($path));
    return "data-config=\"$conf\"";
}
