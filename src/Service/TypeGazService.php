<?php 

namespace App\Service;

use App\Repository\RefrigerantsRepository;


class TypeGazService {

    protected $refrigerants;

    public function __construct(RefrigerantsRepository $refrigerants)
    {
        $this->refrigerants = $refrigerants;
    }
    public function typeGaz()
    {
        $gaz = [];
        foreach ($this->refrigerants->findAll() as $type) {
            $gaz[$type->getRefrigerant()] = $type->getRefrigerant();
        }
        return $gaz;

    }




}


