<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Payload\Word\CreateWord;
use App\Services\WordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function __construct(
        private readonly WordService $word_service,
    )
    {
    }

    ////////////////////////////////////////////////// WEB

    public function all(): \Illuminate\View\View
    {
        $ws = $this->word_service->find_all();
        return view('words', ['words' => $ws]);
    }

    public function by_id(int $id): \Illuminate\View\View
    {
        $w = $this->word_service->find_by_id($id);
        return view('word', ['word' => $w]);
    }

    public function by_text(string $text): \Illuminate\View\View
    {
        $w = $this->word_service->find_by_text($text);
        return view('word', ['word' => $w]);
    }

    public function add_new(): \Illuminate\View\View
    {
        return view('create_word');
    }

    ////////////////////////////////////////////////// API
    ///
    public function api__create_word(Request $r): JsonResponse
    {
        $p = CreateWord::validate($r);
        if ($p->is_error) return $this->bad_request($p->errors);

        $word = $this->word_service->create($p);

        return $this->api__by_id($word->id);
    }

    public function api__all(): JsonResponse
    {
        $ws = $this->word_service->find_all();
        return $this->_200($ws);
    }

    public function api__by_id(int $id): JsonResponse
    {
        $w = $this->word_service->find_by_id($id);
        return $this->_200($w);
    }

    public function api__by_text(string $text): JsonResponse
    {
        $w = $this->word_service->find_by_text($text);
        return $this->_200($w);
    }
}