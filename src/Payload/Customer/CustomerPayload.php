<?php

namespace Biteral\Payload\Customer;

use Biteral\Payload\Payload;

class CustomerPayload extends Payload {
    /**
     * @var string $code The customer code as stored in your system.
     */
    public $code;

    /**
     * @var string $country The country the customer is in, a standard ISO 3166-1 alpha-3 code
     */
    public $country;

    /**
     * @var string $state The state the customer is in, a standard ISO 3166-2 code
     */
    public $state;

    /**
     * @var string $city The city the customer is in, a standard Wiki Data Id
     */
    public $city;

    /**
     * @var int $yearBorn The year this customer was born
     */
    public $yearBorn;

    /**
     * @var int $gender The gender of this customer born, one of the CustomerGender consts, like CustomerGender::FEMALE
     */
    public $gender;

    /**
     * @var bool $isActive Whether this customer is active at Biteral
     */
    public $isActive;

    /**
     * @var mixed $metadata The customer metadata
     */
    public $metadata;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new CustomerPayload([
                'code' => $object->code,
                'country' => $object->country,
                'state' => $object->state,
                'city' => $object->city,
                'yearBorn' => $object->yearBorn,
                'gender' => $object->gender,
                'metadata' => $object->metadata,
                'isActive' => $object->isActive
            ]);
    }

}
