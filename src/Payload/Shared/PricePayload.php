<?php

namespace Biteral\Payload\Shared;

use Biteral\Payload\Payload;

class PricePayload extends Payload {
    /**
     * @var string $amount The amount in string format, with any needed decimal places and using '.' as a decimal separator. For example: '24.95'
     */
    public $amount;

    /**
     * @var string $currency The currency in which the amount is provided, using the ISO 4217 standard. For example: 'EUR'
     */
    public $currency;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new PricePayload([
                'amount' => $object->amount,
                'currency' => $object->currency
            ]);
    }
}
