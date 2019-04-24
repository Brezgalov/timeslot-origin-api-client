<?php

namespace Brezgalov\TimeslotOriginApiClient;

class Client extends \Brezgalov\ApiWrapper\Client
{
    const PROVIDER_ID_VTERMINAL = 9;

    public static $windowsErrors = [
        0   => "Произошла ошибка подключения. Проверьте и попробуйте получить таймслоты еще раз.",
        2   => "Неверно указано количество машин.",
        3   => "Выдача таймслотов приостановлена.",
        4   => "Лимиты на ближайшие доступные даты выбраны.",
        5   => "Неверно указан стивидор.",
        6   => "Достигнут лимит на прием автомобилей на данного экспортера данной культуры",
        7   => "Достигнут лимит на пример данной культуры",
        8   => "Стивидор не принимает на данного экспортера",
        9   => "Дата прибытия не может быть раньше, чем текущее время + 2 часа. Уточните время прибытия.",
        10  => "Получение таймслотов временно заблокированно. Причина - некоторые из зарегистрированных вами машин не приезжают.",
        11  => "Нет квоты на данного экспортера.",
        12  => "Не удалось получить таймслоты. Попробуйте запросить таймслоты еще раз через минуту. Если проблема повторяется - сообщите на форуме.",
        13  => "Квота по данным параметрам не может быть получена",
        100 => "Превышен лимит доступных таймслотов",
    ];

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