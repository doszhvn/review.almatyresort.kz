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

    public static function slugToMapUrl(): array
    {
        return [
            self::ALMATY_RESORT_SLUG->value => 'https://2gis.kz/almaty/geo/9429940000870118',
            self::OQZHETPES_SLUG->value     => 'https://2gis.kz/kokshetau/geo/70000001033829267/70.243914,53.083152',
        ];
    }

    public static function getMapUrl($slug): string
    {
        return self::slugToMapUrl()[$slug];
    }

    public static function slugToLogo(): array
    {
        return [
            self::ALMATY_RESORT_SLUG->value => asset('assets/images/logo.png'),
            self::OQZHETPES_SLUG->value     => asset('assets/images/oqzhetpes-logo.png'),
        ];
    }

    public static function getLogo($slug): string
    {
        return self::slugToLogo()[$slug];
    }
}
