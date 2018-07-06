#设计模式: 
ruler 制定者, 管理者
producer 生产者
worker 工作者

ruler 制定规则 => 生产者根据规则生成特定的数据数组 => ruler 获得数据 => worker根据数据操作指定的数据库, 插入数据


设计: 
ruler: 
制定指定的规则: 
    1. 