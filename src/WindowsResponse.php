<?php

namespace Brezgalov\TimeslotOriginApiClient;

class WindowsResponse extends \Brezgalov\TimeslotOriginApiClient\CShaprResponse
{
    /**
     * @return array
     */
    public function getErrorsList()
    {
        return [
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
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (!parent::isSuccessful()) {
            return false;
        }

        if (!array_key_exists('Windows', $this->data)) {
            $this->addError('Не верный формат данных');
            return false;
        }

        return true;
    }

    /**
     * get Nth window
     * @param int $index
     * @return array|null
     */
    public function getWindow($index = 0)
    {
        if (!array_key_exists('Windows', $this->data)) {
            return null;
        }

        $i = 0;
        $result = null;
        foreach ($this->data['Windows'] as $id => $time) {
            if ($i == $index) {
                $result = ['id' => $id, 'time' => $time];
                break;
            }
        }

        return $result;
    }
}