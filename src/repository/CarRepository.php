<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';

class CarRepository extends Repository
{

    public function getCar(int $id_car): ?Car
    {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.car_details WHERE id_car = :id_car');
        $stmt->bindParam(':id_car', $id_car, PDO::PARAM_INT);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            return null;
        }

        return new Car(
            $car['id_car'],
            $car['id_user'],
            $car['brand'],
            $car['model'],
            $car['production_year'],
            $car['license_plate']
        );
    }

    public function getCars(int $id_user): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.car_details WHERE id_user = :id_user');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cars as $car) {
            $result[] = new Car(
                $car['id_car'],
                $car['id_user'],
                $car['brand'],
                $car['model'],
                $car['production_year'],
                $car['license_plate']
            );
        }
        return $result;
    }

    public function getCarSetupId(string $brand,string $model, int $production_year)
    {
        $stmt = $this->database->connect()->prepare('SELECT car_setup_id FROM public.car_setup 
                    WHERE brand = :brand and model = :model and production_year = :production_year');
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':production_year', $production_year);
        $stmt->execute();
        $car_setup_id = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car_setup_id) {
            return null;
        }

        return $car_setup_id['car_setup_id'];
    }

    public function addCar(Car $car): void
    {
        $stmt = $this->database->connect()->prepare('INSERT INTO car_setup(brand,model,production_year)
        VALUES (?, ?, ?)');
        $brand=$car->getBrand();
        $model=$car->getModel();
        $production_year=$car->getProductionYear();
        $stmt->execute([$brand,$model,$production_year]);

        $carSetupId = $this->getCarSetupId($brand,$model,$production_year);
        session_start();
        $assignedById = $_SESSION['user_id'];

        $stmt = $this->database->connect()->prepare('
        INSERT INTO cars(id_user, car_setup_id, license_plate) VALUES (?, ?, ?)');
        $stmt->execute([$assignedById,$carSetupId,$car->getLicensePlate()]);
    }
}