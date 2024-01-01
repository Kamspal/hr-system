<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

/**
 * Trait Uuids
 * Generate uuid for the table key while creating a database entry
 * @package Spartadia6\Traits
 */
trait Uuids
{

    /**
     * Boot function from laravel.
     */
    protected static function bootUuids()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}