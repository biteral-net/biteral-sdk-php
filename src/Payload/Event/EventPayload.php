<?php

namespace Biteral\Payload\Event;

use Biteral\Payload\Payload;

class EventPayload extends Payload {
    /**
     * @var string $type The event type, one of the event types available at https://docs.biteral.net/guide/integration-data/events/types/
     */
    public $type;

    /**
     * @var \DateTimeImmutable $timestamp The moment at which the event occurred
     */
    public $timestamp;

    /**
     * @var string $customerCode The customer code as you specified it when sending it to Biteral.
     */
    public $customerCode;

    /**
     * @var string $productCode The product code as you specified it when sending it to Biteral.
     */
    public $productCode;

    /**
     * @var string $categoryCode The category code as you specified it when sending it to Biteral.
     */
    public $categoryCode;

   /**
     * @var string $brandCode The brand code as you specified it when sending it to Biteral.
     */
    public $brandCode;

    /**
     * @var mixed $metadata The event metadata
     */
    public $metadata;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new EventPayload([
                'type' => $object->type,
                'timestamp' => $object->timestamp,
                'customerCode' => $object->customerCode,
                'productCode' => $object->productCode,
                'categoryCode' => $object->categoryCode,
                'brandCode' => $object->brandCode
            ]);
    }

}
