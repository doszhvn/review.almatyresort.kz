<?php

namespace App\Enum;

enum BranchEnum : string
{
    case ALMATY_RESORT = 'Almaty Resort';
    case ALMATY_RESORT_SLUG = 'almaty-resort';
    case OQZHETPES = 'Okzhetpes.borovoe';
    case OQZHETPES_SLUG = 'oqzhetpes';
    public static function toArray(): array
    {
        return [
            self::ALMATY_RESORT_SLUG->value,
            self::OQZHETPES_SLUG->value,
        ];
    }
    public static function slugToName(): array
    {
        return [
            self::ALMATY_RESORT_SLUG->value => self::ALMATY_RESORT->value,
            self::OQZHETPES_SLUG->value     => self::OQZHETPES->value,
        ];
    }
    public static function getId($slug): int
    {
        $id = array_search($slug, self::toArray());

        return $id !== false ? $id + 1 : false;
    }
}
