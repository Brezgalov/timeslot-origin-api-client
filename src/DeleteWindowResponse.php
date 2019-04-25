<?php

namespace Brezgalov\TimeslotOriginApiClient;

class DeleteWindowResponse extends \Brezgalov\TimeslotOriginApiClient\CShaprResponse
{
    /**
     * @return array
     */
    public function getErrorsList()
    {
        return [
            2   => 'Окно не найдено',
            3   => 'Неверно указан номер автомобиля',
            4   => 'Рано удалять окно',
            5   => 'Поздно удалять окно',
            6   => 'Только создатель окна или владелец машины может его удалить',
            7   => 'Достиг лимита разрешенных удалений',
        ];
    }
}