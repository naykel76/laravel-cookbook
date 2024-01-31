<?php

namespace App\Models;

use App\Enums\PublishedStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Naykel\Gotime\Casts\MoneyCast;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => MoneyCast::class,
        'status' => PublishedStatus::class,
    ];

    /**
     * Convert the PublishedStatus enum to an array of key => value pairs for
     * use in a select dropdowns.
     */
    public static function statuses(): array
    {
        $statuses = [];
        foreach (PublishedStatus::cases() as $status) {
            $statuses[$status->value] = $status->label();
        }
        return $statuses;
    }
}
