<?php
/**
 * Created by alex
 * Date: 10/23/2016
 * Time: 3:43 PM
 */

namespace TkS;

class QrCode implements QrCodeInterface
{
    public $renderer;
    public $text;
    public $width;
    public $height;

    public function __construct($text, $width = 50, $height = 50)
    {
        $this->text = $text;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Defines qr renderer
     *
     * @param object $rendererObject
     */
    public function setRenderer($rendererObject)
    {
        $this->renderer = $rendererObject;
        $this->renderer->setText($this->text);
        $this->renderer->setWidth($this->width);
        $this->renderer->setHeight($this->height);
    }

    /**
     * Generates QR image code
     *
     * @return image
     */
    public function generate()
    {
        return $this->renderer->generate();
    }
}