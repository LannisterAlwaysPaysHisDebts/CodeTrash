<?php
/**
 * excel 的处理代码
 *
 * 组件需求: composer安装 phpExcel
 *
 *
 */

// 需要引入composer
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

/**
 * 是否能使用: 可以直接使用
 *
 * 将一个二维数组输出到Excel
 *
 * @param string $title: excel sheet 标题名
 * @param array $data: 生成excel的二维数组
 * @param string $output: 输出的路径, "../test.xlsx"
 */
function output(string $title, array $data,string $output)
{
    try {
        $objPHPExcel = new PHPExcel();

        // 设置sheet页码
        $objPHPExcel->setActiveSheetIndex(0);

        // 设置sheet标题
        $objPHPExcel->getActiveSheet()->setTitle($title);

        // 将数组按照顺序写入表格,
        $objPHPExcel->getActiveSheet()->fromArray($data, NULL, 'A1');

        // 不知道干什么
        $autoFilter = $objPHPExcel->getActiveSheet()->calculateWorksheetDataDimension();
        $objPHPExcel->getActiveSheet()->setAutoFilter($autoFilter);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($output);

    } catch (PHPExcel_Exception $e) {

        // 返回错误
        exit('生成失败');
    }
}

/**
 * output测试代码
 */
//$testData = [   // 自己拼凑标题段落
//    [
//        '姓名',
//        '年龄',
//        '性别'
//    ],
//    [
//        '杰克马',
//        '56',
//        '男'
//    ],
//    [
//        '苏龙汪',
//        '35',
//        '男'
//    ],
//    [
//        '金星',
//        '38'
//    ]
//];
//output('Excel标题', $testData, __DIR__ . '/test.xlsx');// 注意output的格式是xlsx


/**
 * 是否能使用: 可以直接使用
 *
 * 读取一个excel, 返回一个二维数组
 *
 * @param string $path
 * @param int $pIndex
 * @return array
 *
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 *
 */
function load(string $path, int $pIndex = 0)
{
    $inputFileType = PHPExcel_IOFactory::identify($path);

    $reader = PHPExcel_IOFactory::createReader($inputFileType);

    $objExcel = $reader->load($path);

    $sheet = $objExcel->getSheet($pIndex);

    $highestRow = $sheet->getHighestRow();

    $highestColumn = $sheet->getHighestColumn();

    $outArray = [];
    for($row = 1; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray("A{$row}:{$highestColumn}{$row}", NULL, true, false);
        $outArray[] = $rowData[0];
    }

    return $outArray;
}

