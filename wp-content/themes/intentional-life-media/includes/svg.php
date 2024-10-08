<?php
class SVG
{
    public function __call($name, $args)
    {
        $svgPath = get_stylesheet_directory() . '/assets/svg/' . DIRECTORY_SEPARATOR . $name . '.svg';

        if (file_exists($svgPath)) {
            return file_get_contents($svgPath);
        } else {
            throw new Exception("SVG not found: {$name}");
        }
    }
}