<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';

class CarRepository extends Repository
{

    public function getCar(int $id_car): ?Car
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.cars WHERE id_car = :id_car
        ');
        $stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
        $stmt->execute();

        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            return null;
        }

        return new Car(
            $car['id_car'],
            $car['id_user'],
            $car['car_setup_id'],
            $car['license_plate']
        );
    }

    public function addCar(Car $car): void
    {
        #$date = new DateTime();
        $stmt = $this->database->connect()->prepare('
        INSERT INTO cars(id_car, id_user, car_setup_id, license_plate)
        VALUES (?, ?, ?, ?)
        ');
        $assignedById = $_SESSION['userid'];
        $stmt->execute(
            $car->getIdCar(),
            $assignedById,
            $car->getCarSetupId(),
            $car->getLicensePlate()
        );
    }
}