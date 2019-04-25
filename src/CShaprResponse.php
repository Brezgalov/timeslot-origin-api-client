<?php

namespace Brezgalov\TimeslotOriginApiClient;

class CShaprResponse extends \Brezgalov\ApiWrapper\Response
{
    /**
     * @return array
     */
    public function getErrorsList()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (!parent::isSuccessful()) {
            return false;
        }

        if (!is_array($this->data) || !array_key_exists('Status', $this->data)) {
            $this->addError('Не верный формат данных');
            return false;
        }

        $status = $this->data['Status'];
        $errors = $this->getErrorsList();
        if (array_key_exists($status, $errors)) {
            $this->addError($errors[$status]);
            return false;
        }

        return true;
    }
}