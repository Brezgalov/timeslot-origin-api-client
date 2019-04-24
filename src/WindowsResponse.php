<?php

namespace Brezgalov\TimeslotOriginApiClient;

class WindowsResponse extends \Brezgalov\ApiWrapper\Response
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (!parent::isSuccessful()) {
            return false;
        }

        if (
            !is_array($this->data) ||
            !array_key_exists('Status', $this->data) ||
            !array_key_exists('Windows', $this->data)
        ) {
            $this->addError('Не верный формат данных');
            return false;
        }

        $status = $this->data['Status'];
        if (array_key_exists($status, Client::$windowsErrors)) {
            $this->addError(Client::$windowsErrors[$status]);
            return false;
        }

        return true;
    }
}