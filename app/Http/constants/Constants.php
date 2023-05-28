<?php

namespace App\Http\constants;

class Constants
{
    // user status
    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;

    //user role
    const  ADMIN = 1;
    const CUSTOMER = 2;
    const ROLE_USER = [
        self::ADMIN => "ادمین",
        self::CUSTOMER => "مشتری",
    ];

    // order status
    const ORDER_SUCCESSFUL = 1;
    const ORDER_UNSUCCESSFUL = 2;

    // paginate pre page
    const PAGINATION_DEFAULT = 6;
    const PAGINATION_CUSTOM = 3;

    // paymentCreate gateway type
    const ZARINPAL = 1;

    //  post status
    const POST_ACTIVE = 1;
    const POST_INACTIVE = 0;

    // comment status
    const COMMENT_VERIFIED = 1;
    const COMMENT_UNVERIFIED = 0;

    //video status
    const VIDEO_ACTIVE = 1;
    const VIDEO_INACTIVE = 0;
}
