<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2018/6/7
 * Time: 下午5:28
 */
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use QL\QueryList;

function convToUtf8($str) {
    if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
        return  iconv("gbk","utf-8",$str);
    } else {
        return $str;
    }
}

$baseUrl = 'http://chengyu.t086.com/jielong/zuichang.html';
$baseExplain = 'http://chengyu.t086.com/';

$rules = [
    'Question' => ['#hx_content a', 'text'],
    'Url' => ['#hx_content a', 'href']
];

$ql = QueryList::getInstance();

$data = $ql->get($baseUrl)->rules($rules)->query()->getData();

$data = $data->all();

foreach ($data as $key => $item) {
    $data[$key]['Question'] = convToUtf8($item['Question']);
    $data[$key]['Url'] = $baseExplain . substr($item['Url'], 3);

}

$title = 'test';
$sheet = [
    '成语', '解释地址'
];

try{
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle($title);

    $objPHPExcel->getActiveSheet()->fromArray($sheet, NULL, 'A1');

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


