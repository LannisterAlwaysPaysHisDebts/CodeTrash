<?php
/**
 * 汉字纠错题库解释遍历
 */
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$url = 'http://www.fangyanwang.cn/news/?762.html';

$rules = [
    'a' => ['#newsContent div', 'text']
];

function convToUtf8($str) {
    if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
        return  iconv("gbk","utf-8",$str);
    } else {
        return $str;
    }
}

$rules = [
    'a' => ['#newsContent', 'text']
];
$html = \QL\QueryList::get($url)->getHtml();
$html = convToUtf8($html);
var_dump($html);

die();


foreach($data as $key => $value) {
    if ($key == 0) {
        continue;
    }
    $content = $value['a'];
    $content = trim($content, '&#160; ');
    $data[$key]['a'] = convToUtf8($content);
}

$title = '台湾方言';

try{
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle($title);

    $objPHPExcel->getActiveSheet()->fromArray($data, NULL, 'A2');

    $objPHPExcel->getActiveSheet()
        ->setAutoFilter($objPHPExcel
            ->getActiveSheet()
            ->calculateWorksheetDimension());

    $objPHPExcel->setActiveSheetIndex(0);

    $exportFile = __DIR__ . '/' . $title . ".xlsx";
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($exportFile);
} catch (PHPExcel_Exception $e) {
    var_dump($e);
    die('生成失败');
}

exit('生成成功');