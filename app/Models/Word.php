<?php
declare(strict_types=1);

namespace App\Models;

use App\Enum\WordGender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Word
 * @property int             $id
 * @property string          $text
 * @property string          $plural_text
 * @property string          $english_text
 * @property WordGender      $gender
 * @property string          $image
 * @property ?\Carbon\Carbon $created_at
 * @property ?\Carbon\Carbon $updated_at
 * @property ?\Carbon\Carbon $deleted_at
 */
class Word extends Model
{
    use SoftDeletes;

    protected $casts = [
        'gender' => WordGender::class,
    ];
}
