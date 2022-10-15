<?php

namespace App\ViewObjects;

use App\Entity\Property;

class ReservationObject extends BaseViewObject
{

    private Property $property;
    private $dateIn;
    private $dateOut;

    /**
     * @param Property $property
     * @param $dateIn
     * @param $dateOut
     */
    public function __construct($data)
    {
        $this->property = $data['property'];
        $this->dateIn = $data['dateIn'] ?? null;
        $this->dateOut = $data['dateOut'] ?? null;
    }


    public static function create($data)
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->property->getTitle(),
            'price' => $this->property->getPrice(),
            'address' => $this->property->getAddress(),
            'bedRoom' => $this->property->getBedRoom(),
            'bathRoom' => $this->property->getBathRoom(),
            'isTv' => $this->property->getIsTv(),
            'isKitchen' => $this->property->getIsKitchen(),
            'isHeating' => $this->property->getIsHeating(),
            'isInternet' => $this->property->getIsInternet(),
            'isAir' => $this->property->getIsAir()
        ];
    }

    public function toSimpleArray()
    {
        return [
            'title' => $this->property->getTitle(),
            'price' => $this->property->getPrice(),
            'bedRoom' => $this->property->getBedRoom(),
            'bathRoom' => $this->property->getBathRoom(),
        ];
    }
}