<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Payload\Word\CreateWord;
use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WordService
{
    public function create(CreateWord $payload): Word
    {
        $e               = new Word;
        $e->text         = $payload->text;
        $e->plural_text  = $payload->plural_text;
        $e->english_text = $payload->english_text;
        $e->gender       = $payload->gender->value;
        $e->image        = $payload->image;
        $e->save();

        return $e;
    }

    /**
     * @return Collection<int, static>
     */
    public function find_all(): Collection
    {
        return Word::all();
    }

    public function find_by_id(int $id): Word
    {
        $e = Word::where(['id' => $id])->first();
        if (is_null($e)) throw (new ModelNotFoundException)->setModel(Word::class);
        return $e;
    }

    public function find_by_text(string $text): Word
    {
        $e = Word::where(['text' => $text])->first();
        if (is_null($e)) throw (new ModelNotFoundException)->setModel(Word::class);
        return $e;
    }
}