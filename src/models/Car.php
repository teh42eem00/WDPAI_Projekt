<?php

class Car
{
    private int $id_car;
    private int $id_user;
    private string $brand;
    private string $model;
    private int $production_year;
    private string $license_plate;

    /**
     * @param int $id_car
     * @param int $id_user
     * @param string $brand
     * @param string $model
     * @param int $production_year
     * @param string $license_plate
     */
    public function __construct(int $id_car, int $id_user, string $brand, string $model, int $production_year, string $license_plate)
    {
        $this->id_car = $id_car;
        $this->id_user = $id_user;
        $this->brand = $brand;
        $this->model = $model;
        $this->production_year = $production_year;
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
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getProductionYear(): int
    {
        return $this->production_year;
    }

    /**
     * @param int $production_year
     */
    public function setProductionYear(int $production_year): void
    {
        $this->production_year = $production_year;
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

    public function getDescription(): string
    {
        return $this->brand . ' ' . $this->model . ' (' . $this->production_year . ') ' . $this->license_plate;
    }


}