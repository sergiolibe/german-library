<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Druckerei;
use App\Models\Produktart;
use Illuminate\Http\JsonResponse;

class CatalogueController extends Controller
{
    public function get_druckereis(): JsonResponse
    {
        return $this->_200(Druckerei::all());
    }

    public function get_produktarts(): JsonResponse
    {
        return $this->_200(Produktart::all());
    }

    public function get_statuses(): JsonResponse
    {
        $ad_text = 'some AD text';
        return $this->_200([
            ['kuerzel' => 'O', 'beschreibung' => 'Order without DMC', 'anzeige' => $ad_text,],
            ['kuerzel' => 'N', 'beschreibung' => 'New', 'anzeige' => $ad_text,],
            ['kuerzel' => 'L', 'beschreibung' => 'send', 'anzeige' => $ad_text,],
            ['kuerzel' => 'E', 'beschreibung' => 'received successfully, DMC present', 'anzeige' => $ad_text,],
            ['kuerzel' => 'W', 'beschreibung' => 'technical error, request is repeated cyclically', 'anzeige' => $ad_text,],
            ['kuerzel' => 'F', 'beschreibung' => 'error, see text', 'anzeige' => $ad_text,],
            ['kuerzel' => 'D', 'beschreibung' => 'DMC delete requested', 'anzeige' => $ad_text,],
            ['kuerzel' => 'Z', 'beschreibung' => 'DMC available as ZIP file', 'anzeige' => $ad_text,],
            ['kuerzel' => 'S', 'beschreibung' => 'Rewrite ZIP file', 'anzeige' => $ad_text,],
            ['kuerzel' => 'H', 'beschreibung' => 'ZIP file error', 'anzeige' => $ad_text,],
        ]);
    }
}