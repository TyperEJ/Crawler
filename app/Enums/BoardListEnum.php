<?php

namespace App\Enums;

class BoardListEnum
{
    const MAC_SHOP = 'MacShop';
    const LIFE_IS_MONEY = 'Lifeismoney';
    const MOBILE_PAY = 'MobilePay';
    const SOHO = 'soho';

    public static function getList()
    {
        return [
            self::MAC_SHOP,
            self::LIFE_IS_MONEY,
            self::MOBILE_PAY,
            self::SOHO,
        ];
    }
}