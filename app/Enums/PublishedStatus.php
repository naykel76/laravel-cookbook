<?php

namespace App\Enums;

enum PublishedStatus: string
{
    case Draft = 'draft';
    case Review = 'pending_review';
    case Published = 'published';
    case Archived = 'archived';

    public function label()
    {
        return match ($this) {
            static::Draft => 'Draft',
            static::Review => 'Review',
            static::Published => 'Published',
            static::Archived => 'Archived',
        };
    }

    public function icon()
    {
        return match ($this) {
            static::Draft => 'icon.pencil',
            static::Review => 'icon.clock',
            static::Published => 'icon.check',
            static::Archived => 'icon.archive',
        };
    }

    public function color()
    {
        return match ($this) {
            static::Draft => 'purple',
            static::Review => 'yellow',
            static::Published => 'green',
            static::Archived => 'dark',
        };
    }
}
