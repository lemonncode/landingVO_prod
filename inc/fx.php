<?php
/* Page rendering */
function save_buffer($buffer)
{
  global $builder;
  fwrite($builder->output_file, $buffer);
}
function get_path($local_path)
{
    $local_path = $_SERVER['DOCUMENT_ROOT']."/$local_path";
    return $local_path;
}



/* Data */
function img($filename)
{
    global $builder;
    $filename = str_replace('{lang}', $builder->current_lang, $filename);
    if ($builder->prod)
    {
        $folder = Builder::name();
        return "landing/WIVAI/$folder/$filename?\$staticlink\$";
    }
    else return "/src/img/$filename";
}
function data($key, $default = 'Lorem ipsum')
{
    global $builder;
    /** Search order:
     * 1. Look for current_lang
     * 2. Look for shared data
     * 3. Look for ES
     * 4. Lore Ipsum
     */
    $order = [$builder->current_lang, 'shared', 'es'];
    foreach ($order as $group)
    {
        $data = $builder->get_data($key, $group);
        if ($data) return $data;
    }
    return $default;
}
function reveal($format, $args = [])
{
    $html = "data-reveal=\"$format\" data-state=\"off\"";
    foreach ($args as $key => $value) $html .= " data-$key=\"$value\"";
    return $html;
}
