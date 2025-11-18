<?php

namespace Biteral\Service\Customer;

use Biteral\Service\Service;
use Biteral\Entity\Customer\Customer;
use Biteral\Exception\ApiException;
use Biteral\Payload\Customer\CustomerPayload;

/**
 * A service to interact with your customer on Biteral
 */
final class CustomersService extends Service {
    /**
     * @param string $code The code of the customer as stored in your systems
     * @return Customer
     * @throws ApiException
     */
    public function getByCode($code)
    {
        return $this->request(self::METHOD_GET, 'customers', ['code' => $code]);
    }

    /**
     * @param string $id The Biteral Id of the customer
     * @return Customer
     * @throws ApiException
     */
    public function getById($id)
    {
        return $this->request(self::METHOD_GET, 'customers', ['id' => $id]);
    }

    /**
     * @param string $code The code of the customer as stored in your systems
     * @throws ApiException
     */
    public function deleteByCode($code)
    {
        return $this->request(self::METHOD_DELETE, 'customers', ['code' => $code]);
    }

    /**
     * @param string $id The Biteral Id of the customer
     * @throws ApiException
     */
    public function deleteById($id)
    {
        return $this->request(self::METHOD_DELETE, 'customers', ['id' => $id]);
    }

    /**
     * @param CustomerPayload $customerPayload The customer payload containing the data to be ingested about a customer, or an array of customer payloads to be ingested
     * @throws ApiException
     */
    public function ingest($customerPayload)
    {
        $this->request(self::METHOD_POST, 'customers', null, $customerPayload);
    }
}
