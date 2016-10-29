<?php
/**
 * Created alex
 * Date: 10/23/2016
 * Time: 3:44 PM
 */

namespace TkS\Generators;

interface RendererInterface
{
    public function setText($text);

    public function setWidth($width);

    public function setHeight($height);

    public function generate();
}
