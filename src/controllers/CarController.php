<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../repository/CarRepository.php';

class CarController extends AppController
{

    private array $message = [];
    private CarRepository $carRepository;

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
    }


    public function addCar()
    {
        // TODO create new project object and save it in database
        $car = new Car($_POST['id_car'], $_POST['id_user'], $_POST['car_setup_id'], $_POST['license_plate']);
        $this->carRepository->addCar($car);

        return $this->render('cars', ['messages' => $this->message]);
    }
}
