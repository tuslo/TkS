<?php
/**
 * Created by alex
 * Date: 10/23/2016
 * Time: 3:59 PM
 */

namespace TkS\Generators;

use TkS\Generators\RendererInterface;

class GoogleChartsRenderer implements RendererInterface
{

    private $cht = 'qr';
    private $width = 50;
    private $height = 50;
    private $chs = '50x50';
    private $chl = '';
    private $choe = 'UTF-8';
    private $baseUrl = 'https://chart.googleapis.com/chart';

    /**
     * Set up text for QR code
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->chl = $text;
    }

    /**
     * Set up width for QR code
     *
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Set up height for QR code
     *
     * @param string $height
     */
    public function setHeight($height)
    {
        $this->$height = $height;
    }

    /**
     * Builds request URL
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    public function generate()
    {
        $params = $this->getParams();
        $qrCode = $this->sendRequest($this->baseUrl, $params);
        return $this->prepareOutput($qrCode);

    }

    /**
     * Prepares image code for HTML output
     * @param mixed $data - image data
     * @return array of $params
     */
    public function prepareOutput($data)
    {
        return 'data:image/png;base64,' . base64_encode($data);
    }

    /**
     * Set ups generator params
     *
     * @return array of $params
     */
    public function getParams()
    {
        $params = [];
        $params['cht'] = $this->cht;
        $params['choe'] = $this->choe;
        if (!empty($this->width) && !empty($this->height)) {
            $params['chs'] = $this->width . 'x' . $this->height;
        } else {
            $params['chs'] = $this->chs;
        }
        if (!empty($this->text)) {
            $params['chl'] = $this->text;
        } else {
            $params['chl'] = $this->chl;
        }
        return $params;
    }


    /**
     * Builds request URL
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    public function buildUrl($uri = '', $params = [])
    {
        if (empty($params)) {
            $params = $this->getParams();
        }
        $queryString = http_build_query($params);
        if (!empty($uri)) {
            $res = $uri . '?' . $queryString;
        } else {
            $res = $this->baseUrl . '?' . $queryString;
        }
        return $res;
    }

    /**
     * Perform GET request
     *
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public function sendRequest($url = '', $params = [])
    {
        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request('GET', $url, ['query' => $params]);
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
        return $res->getBody();
    }
}