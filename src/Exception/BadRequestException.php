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

    public function getFieldErrorsHumanized()
    {
        $r = '';
        if ($this->isFieldErrors()) {
            foreach ($this->getFieldErrors() as $fieldError) {
                $r .=
                    "Field: ".$fieldError['field']."\n".
                    "Code: ".$fieldError['code']."\n".
                    "Description: ".$fieldError['description']."\n".
                    "\n";
            }
        }
        return $r;
    }
}
