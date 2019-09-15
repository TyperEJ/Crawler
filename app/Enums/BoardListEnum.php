<?php

namespace App\Enums;

class BoardListEnum
{
    const MAC_SHOP = 'MacShop';
    const LIFE_IS_MONEY = 'Lifeismoney';
    const MOBILE_PAY = 'MobilePay';
    const SOHO = 'soho';
    const IOS = 'iOS';
    const STEAM = 'Steam';
    const ACTUARY = 'Actuary';
    const BUY_TOGETHER = 'BuyTogether';
    const DRAMA_TICKET = 'Drama-Ticket';
    const CREDITCARD = 'CREDITCARD';
    const HARDWARE_SALE = 'HardwareSale';
    const MOBILESALES = 'mobilesales';
    const GAMESALE = 'Gamesale';
    const PC_SHOPPING = 'PC_Shopping';
    const BABY_MOTHER = 'BabyMother';
    const MOBILE_COMM = 'MobileComm';
    const FORSALE = 'forsale';
    const INSTANT_MESS = 'Instant_Mess';
    const MOVIE = 'movie';
    const DC_SALE = 'DC_SALE';
    const E_COUPON = 'e-coupon';
    const TAICHUNG_BUN = 'TaichungBun';
    const CVS = 'CVS';
    const HSINCHU = 'Hsinchu';
    const JOB = 'job';
    const TAINAN = 'Tainan';
    const BABY_PRODUCTS = 'BabyProducts';
    const E_SHOPPING = 'e-shopping';
    const NB_SHOPPING = 'nb-shopping';
    const PLAY_STATION = 'PlayStation';
    const HOME_SALE = 'home-sale';
    const CODE_JOB = 'CodeJob';
    const TEST = 'Test';

    public static function getList()
    {
        return [
            self::MAC_SHOP,
            self::LIFE_IS_MONEY,
            self::MOBILE_PAY,
            self::SOHO,
//            self::IOS,
//            self::STEAM,
            self::ACTUARY,
            self::BUY_TOGETHER,
            self::DRAMA_TICKET,
//            self::CREDITCARD,
            self::HARDWARE_SALE,
            self::MOBILESALES,
            self::GAMESALE,
            self::PC_SHOPPING,
//            self::BABY_MOTHER,
//            self::MOBILE_COMM,
            self::FORSALE,
            self::INSTANT_MESS,
//            self::MOVIE,
            self::DC_SALE,
            self::E_COUPON,
            self::TAICHUNG_BUN,
//            self::CVS,
//            self::HSINCHU,
            self::JOB,
//            self::TAINAN,
            self::BABY_PRODUCTS,
            self::E_SHOPPING,
            self::NB_SHOPPING,
//            self::PLAY_STATION,
            self::HOME_SALE,
            self::CODE_JOB,
            self::TEST,
        ];
    }
}