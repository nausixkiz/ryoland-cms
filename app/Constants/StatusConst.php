<?php

namespace App\Constants;


/**
 * @method static StatusConst DRAFT()
 * @method static StatusConst PUBLISHED()
 * @method static StatusConst PENDING()
 */
class StatusConst
{
    public const PUBLISHED = 'published';
    public const DRAFT = 'draft';
    public const PENDING = 'pending';

    public const LIST_STATUS = [self::PUBLISHED, self::DRAFT, self::PENDING];

    public static function getAllListStatus()
    {
        return self::LIST_STATUS;
    }
}
