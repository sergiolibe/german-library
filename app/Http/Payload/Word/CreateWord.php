<?php
declare(strict_types=1);

namespace App\Http\Payload\Word;

use App\Enum\WordGender;
use App\Http\Payload\BasePayload;
use Illuminate\Validation\Rules\Enum;

/* @method static static validate(\Illuminate\Http\Request $r) */
class CreateWord extends BasePayload
{
    protected static function rules(): array
    {
        return [
            'text'         => ['required', 'string', 'max:255'],
            'plural_text'  => ['string', 'max:255'],
            'english_text' => ['required', 'string', 'max:255'],
            'gender'       => ['required', new Enum(WordGender::class)],
            'image'        => ['string'],
        ];
    }

    public function __construct(
        public readonly string $text = '',
        public readonly string $plural_text = '',
        public readonly string $english_text = '',
        public readonly WordGender $gender = WordGender::MASCULINE,
        public readonly string $image = '',
    )
    {
    }
}