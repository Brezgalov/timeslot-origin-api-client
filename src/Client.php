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
    public function confirmWindow($windowId, $plate)
    {
        return $this->prepareRequest("/acceptWindows/{$windowId}/{$plate}")
            ->setResponseClass('\Brezgalov\TimeslotOriginApiClient\WindowsConfirmResponse')
            ->setMethod('POST')
            ->setQueryParams(['format' => 'json'])
            ->setBodyParams([
                'Id'    => $windowId,
                'Plate' => $plate,
            ])
            ->execJson()
        ;
    }

    /**
     * @return \Brezgalov\ApiWrapper\Response
     */
    public function deleteWindow($phone, $windowId, $initiator = null)
    {
        if (empty($initiator)) {
            $initiator = '\Brezgalov\TimeslotOriginApiClient\Client';
        }
        return $this->prepareRequest("/deleteWindow/{$phone}/{$windowId}")
            ->setResponseClass('\Brezgalov\TimeslotOriginApiClient\DeleteWindowResponse')
            ->setMethod('POST')
            ->setQueryParams(['format' => 'json'])
            ->setBodyParams([
                'Phone'    => $phone,
                'WindowId' => $windowId,
                'Initiator' => $initiator,
            ])
            ->execJson()
        ;
    }

    /**
     * Send a notification to zernovozam app
     *
     * @param $phones
     * @param $text
     * @param $sender
     * @param array $customArgs
     * @return \Brezgalov\ApiWrapper\Response
     */
    public function sendNotification($phones, $text, $sender, array $customArgs = ['Type' => 1])
    {
        if (!array_key_exists('Type', $customArgs)) {
            $customArgs['Type'] = 1;
        }

        return $this->prepareRequest('/PushNotification/json/reply/NotificateUsers')
            ->setMethod('POST')
            ->setBodyParams(array_merge($customArgs, [
                'Phones'    => $phones,
                'Message'   => $text,
                'Sender'    => $sender,
            ]))
            ->execJson();
    }
}