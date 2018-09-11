<?php
/**
 * 抓成语
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class zmSpider
{
    CONST BASE_URL = 'http://www.tom61.com/caimiyu/naojinjizhuanwan/index_%s.html';

    const PATH = __DIR__ . "/data/zm_%s.php";

    const LOG_PATH = __DIR__ . '/data/log.txt';

    private $ql;

    public function __construct()
    {
        $this->ql = new \QL\QueryList();
    }

    public function getData()
    {
        for ($page = 2; $page <= 84; $page++) {
            $res = $this->_getData($page);
            if ($res) {
                file_put_contents(self::LOG_PATH, "采集成功, page:{$page} \n");
                echo "采集成功, page:{$page} \n";
            }
            sleep(1);
        }

        exit('采集完毕');
    }

    private function _getData($page)
    {
        $url = sprintf(self::BASE_URL, $page);

        $rule = [
            'data' => ['#Mhead2_0 .t_lbmy span', 'html'],
        ];


        $data = $this->ql->get($url)->rules($rule)->query()->getData();

        $data = $data->all();

        $tpl = "<?php
return " . var_export($data, true) . ';';
        $path = sprintf(self::PATH, $page);
        file_put_contents($path, $tpl);

        return true;
    }

    public function parseData()
    {
        for ($page = 2; $page <= 84; $page++) {
            $res = $this->_parsePage($page);


        }
    }

    public function _parsePage($page)
    {
        $file_path = sprintf(self::PATH, $page);
        if (!file_exists($file_path)) {
            return false;
        }

        $data = require $file_path;

        $saveData = [];
        foreach ($data as $key => $value) {
            $source = $value['data'];

            $res = $this->_parseData($source);

            if (empty($res[0]) || empty($res[1])) {
                return false;
            }

            $saveData[] = implode("&&&", $res);
        }


        return [];
    }

    private function _parseData(string $string)
    {
        $str = strip_tags($string);
        $str = trim(explode('谜面：', $str)[1]);

        $explode = explode('谜底：', $str);
        $question = trim($explode[0]);
        $answer = trim(mb_substr($explode[1], 0, mb_strpos($explode[1], '查看答案')));

        return [$question, $answer];
    }
}

$obj = new zmSpider();
$obj->_parsePage(2);