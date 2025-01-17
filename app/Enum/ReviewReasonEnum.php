<?php

namespace App\Enum;

enum ReviewReasonEnum: string
{
    case SERVICE_LEVEL = 'Уровень сервиса';
    case CLEANING_QUALITY = 'Качество уборки';
    case LONG_WAIT_TIME = 'Долгое время ожидания';
    case MEDICAL_SERVICE = 'Медицинские услуги';
    case POOL_SERVICE = 'Услуги бассейна';
    case CULTURAL_LEISURE_ACTIVITY = 'Культурно-досуговые мероприятия';
    case FOOD_QUALITY_PORTION = 'Качество блюд и порции';
    case WRITE_DIRECTOR = 'Написать директору';

    public static function toArray(): array
    {
        return [
            self::SERVICE_LEVEL,
            self::CLEANING_QUALITY,
            self::LONG_WAIT_TIME,
            self::MEDICAL_SERVICE,
            self::POOL_SERVICE,
            self::CULTURAL_LEISURE_ACTIVITY,
            self::FOOD_QUALITY_PORTION,
            self::WRITE_DIRECTOR,
        ];
    }
    public static function getId()
    {

    }
}
