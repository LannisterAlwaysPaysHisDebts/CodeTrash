<?php
/**
 * 疯狂猜字谜 -- 采集题库
 * http://wap.cmiyu.com/njmy/my121.html
 */

if (php_sapi_name() != 'cli') {
    exit('cron must run in cli mode!');
}

set_time_limit(0);
ini_set('memory_limit', '2048M');

require dirname(__DIR__) . '/common.inc.php';

// 加载QueryList
require BASEPATH_LIBRARY . 'util/QueryList/vendor/autoload.php';

class spider extends \lib\core\Action
{
    private $_header = '
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.9,en;q=0.8,es;q=0.7,zh-TW;q=0.6
Cache-Control: no-cache
Connection: keep-alive
Host: wap.cmiyu.com
Pragma: no-cache
Referer: http://wap.cmiyu.com/njmy/my1251.html
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Mobile Safari/537.36
    ';

    public function doDefault()
    {
        $list_path = ROOT_PATH . 'test/fkczm/list.txt';
        if (file_exists($list_path)) {
            $list_data = json_decode(file_get_contents($list_path), true);
        } else {
            // 采集列表
            $list_data = $this->_curlList();
            file_put_contents($list_path, json_encode($list_data));
        }

        // 采集详情页面
        $data = $this->_curlDetail($list_data);

        // 生成配置文件
        $str_res = var_export($data, true);

        $tpl = "
<?php
/**
 * 疯狂猜字谜
 *
 * @author 李小刚 <lixiaogang1113@gmail.com>
 */
 
// 标题&题目&答案&小贴士
return {$str_res};
";

        file_put_contents(ROOT_PATH . 'test/fkczm/new_fkczm_cfg.php', $tpl);
        die('执行完成');
    }

    /**
     * @return array
     */
    private function _curlList()
    {
        $return = [];

        $list_page_url = 'http://wap.cmiyu.com/zmmy/%s';

        $loop = 1;
        $list_id = 'my131.html';
        do {
            $url = sprintf($list_page_url, $list_id);

            // {{{ 连续采集 10次
            $list_page = 1;
            do {
                $result = [];
                $content = \lib\util\Proxy::get($url, $this->_header);
                if (!empty($content)) {
                    $content = iconv('gbk', 'utf-8', $content);
                    $result = \QL\QueryList::Query($content, [
                        'url' => ['.new dl dd ul li a', 'href'],
                        'next_page' => ['.page ul li a', 'href'],
                        'next_page_text' => ['.page ul li a', 'text'],
                    ])->data;
                }

                $list_page++;
            } while (empty($result) && $list_page <= 10);
            // }}}

            if (empty($result)) {
                die("列表采集失败 ==> 第{$loop}页， url ==> {$url}");
            }

            // 获取下列表页面的id
            $new_list_id = '';
            foreach ($result as $item) {
                if ($item['next_page_text'] == $loop + 1) {
                    if (empty($item['next_page'])) {
                        die("列表采集失败 ==> 第{$loop}页， url ==> {$url} next_page 获取失败1");
                    }

                    $new_list_id = trim($item['next_page']);
                }

                $return[$list_id][] = $item['url'];
            }

            if (empty($new_list_id)) {
                die("列表采集失败 ==> 第{$loop}页， url ==> {$url} next_page 获取失败2");
            }
            $list_id = $new_list_id;

            echo "列表第{$loop}页数据采集完成\n\r";

            $loop++;
        } while ($loop < 244);

        return $return;
    }

    private function _curlDetail($list_data)
    {
        $return = [];

        // 断点继续
        $detail_path = ROOT_PATH . 'test/fkczm/detail.txt';
        if (file_exists($detail_path)) {
            $detail_cache = json_decode(file_get_contents($detail_path), true);
            if (!empty($detail_cache) && !empty($detail_cache['loop_key'])) {
                foreach ($list_data as $key => $value) {
                    if ($key != $detail_cache['loop_key']) {
                        unset($list_data[$key]);
                    } else { // 终止跳出
                        unset($list_data[$key]);
                        break;
                    }
                }
            }
        }

        $detail_url = 'http://wap.cmiyu.com%s';
        foreach ($list_data as $loop_key => $items) {
            foreach ($items as $item) {
                $url = sprintf($detail_url, $item);

                // {{{ 连续采集 10次
                $detail_page = 1;
                do {
                    $result = [];
                    $content = \lib\util\Proxy::get($url, $this->_header);
                    if (!empty($content)) {
                        $content = iconv('gbk', 'utf-8', $content);
                        $result = \QL\QueryList::Query($content, [
                            'Tip' => ['.new dl .xts', 'text', '', function($temp) {
                                return strtr(trim($temp), ['&' => '']);
                            }],
                            'Question' => ['.new dl dd header h3', 'text', '', function($temp) {
                                return strtr(trim($temp), ['谜面：' => '', '&' => '']);
                            }],
                            'Answer' => ['.new dl dd article h3', 'text', '', function($temp) {
                                return strtr(trim($temp), ['谜底：' => '', '&' => '']);
                            }],
                        ])->data;

                        empty($result) && $result = [];
                    }

                    $detail_page++;
                } while (empty($result[0]['Question']) && $detail_page <= 10);
                // }}}

                if (empty($result)) {
                    echo "详情页面采集失败 ==> url ==> {$url}\n\r";
                    continue;
                }

                $result = $result[0];
                if (empty($result['Question']) || empty($result['Tip']) || mb_strlen($result['Answer']) != 1) {
                    echo "不符合要求, 跳过... ==> Question ==> {$result['Question']}, Tip ==> {$result['Tip']}, Answer ==> {$result['Answer']}\n\r";
                    continue;
                }

                $return[$item] = [
                    'Question' => trim($result['Question']),
                    'Answer' => trim($result['Answer']),
                    'Tip' => trim($result['Tip']),
                ];

                echo "详情页面采集成功 ==> {$url} \n\r";
            }

            // 一页数据写一次
            $return['loop_key'] = $loop_key;
            file_put_contents($detail_path, json_encode($return));
            echo "写入缓存中... ==> {$loop_key}";
        }

        return $return;
    }
}

$app->run();
