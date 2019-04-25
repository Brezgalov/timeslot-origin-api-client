<?php

namespace Brezgalov\TimeslotOriginApiClient;

class Client extends \Brezgalov\ApiWrapper\Client
{
    const PROVIDER_ID_VTERMINAL = 9;

    /**
     * @var string
     */
    protected $host;

    /**
     * @inheritdoc
     */
    public function __construct($host, $token = null)
    {
        $this->host = $host;
        parent::__construct($token);
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->host;
    }

    /**
     * @param array $params - requires: CultureId, IncomingDate, Phone, Stevedore, TrucksCount = 1
     * @return \Brezgalov\TimeslotOriginApiClient\WindowsResponse
     */
    public function getWindows(array $params)
    {
        $params['ProviderId'] = static::PROVIDER_ID_VTERMINAL;
        if (!array_key_exists('TrucksCount', $params)) {
            $params['TrucksCount'] = 1;
        }

        return $this->prepareRequest('/getWindows')
            ->setResponseClass('\Brezgalov\TimeslotOriginApiClient\WindowsResponse')
            ->setMethod('POST')
            ->setQueryParams(['format' => 'json'])
            ->setBodyParams($params)
            ->execJson()
        ;
    }

    /**
     * @return \Brezgalov\ApiWrapper\Response
     */
    public function confirmWindow()
    {

    }

    /**
     * @return \Brezgalov\ApiWrapper\Response
     */
    public function deleteWindow()
    {

    }
}