<?php

class excel
{
    public function outputExcel($title, $data)
    {
        if (!is_array($data)) exit('参数错误');

        try {
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
            die('生成失败');
        }
    }
}
