<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class PropertyFixtures extends Fixture
{

    protected Generator $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $property = new Property();
            $nameAndAddress = $this->faker->address;
            $property
                ->setTitle($nameAndAddress)
                ->setAddress($nameAndAddress)
                ->setBathRoom($this->faker->biasedNumberBetween(0, 10))
                ->setBedRoom($this->faker->biasedNumberBetween(0, 10))
                ->setIsAir($this->faker->boolean(50))
                ->setIsHeating($this->faker->boolean(50))
                ->setIsInternet($this->faker->boolean(50))
                ->setIsKitchen($this->faker->boolean(50))
                ->setIsTv($this->faker->boolean(50))
                ->setPrice($this->faker->randomNumber(3))
                ->setDateCreated(new \DateTime('now'));

            $lastDateOut = null;
            for ($ii = 0; $ii < 10; $ii++) {
                $reservation = new Reservation();
                if (is_null($lastDateOut)) {
                    $dateIn = new \DateTime('now');
                }else{
                    $emptyDate = $this->faker->biasedNumberBetween(0,5);
                    if($emptyDate < 1)
                    {
                        $dateIn = clone $lastDateOut;
                    }else{
                        $dateIn = clone $lastDateOut;
                        $dateIn->modify('+'.$emptyDate.' days');
                    }
                }
                $dateOut = clone $dateIn;
                $dateOut->modify("+" . $this->faker->biasedNumberBetween(0, 15) . ' days');
                $reservation
                    ->setDateIn($dateIn)
                    ->setDateOut($dateOut)
                    ->setDateCreated(new \DateTime('now'));
                $property->addReservation($reservation);
                $lastDateOut = $dateOut;
            }

            $manager->persist($property);
            $manager->flush();
        }

    }
}
