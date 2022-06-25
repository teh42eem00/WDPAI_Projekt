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

    public function cars()
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        $cars = $this->carRepository->getCars($user_id);
        $this->render('cars', ['cars' => $cars]);
    }

    public function addCar()
    {
        if ($this->isPost()){
            // TODO create new project object and save it in database
            $car = new Car(0, 0, $_POST['brand'], $_POST['model'], $_POST['production_year'], $_POST['license_plate']);
            $this->carRepository->addCar($car);
            return $this->render('add-car', ['messages' => ['You succesfully added new car!']]);
    }

        return $this->render('add-car', ['messages' => $this->message]);
    }
}
