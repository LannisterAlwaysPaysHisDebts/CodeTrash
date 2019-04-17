<?php
/**
 * 二维码的生成与识别
 *
 * Base on:
 *      QrCode 生成二维码
 *      qrcode-detector-decoder 识别二维码
 *
 * composer:
 *      composer require khanamiryan/qrcode-detector-decoder
 *      composer require endroid/qrcode
 *
 */

namespace lib;

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Zxing\QrReader;
use Endroid\QrCode\QrCode as Qr;
use Endroid\QrCode\ErrorCorrectionLevel;

/**
 * Class qrCode
 * @package lib
 */
class qrCode
{
    /**
     * 创建二维码
     *
     * @param string $url
     * @param string $output
     * @param int $size
     */
    function createQr(string $url, string $output, int $size = 250): void
    {
        $qr = new Qr($url);
        $qr->setSize($size);

        $qr->setWriterByName('png');
        $qr->setMargin(1);
        $qr->setEncoding('UTF-8');
        $qr->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
        $qr->setValidateResult(false);
        $qr->writeFile($output);
    }

    /**
     * 读取二维码
     *
     * @param string $realPath
     * @return bool
     */
    function readQr(string $realPath): bool
    {
        if (!is_string($realPath) || !is_file($realPath)) {
            return false;
        }

        $qr = new QrReader($realPath);
        $text = $qr->text();

        return empty($text) ? false : $text;
    }
}