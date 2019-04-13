<?php
/**
 * ORM实现UserInvite表的数据对象映射
 *
 *
 *  表结构
CREATE TABLE `UserInvite` (
`InviteId` int(11) NOT NULL AUTO_INCREMENT,
`MasterUserId` int(11) DEFAULT '0' COMMENT '师傅用户ID',
`AppUserId` int(11) DEFAULT '0' COMMENT '徒弟用户ID',
`CreateTime` datetime DEFAULT NULL COMMENT '邀请时间',
PRIMARY KEY (`InviteId`),
UNIQUE KEY `Idx_UserInvite_MUAU` (`MasterUserId`,`AppUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='邀请表';
 *
 *
 */

namespace Base\ORM;

use Base\Database\PDO;

class UserInvite
{
    public $db;

    public $inviteId;

    public $masterUserId;

    public $appUserId;

    public $createTime;

    /**
     * UserInvite constructor.
     * @param $inviteId
     */
    public function __construct($inviteId)
    {
        $this->inviteId = $inviteId;

        $this->db = new PDO();
        $this->db->connect('127.0.0.1', 'root', 'root', 'testdb');
        $res = $this->db->query("select * from UserInvite where $inviteId");
        $data = $res->fetch(\PDO::FETCH_ASSOC);

        $this->masterUserId = $data['MasterUserId'];
        $this->appUserId = $data['AppUserId'];
        $this->createTime = $data['CreateTime'];
    }

    public function __destruct()
    {
        $this->db->query("
update UserInvite 
set MasterUserId = '{$this->masterUserId}', 
AppUserId = '{$this->appUserId}', 
CreateTime='{$this->createTime}' ");
        $this->db->close();
    }
}