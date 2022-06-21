<?php

class Car
{
    private int $id_car;
    private int $id_user;
    private int $car_setup_id;
    private string $license_plate;


    public function __construct(int $id_car, int $id_user, int $car_setup_id, string $license_plate)
    {
        $this->id_car = $id_car;
        $this->id_user = $id_user;
        $this->car_setup_id = $car_setup_id;
        $this->license_plate = $license_plate;
    }

    /**
     * @return int
     */
    public function getIdCar(): int
    {
        return $this->id_car;
    }

    /**
     * @param int $id_car
     */
    public function setIdCar(int $id_car): void
    {
        $this->id_car = $id_car;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getCarSetupId(): int
    {
        return $this->car_setup_id;
    }

    /**
     * @param int $car_setup_id
     */
    public function setCarSetupId(int $car_setup_id): void
    {
        $this->car_setup_id = $car_setup_id;
    }

    /**
     * @return string
     */
    public function getLicensePlate(): string
    {
        return $this->license_plate;
    }

    /**
     * @param string $license_plate
     */
    public function setLicensePlate(string $license_plate): void
    {
        $this->license_plate = $license_plate;
    }


}