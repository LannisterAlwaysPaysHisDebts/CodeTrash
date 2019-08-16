<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午4:11
 */

namespace php\test;

require dirname(__DIR__) . '/autoload.php';

use php\practice\Builder08\CarBuilder;
use php\practice\Builder08\Director;
use php\practice\Builder08\Parts\Car;
use php\practice\Builder08\Parts\Truck;
use php\practice\Builder08\TruckBuilder;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
    public function testCanBuildTruck()
    {
        $truckBuilder = new TruckBuilder();
        $newVehicle = (new Director())->build($truckBuilder);

        $this->assertInstanceOf(Truck::class, $newVehicle);
    }

    public function testCanBuildCar()
    {
        $carBuilder = new CarBuilder();
        $newVehicle = (new Director())->build($carBuilder);

        $this->assertInstanceOf(Car::class, $newVehicle);
    }
}