<?php

namespace App\Constants;


class ModerationStatus
{
    public const APPROVED = 'approved';
    public const PENDING = 'pending';
    public const REJECTED = 'rejected';

    public static function getAllListModerationStatus()
    {
        return [
            self::APPROVED,
            self::PENDING,
            self::REJECTED,
        ];
    }
}
