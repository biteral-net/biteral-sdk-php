<?php

namespace Biteral\Exception;

use Biteral\Exception\ApiException;

class BadRequestException extends ApiException {
    private $fieldErrors;

    public function isFieldErrors()
    {
        return is_array($this->fieldErrors);
    }

    public function getFieldErrors()
    {
        return $this->fieldErrors;
    }

    public function setFieldErrors($fieldErrors)
    {
        $this->fieldErrors = $fieldErrors;
    }
}
