<?php
//疯狂猜歌名题目抓取

// url地址
$url = "https://fkcgm.5iape.com/Cgmindex/new_problem.html";

//保存的path地址
$path = __DIR__ . '/data/data.php';

// 拿到没有体力的的UserId
$error_user_ids = [];
$errorPath = __DIR__ . '/data/user_id.txt';
$handle = fopen($errorPath, 'r');
if($handle) {
    while(($buffer = fgets($handle, 4096)) !== false ) {
        $buffer = explode('_', $buffer);
        $error_user_ids[$buffer[0]] = $buffer[0];
    }
    if (!feof($handle)) {
        echo "error";
    }
    fclose($handle);
}

//初始化数组
$oldData = require __DIR__ . '/data/data.php';

// post请求, header设置uid和gameid
$user_id = 14220881;

for (; $user_id >= 10000000; $user_id--) {

    //跳过已经没体力的
    if (isset($error_user_ids[$user_id])){
        continue;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $header = ["uid: " . $user_id, 'gameid: ' . 1];
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $data = curl_exec($ch);
    
    curl_close($ch);
    
    // code: 200, code=> data => question 解析
    
    $data = json_decode($data, true);
    
    if ($data['code'] != 200) {
        //将用户id写入txt
        $error = $user_id . '_' . json_encode($data) . "\t\n";
        file_put_contents($errorPath, $error, FILE_APPEND);
        var_dump("请求失败: " . var_export($data, true));
        continue;
    }
    
    foreach($data['data']['question'] as $item) {
        $array = [
            'id' => $item['id'],
            'title' => $item['title'],
            'singer' => $item['singer'],
            'audio' => $item['audio'],
            'song' => $item['song'],
            'picture' => $item['picture']
        ];
    
        $oldData[$item['title']] = implode('&&&', $array);
    }
    
    $tpl = "<?php
    return " . var_export($oldData, true) . ';';
    file_put_contents($path, $tpl);

    var_dump('获取成功');

    $rand = rand(1000000, 9000000);
    usleep(rand);
}


