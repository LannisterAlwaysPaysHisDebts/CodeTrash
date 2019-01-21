<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午3:57
 */

namespace php\practice\Builder08;

use php\practice\Builder08\Parts\Vehicle;

class Director
{
    public function build(BuilderInterface $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}