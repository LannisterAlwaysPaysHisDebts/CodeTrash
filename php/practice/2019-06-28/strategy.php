<?php
/**
 * 策略模式实现会员功能
 *
 *
 */


interface Member
{
    /**
     * 会员资格: 普通会员
     */
    const MEMBERSHIP_LEVEL_ORDINARY = 1;

    /**
     * 会员资格: 超级会员
     */
    const MEMBERSHIP_LEVER_NOBLE = 2;

    /**
     * 根据原始佣金获取用户的返利佣金
     * @param $originalCommission
     * @return float
     */
    public function getCommission($originalCommission);
}

class OrdinaryMember implements Member
{
    protected $userId;
    protected $memberLevel;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->memberLevel = self::MEMBERSHIP_LEVEL_ORDINARY;
    }

    public function getCommission($originalCommission)
    {
        // todo: 普通会员的返利
    }
}

class NobleMember implements Member
{
    protected $userId;
    protected $memberLevel;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->memberLevel = self::MEMBERSHIP_LEVER_NOBLE;
    }

    public function getCommission($originalCommission)
    {
        if ($this->isFistOrder()) {
            $commission = $this->firstOrderCommission($originalCommission);
        } else {
            $commission = $this->orderCommission($originalCommission);
        }
        return floatval($commission);
    }

    /**
     * 是否是成为超级会员之后的首单
     * @return bool
     */
    public function isFistOrder()
    {
        return true;
    }

    /**
     * 超级会员首单金额
     * @param $originalCommission
     */
    protected function firstOrderCommission($originalCommission)
    {
    }

    /**
     * 超级会员正常订单的返利金额
     * @param $originalCommission
     */
    protected function orderCommission($originalCommission)
    {
    }
}

class User
{
    protected $memberStrategy;

    public function __construct($userId)
    {
        // 初始化用户会员资格
        switch ($this->getUserMembershipLevel($userId)) {
            case Member::MEMBERSHIP_LEVER_NOBLE:
                $this->memberStrategy = new NobleMember($userId);
                break;
            case Member::MEMBERSHIP_LEVEL_ORDINARY:
            default:
                $this->memberStrategy = new OrdinaryMember($userId);
                break;
        }
    }

    public function getMemberInstance()
    {
        return $this->memberStrategy;
    }

    /**
     * 根据用户id获取用户会员资格等级
     * @param $userId
     * @return int
     */
    public function getUserMembershipLevel($userId)
    {
        // todo: 判断用户属于哪种类型会员的逻辑 => 可能是直接读数据库 亦或是 某一段判断逻辑
        $level = 1;
        return $level;
    }
}


// 某端业务逻辑
$userId = 10070;
$commission = 1.14;

$userObj = new User($userId);
$res = $userObj->getMemberInstance()->getCommission($commission);
var_dump($res);



