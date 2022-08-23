<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\DtoGenerics;

class NewUserWithWalletDto extends BaseDto
{
    use DtoGenerics;

    private User $user;
    private Wallet $wallet;

    private static NewUserWithWalletDto $instance;

    private final function __construct() {}

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

//    private function setProperties(array $properties): void
//    {
//        foreach ($properties as $propertyName => $propertyValue) {
//            $this->$propertyName = $propertyValue;
//        }
//    }
//
//    public function preciseDto(array $arr): NewUserWithWalletDto
//    {
//        $dto = new self();
//        $dto->setProperties($arr);
//
//        return $dto;
//    }
//
//    public function get(string $propertyName)
//    {
//        if(! property_exists($this, $propertyName)) {
//            throw new InvalidClassProperty();
//        }
//        return $this->$propertyName;
//    }
}
