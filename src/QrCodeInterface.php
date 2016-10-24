<?php
/**
 * Created alex
 * Date: 10/23/2016
 * Time: 3:44 PM
 */

namespace TkS;

interface QrCodeInterface
{
    public function setRenderer($renderObject);

    public function generate();
}