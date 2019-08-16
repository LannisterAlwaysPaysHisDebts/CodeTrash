<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午4:00
 */

namespace php\practice\Builder08;

use php\practice\Builder08\Parts\Vehicle;

interface BuilderInterface
{
    public function createVehicle();

    public function addWheel();

    public function addEngine();

    public function addDoors();

    public function getVehicle(): Vehicle;
}