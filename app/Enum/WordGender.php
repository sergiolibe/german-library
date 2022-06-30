<?php
declare(strict_types=1);

namespace App\Enum;

use Illuminate\Support\Facades\Log;

enum WordGender: string
{
    case MASCULINE = 'MASCULINE';
    case FEMININE = 'FEMININE';
    case NEUTRAL = 'NEUTRAL';
    case PLURAL = 'PLURAL';

    public function article(): string
    {
        return match ($this) {
            self::MASCULINE => 'der',
            self::FEMININE,
            self::PLURAL    => 'die',
            self::NEUTRAL   => 'das',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::MASCULINE => '#1876C7',
            self::FEMININE  => '#BD38B9',
            self::NEUTRAL   => '#308829',
            self::PLURAL    => '#D7A532',
        };
    }

    public function readable(): string
    {
        return ucfirst(strtolower($this->value));
    }

    public static function by_article(string $article): self
    {
        if ($article === 'der') return self::MASCULINE;
        if ($article === 'die') return self::FEMININE;
        if ($article === 'das') return self::NEUTRAL;
        Log::error('unsupported article `' . $article . '`. Default to Neutral `das`');
        return self::NEUTRAL;
    }
}
