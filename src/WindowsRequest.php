<?php

namespace Brezgalov\TimeslotOriginApiClient;

class WindowsRequest extends \Brezgalov\ApiWrapper\Request
{
    protected function getDefaultResponseClass()
    {
        return '\Brezgalov\TimeslotOriginApiClient\WindowsResponse';
    }
}