<?php
/**
 * config tools
 * 生成特定格式的配置文件(php/txt/excel)
 *
 * only in cli
 */

namespace configTool;

class contools
{
    private $ex;

    private $config = [];

    public function __construct()
    {
        $this->ex = new configException();

        if (!file_exists(__DIR__ . '/configConfig.php')) {
            $this->ex->getout(500, '初始化失败, 没有找到配置文件');
        }
        $this->config = require __DIR__ . '/configConfig.php';
    }

    /**
     * 检查
     *
     * @param array $data
     * @param int $checkLevel
     * @return array
     */
    private function check($data, $checkLevel = 1)
    {
        //diff检查



        return [];
    }

    /**
     * 保存
     *
     * @param $data
     * @param $filename
     * @param $type
     * @param $unlink = 0
     *
     * @return bool
     */
    private function save($data, $filename, $type, $unlink = 0)
    {
        if (empty($data) || empty($filename)) {
            $this->ex->getout(201, '参数不能为空');
        }

        switch ($type) {
            case 'php':
                if ($unlink && file_exists($filename)) {
                    unlink($filename);
                }

                $data = var_export($data, true) . ';';
                file_put_contents($filename, $this->config['SAVE_PHP_TPL']);
                file_put_contents($filename, $data, FILE_APPEND);
                break;
        }

        return true;
    }

    /**
     * 获取到xlsx文件的数据
     * @param $path
     */
    private function getXlsxData($path)
    {
        if (strpos($path, '.xlsx') === false) {
            $this->ex->getout(201, '只允许xlsx格式');
        }
        $csvPath = str_replace('.xlsx', '.csv', $path);

        if (file_exists($path)) {

        }

    }

    /**
     * xlsx转换csv
     *
     * @param $filePath
     * @return bool
     */
    private function xlsxToCsv($filePath)
    {
        $ext = explode('.', $filePath)[1];
        if (!empty($filePath) && $ext == 'xlsx' && file_exists($filePath)) {
            $csvPath = str_replace('.xlsx', '.csv', $filePath);
            try {
                $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
                $objWriter->save($csvPath);

                unlink($filePath);
            } catch (\Exception $e) {
                $this->ex->getout(201, $e->getMessage());
            }
            return true;
        }
        $this->ex->getout(201, '没有这个文件');
    }

}