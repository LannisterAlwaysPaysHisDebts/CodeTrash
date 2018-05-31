<?php
/**
 * Author: caoting
 * Date: 16/04/2018
 */

class Gold
{
    const SIGN = 1;

    const ACT = 2;

    private static $_goldType = [
        self::SIGN => [
            'name' => '每日签到',
            'gold' => 500,
        ],
        self::ACT => [
            'name' => '活动奖励',
        ],
    ];

    /**
     *
     * 发送金币
     * @param int $type : 类型
     * @param int $userId : 用户ID
     * @param $itemId : 项目ID
     * @param array $extra : 扩展字段: 发送的金币数
     *
     * @return array
     */
    public static function sendGold($type, $userId, $itemId, $extra)
    {
        $type = intval($type);
        $userId = intval($userId);
        $itemId = trim($itemId);

        if ($userId < 1) {
            return ['Code' => 201, 'Msg' => '参数不合法'];
        }
        if (!isset(self::$_goldType[$type])) {
            return ['Code' => 201, 'Msg' => '类型不合法'];
        }

        switch ($type) {
            case self::SIGN:
                return self::_sendSign($userId, $itemId);

            case self::ACT:
                return self::_sendAct($userId, $itemId);
        }
    }


    private static function _sendSign($userId, $itemId)
    {
        return [];
    }

    private static function _sendAct($userId, $itemId)
    {
        return [];
    }
}