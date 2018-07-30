<?php

/**
 * PDO数据库连接
 *
 * @package lib
 * @subpackage plugins.pdo
 * @author 苏宁 <snsnky@126.com>
 *
 * $Id: PDOQuery.class.php 2 2014-02-19 09:52:07Z suning $
 */

namespace lib\plugins\pdo;

use \PDO;
use \PDOStatement;
use \PDOException;

class PDOQuery extends PDO
{
    /**
     * DSN 连接信息
     * 
     * @var string
     */
    private $_dsn;
    
    /**
     * 数据库 用户名
     * 
     * @var string
     */
    private $_user;
    
    /**
     * 数据库 密码
     * 
     * @var string
     */
    private $_pwd;
    
    /**
     * PDO 集
     * 
     * @var PDOStatement
     */
    private $_statement = null;
    
    /**
     * 默认选项
     * @var array
     */
    private $_opt = array(
        // 字符集
        'charset' => 'utf8mb4',
        // 长连接
        'persistent' => false,
        // 结果集方式
        'fetchMode' => parent::FETCH_ASSOC,
        // 异常方式
        'errorMode' => parent::ERRMODE_WARNING
    );

    private $_chained = array(
        'fields' => '*',
        'table'  => '',
        'order'  => null,
        'limit'  => null,
        'where'  => '',
        'index'  => null,
        'bind'   => array()
    );
    
    /**
     * 构造函数
     * 
     * @param array $params        配置信息
     * @param array $options    选项, @see self::$_opt
     */
    public function __construct($params, $options)
    {
        if (is_array($options))
        {
            $this->_opt = array_merge($this->_opt, $options);
        }
        
        $params['port'] = empty($params['port']) ? 3306 : $params['port'];
        
        $this->_dsn = $params['driver'] . ':dbname=' . $params['name'] . ';host=' . $params['host']. ';port=' . $params['port'] . ';charset=' . $this->_opt['charset'];
        $this->_user = $params['user'];
        $this->_pwd = $params['password'];
        
        $opt = [
            parent::ATTR_PERSISTENT => $this->_opt['persistent'],
        ];
        
        parent::__construct($this->_dsn, $this->_user, $this->_pwd, $opt);
        $this->setAttribute(\PDO::ATTR_ERRMODE, $this->_opt['errorMode']);
    }
    
    /**
     * 关闭连接并销毁此对象
     */
    public function close()
    {
        $this->_statement = null;
    }
    
    /**
     *
     * @see PDO::prepare()
     *
     * @param string $statement
     * @param array $driver_options
     * @return PDOStatement
     */
    public function prepare($statement, $driver_options = array())
    {
        $this->_statement = parent::prepare($statement, $driver_options);
        $this->_statement->setFetchMode($this->_opt['fetchMode']);
        return $this->_statement;
    }
    
    /**
     * @see PDO::query()
     *
     * @param string $statement
     * @return PDOStatement
     */
    public function query($statement)
    {
        $this->_statement = parent::query($statement);
        $this->_statement->setFetchMode($this->_opt['fetchMode']);
        return $this->_statement;
    }

    /**
     * SELECT 语句的快捷方式
     *
     * @param string    $tableName    表名
     * @param array     $where        WHERE 条件数组，仅支持 AND 连接
     * @param string    $fields       要查询的字段，半角逗号分隔，如：field1, field2
     * @param string    $order        排序方法，如：someField DESC
     * @param int|array $limit        限制条数，可以是单个数字或者 array($offset, $num) 格式的数组
     * @return mixed
     */
    public function find($tableName, $where=array(), $fields='*', $order=null, $limit=null)
    {
        $tableName = str_replace(array('`','.'), array('','`.`'), $tableName);
        $bindVals  = array();
        if (is_string($where) && !empty($where))
            $_where = 'WHERE '.$where;
        elseif (is_array($where) && !empty($where))
            $_where = 'WHERE '. implode(' AND ', $this->_parseWhere($where, $bindVals));
        else
            $_where = '';
        $_order    = is_null($order) ? '' : 'ORDER BY '.$order;
        if (is_numeric($limit))
            $_limit = 'LIMIT '.intval($limit);
        elseif (is_array($limit) && count($limit) == 2)
            $_limit = sprintf('LIMIT %s, %s', $limit[0], $limit[1]);
        else
            $_limit = '';

        $sql = sprintf("SELECT %s FROM `%s` %s %s %s", $fields, $tableName, $_where, $_order, $_limit);
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement)) return false;
        $res   = $query->execute($bindVals);
        if ($res !== true) return false;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 链式查询 - 选择字段
     *
     * @param string $fields 字段列表
     * @return $this
     */
    public function select($fields)
    {
        if (!is_array($fields))
            $fields = explode(',', $fields);
        foreach ($fields as &$field)
        {
            $field = trim($field);
            if (preg_match('/^[a-zA-Z0-9_]+$/', $field))
                $field = '`'.$field.'`';
        }
        unset($field);
        $this->_chained['fields'] = implode(',', $fields);
        return $this;
    }

    /**
     * 链式查询 - 选择表名
     *
     * @param string $tableName 表名
     * @return $this
     */
    public function from($tableName)
    {
        $this->_chained['table'] = str_replace(
            array('`','.'),
            array('','`.`'),
            $tableName
        );
        return $this;
    }

    /**
     * 链式查询 - 指定查询条件
     *
     * @param array $where 查询条件
     * @return $this
     */
    public function where($where)
    {
        if (is_string($where))
            $this->_chained['where'] = 'WHERE '.$where;
        elseif (is_array($where) && !empty($where))
            $this->_chained['where'] = 'WHERE '. implode(' AND ', $this->_parseWhere($where, $this->_chained['bind']));
        else
            $this->_chained['where'] = '';
        return $this;
    }

    /**
     * 链式查询 - 指定排序方法
     *
     * @param string $order 排序方法
     * @return $this
     */
    public function order($order)
    {
        $this->_chained['order'] = $order;
        return $this;
    }

    /**
     * 链式查询 - 指定 LIMIT 参数
     *
     * @param mixed   $offset  LIMIT 第一个参数，也可以写成 array($offset, $num) 以省略第二个参数
     * @param integer $num     LIMIT 第二个参数
     * @return $this
     */
    public function limit($offset, $num=null)
    {
        $limit = is_null($num) ? $offset : array($offset, $num);
        if (is_numeric($limit))
            $this->_chained['limit'] = intval($limit);
        elseif (is_array($limit) && count($limit) == 2)
            $this->_chained['limit'] = implode(',', $limit);
        return $this;
    }

    /**
     * 链式查询 - 指定索字段
     *
     * @param mixed $index 字段名，或者字段序号
     * @return $this
     */
    public function indexBy($index)
    {
        $this->_chained['index'] = $index;
        return $this;
    }

    /**
     * 链式查询 - 获取结果集
     *
     * @param int $style 记录格式，PDO::FETCH_*
     * @param int $arg 与 $style 对应的参数，目前只有 PDO::FETCH_COLUMN 需要
     * @return array|bool
     */
    public function getAll($style=PDO::FETCH_ASSOC, $arg=null)
    {
        $opt = $this->_chained;
        $sql = sprintf("SELECT %s FROM `%s` %s %s %s",
            $opt['fields'],
            $opt['table'],
            $opt['where'],
            is_null($opt['order']) ? '' : 'ORDER BY '.$opt['order'],
            is_null($opt['limit']) ? '' : 'LIMIT '.$opt['limit']
        );
        $query = $this->prepare($sql);

        if (!($query instanceof PDOStatement)) return false;
        $res   = $query->execute($opt['bind']);
        if ($res !== true) return false;

        $index = $opt['index'];
        $data  = ($style == PDO::FETCH_COLUMN)
            ? $query->fetchAll($style, $arg)
            : $query->fetchAll($style);

        if (empty($data))
            return array();

        if (is_null($index))
            return $data;
        else
        {
            $ret = array();
            if (is_int($index))
            {
                $fields = ($opt['fields'] == '*')
                    ? array_keys($data[0])
                    : explode(',', $opt['fields']);
                $field  = $fields[$index];
            }
            else
                $field = $index;

            foreach ($data as $row)
                $ret[$row[$field]] = $row;

            return $ret;
        }
    }

    /**
     * 链式查询 - 获取第一条数据
     *
     * @param int $style 记录格式，PDO::FETCH_*
     * @return null
     */
    public function getOne($style=PDO::FETCH_ASSOC)
    {
        $res = $this->limit('1')->indexBy(null)->getAll($style);
        return (is_array($res) && !empty($res)) ? $res[0] : null;
    }

    /**
     * 链式查询 - 获取第一条数据的第一个字段值
     *
     * @return null
     */
    public function getValue()
    {
        $res = $this->getOne(PDO::FETCH_NUM);
        return is_array($res) ? $res[0] : null;
    }

    /**
     * 链式查询 - 获取某列数据
     *
     * @param int $col
     * @return array|bool
     */
    public function getColumn($col=0)
    {
        $index = $this->_chained['index'];
        if (is_null($index) && is_numeric($col))
            return $this->getAll(PDO::FETCH_COLUMN, intval($col));

        $ret  = array();
        $data = $this->getAll(PDO::FETCH_BOTH);
        if (is_null($index))
        {
            foreach ($data as $row)
                $ret[] = $row[$col];
        }
        else
        {
            foreach ($data as $row)
                $ret[$row[$index]] = $row[$col];
        }

        return $ret;
    }

    /**
     * 链式查询 - 重置查询参数
     */
    public function clear()
    {
        $this->_chained = array(
            'fields' => '*',
            'table'  => '',
            'order'  => null,
            'limit'  => null,
            'where'  => '',
            'index'  => null,
            'bind'   => array()
        );
        return $this;
    }

    /**
     * INSERT 语句的快捷方式
     *
     * @param string $tableName 表名
     * @param array  $row       要写入的数组
     * @param array  $options   (可选) INSERT 选项，目前只支持 ignore
     * @return bool|int         成功则返回lastInsertId 或者 0[ignore插入时]，失败则返回 false
     */
    public function insert($tableName, $row, $options=array())
    {
        // 表名
        $tableName = str_replace(array('`','.'), array('','`.`'), $tableName);
        // 带`的字段名称列表
        $fields = array();
        // INSERT 选项
        $option = '';
        if (isset($options['ignore']) && $options['ignore'] == true)
        {
            $option = 'IGNORE';
        }
        // 绑定数据
        $bindVals = array();
        $bindKeys = array();
        foreach ($row as $key => $val)
        {
            $bindKeys[]        = ":$key";
            $fields[]          = "`{$key}`";
            $bindVals[":$key"] = $val;
        }

        $sql   = sprintf("INSERT %s INTO  `%s` (%s) VALUES (%s)", $option, $tableName, implode(', ', $fields), implode(', ', $bindKeys));
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement)) return false;
        $res   = $query->execute($bindVals);
        if ($res !== true) return false;

        // sql语句执行成功， 可能ignore 就没有lastInsertId
        $count = $query->rowCount();
        if ($count) {
            return $this->lastInsertId();
        } else {
            return 0;
        }
    }

    /**
     * 批量 INSERT 语句的快捷方式
     *
     * @param string $tableName     表名
     * @param array  $rows          要写入的多维数组
     * @param array  $options       (可选) INSERT 选项，目前只支持 ignore
     *
     * @return bool|int             成功受影响的行数，失败则返回 false
     */
    public function batchInsert($tableName, $rows, $options = [])
    {
        // 表名
        $tableName = str_replace(['`', '.'], ['', '`.`'], $tableName);

        // INSERT 选项
        $option = '';
        if (isset($options['ignore']) && $options['ignore'] == true) {
            $option = 'IGNORE';
        }

        // 绑定数据
        $flag = false; // fields的填充标志位
        $index = 0; // 防止$rows的下标是中文, 自己重新计数
        $strBindKeys = '';
        $fields = $bindVals = [];
        foreach ($rows as $row) {
            $bindKeys = [];
            ksort($row); // 防止$row的key没有统一顺序
            foreach ($row as $key => $val) {
                $temp_key = ":{$index}_{$key}";
                $bindKeys[] = $temp_key;
                $bindVals[$temp_key] = $val;

                if (!$flag) {
                    $fields[] = "`{$key}`";
                }
            }

            $flag = true; // fields 填充完毕标志位
            $strBindKeys .= '(' . implode(', ', $bindKeys) . '), ';
            $index++;
        }
        $strBindKeys = rtrim($strBindKeys, ', ');

        $sql = sprintf("INSERT %s INTO  `%s` (%s) VALUES %s", $option, $tableName, implode(', ', $fields), $strBindKeys);
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement)) {
            return false;
        }

        $res = $query->execute($bindVals);
        if ($res !== true) {
            return false;
        }

        return $query->rowCount();
    }

    /**
     * 唯一键不存在则插入, 存在则在原有数据基础上做更新操作
     *
     * @param string $tableName         表名
     * @param array  $rows              要写入的数组(支持一次性接入多行)
     * @param array  $updates           做更新操作时要更新的字段名列表
     * @return bool|int                 成功则返回影响的行数，失败则返回 false
     */
    public function upsert($tableName, $rows, $updates)
    {
        $tableName = str_replace(['`','.'], ['','`.`'], $tableName);
        $updateKeys = $fieldKeys = $bindVals = $inserts = [];

        $row = current($rows);
        if (!is_array($row))
        {
            $row = $rows;
            $rows = [$row];
        }

        $fields = array_keys($row);
        foreach ($fields as $key)
        {
            $fieldKeys[$key]  = "`{$key}`";
        }

        $count = 0;

        foreach ($rows as $row)
        {
            ++$count;
            $bindKeys = [];

            foreach ($fields as $key)
            {
                $bindKey            = ":{$key}{$count}";
                $bindKeys[$key]     = $bindKey;
                $bindVals[$bindKey] = $row[$key];
            }

            $inserts[] = '('. implode(',', $bindKeys) .')';
        }

        foreach ($updates as $key)
        {
            if (isset($row[$key]))
            {
                $updateKeys[$key] = "`{$key}` = VALUES(`{$key}`)";
            }
        }

        if (empty($updateKeys))
        {
            $update_clause = '';
            $ignore = 'IGNORE';
        }
        else
        {
            $update_clause = "ON DUPLICATE KEY UPDATE " . implode(', ', $updateKeys);
            $ignore = '';
        }

        $sql = sprintf("INSERT %s INTO `%s` (%s) VALUES %s {$update_clause}", $ignore, $tableName, implode(', ', $fieldKeys), implode(', ', $inserts));
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement))
        {
            return false;
        }

        $res = $query->execute($bindVals);
        if ($res !== true)
        {
            return false;
        }

        return $query->rowCount();
    }

    /**
     * UPDATE 语句的快捷方式
     *
     * @param string $tableName 表名
     * @param array  $where     一个 WHERE 条件数组，仅支持 AND
     * @param array  $row       要更新的字段及
     * @return bool|int         成功执行则返回影响的行数，失败则返回 false
     */
    public function update($tableName, $row, $where)
    {
        if (empty($row) || empty($where)) return false;
        // 表名
        $tableName = str_replace(array('`','.'), array('','`.`'), $tableName);
        // 字段更新列表
        $fields = array();
        // 绑定数据
        $bindVals = array();
        foreach ($row as $key => $val)
        {
            if (is_array($val))
            {
                $fields[] = "`$key`=`{$val[0]}`{$val[1]}";
                continue;
            }
            $fields[] = "`$key`=:$key";
            $bindVals[":$key"] = $val;
        }
        // WHERE 条件
        $whereSQL = $this->_parseWhere($where, $bindVals);


        $sql   = sprintf("UPDATE `%s` SET %s WHERE %s", $tableName, implode(', ', $fields), implode(' AND ', $whereSQL));
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement)) return false;
        $res   = $query->execute($bindVals);
        if ($res !== true) return false;

        return $query->rowCount();

    }

    /**
     * DELETE 语句的快捷方式
     *
     * @param string $tableName 表名
     * @param array  $where     一个 WHERE 条件数组，仅支持 AND 连接
     * @return bool|int         成功执行则返回影响的行数，失败则返回 false
     */
    public function delete($tableName, $where)
    {
        if (empty($where)) return false;
        // 表名
        $tableName = str_replace(array('`','.'), array('','`.`'), $tableName);
        // WHERE 条件
        $bindVals = array();
        $whereSQL = $this->_parseWhere($where, $bindVals);

        $sql   = sprintf("DELETE FROM `%s` WHERE %s", $tableName, implode(' AND ', $whereSQL));
        $query = $this->prepare($sql);
        if (!($query instanceof PDOStatement)) return false;
        $res   = $query->execute($bindVals);
        if ($res !== true) return false;

        return $query->rowCount();
    }
    
    /**
     * 魔术call
     * 
     * @param string $name          方法名
     * @param mixed  $arguments     参数
     * @throws PDOException
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->_statement, $name))
        {
            return call_user_func_array(array($this->_statement, $name), $arguments);
        }
        
        throw new PDOException("Fatal error: Call to undefined method PDOQuery::{$name}", 100);
    }
    
    private function _parseWhere($where, &$bindVals)
    {
        // 返回值
        $whereSQL  = array();
        // 绑定符号计数器
        $bindCnts  = array();
        // 支持的比较符号
        $operators = array('=','<','>','<>','>=','<=','IN','LIKE');

        foreach ($where as $key => $val)
        {
            if (gettype($key) == "integer")
            {
                $whereSQL[] = $val;
                continue;
            }

            $tmp = explode(' ', $key);
            if (count($tmp) == 1) $tmp[1] = '=';
            list($field, $operator) = $tmp;
            if (!in_array($operator, $operators)) continue;

            // 特殊处理 IN 查询
            if (strtoupper($operator) == 'IN')
            {
                if (gettype($val) == 'array')
                {
                    if (!empty($val))
                    {
                        $val = array_map(array($this, 'quote'), $val);
                        $whereSQL[] = sprintf("`%s` IN (%s)", $field, implode(",", $val));
                    }
                }
                elseif (gettype($val) == 'string')
                {
                    $whereSQL[] = sprintf("`%s` IN (%s)", $field, $val);
                }
                continue;
            }

            if (isset($bindCnts[$field]))
            {
                $bindNum = ++$bindCnts[$field];
            }
            else
            {
                $bindNum = $bindCnts[$field] = 1;
            }
            $bindKey = sprintf(':%s_%s', $field, $bindNum);
            $whereSQL[] = sprintf("`%s` %s %s", $field, $operator, $bindKey);
            $bindVals[$bindKey] = $val;
        }

        return $whereSQL;
    }

}
