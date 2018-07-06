<?php
//尝试抓取猜歌达人的歌曲库:

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class question
{
    static $token = 'd37ac78d0c96c96f90245a45164a79fc';

    static $user_id = '38739721';

    static $type = 'wechat_song';

    static $path = __DIR__ . '/data.txt';

    public function __construct()
    {
        
        
    }

    public function bot()
    {
        do{
            $question = $this->getQuestion();

            $data = implode($question, '&&&') . "\r";

            file_put_contents(self::$path, $data, FILE_APPEND);

            $answer = urlencode($question['question']);
            $sid = $question['sid'];

            $wait = rand(2, 3);

            $this->answer($answer, $sid);

            var_dump("回答完毕: 题目:" . $question['question']);

            sleep($wait);
        }while(1);
    }

    public function getQuestion()
    {
        $url = 'https://api.zuiqiangyingyu.net/index.php/api/guess_v2/Index';

        $whole = $url .
                '?token=' . self::$token .
                '&wechat_type=' . self::$type .
                '&user_id=' . self::$user_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $whole);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);

        if (empty($data)) {
            exit('获取失败');
        }

        $data = json_decode($data, true);

        $question = [
            'question' => $data['d']['list'][0]['answer'],
            'file1' => $data['d']['list'][0]['file'],
            'file2' => $data['d']['list'][0]['file2'],
            'sid' => $data['d']['list'][0]['id'],
        ];

        return $question;
    }

    public function answer($answer, $sid)
    {
        $url = 'https://api.zuiqiangyingyu.net/index.php/api/guess_v2/Sub';

        $whole = $url .
            '?token=' . self::$token .
            '&wechat_type=' . self::$type .
            '&user_id=' . self::$user_id .
            '&answer=' . $answer .
            '&sid=' . $sid;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $whole);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
    }

}



$f = new question();
$f->bot();