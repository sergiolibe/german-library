<?php
declare(strict_types=1);

namespace App\Http\Payload;

use App\Enum\NoteStatus;
use App\Enum\WordGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BasePayload
{
    protected const rules = [];
    public bool $is_error = false;
    /** @var array<string,string> $errors */
    public array $errors = [];

    protected static function rules(): array
    {
        return static::rules;
    }

    public static function validate(Request $r): static
    {
        $validator = Validator::make($r->all(), static::rules());
        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $i           = new static;
            $i->is_error = true;
            $i->errors   = $e->errors();
            return $i;
        }

        $casted = self::cast_payload($validator->validated());
        return new static(...$casted);
    }

    private static function cast_payload(array $data): array
    {
        $casted = [];
        foreach ($data as $k => $datum) {
            if (!property_exists(static::class, $k)) continue;
            $rf         = new \ReflectionProperty(static::class, $k);
            $type       = $rf->getType()->getName();
            $casted[$k] = match ($type) {
                'bool'            => (bool)$datum,
                'int'             => (int)$datum,
                'float'           => (float)$datum,
                'string'          => (string)$datum,
                'array'           => (array)$datum,
                \DateTime::class  => new \DateTime((string)$datum),
                WordGender::class  => WordGender::from($datum),
                NoteStatus::class => NoteStatus::from($datum),
                default           => throw new \RuntimeException("Type $type not supported"),
            };
        }
        return $casted;
    }
}