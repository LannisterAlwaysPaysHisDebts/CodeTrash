<?php
/**
 * PHP采集基类
 * 基于: QueryList
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class SpiderIsTooEasy
{
    private $targetUrl;

    private $ql;

    private $urlPool;

    public function __construct(string $url = null)
    {
        $this->targetUrl = $url;
        $this->ql = new \QL\QueryList();
    }

    public function spider($rules)
    {
        do{
            $this->targetUrl = array_shift($this->urlPool);
            $array[] = self::simpleCatch($rules);
        } while(empty($this->urlPool));

        return $array;
    }

    /**
     * 简单抓取例子
     *
     * @param $rules
     * @return array
     */
    public function simpleCatch(array $rules): array
    {
        $data = $this->ql->get($this->targetUrl)->rules($rules)->query()->getData();

        return $data->all();
    }

    /**
     * 设置地址池
     *
     * @param array $pool
     * @return bool
     */
    public function setUrlPool(array $pool)
    {
        $this->urlPool = $pool;
        return true;
    }

    /**
     * 改变目标地址
     * @param string $targetUrl
     * @return bool
     */
    public function changeTargetUrl(string $targetUrl)
    {
        $this->targetUrl = $targetUrl;
        return true;
    }
}