<?php

namespace Database\Seeders;

use App\Enum\WordGender;
use App\Models\Auftrag;
use App\Models\AuftragStatus;
use App\Models\DmcDatei;
use App\Models\DmcDaten;
use App\Models\Druckerei;
use App\Models\EnumStatus;
use App\Models\Produktart;
use App\Models\Status;
use App\Models\Word;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $words = [
            ['english' => 'mother', 'german' => 'die Mutter',],
            ['english' => 'father', 'german' => 'der Vater',],
            ['english' => 'sister', 'german' => 'die Schwester',],
            ['english' => 'brother', 'german' => 'der Bruder',],
            ['english' => 'child', 'german' => 'das Kind',],
            ['english' => 'aunt', 'german' => 'die Tante',],
            ['english' => 'uncle', 'german' => 'der Onkel',],
            ['english' => 'grandmother', 'german' => 'die Groβmutter',],
            ['english' => 'grandfather', 'german' => 'der Groβvater',],
            ['english' => 'female cousin', 'german' => 'die Cousine',],
            ['english' => 'male cousin', 'german' => 'der Cousin',],
            ['english' => 'boyfriend', 'german' => 'der Freund',],
            ['english' => 'girlfriend', 'german' => 'die Freundin',],
            ['english' => 'husband', 'german' => 'der Mann',],
            ['english' => 'wife', 'german' => 'die Frau',],
            ['english' => 'male colleague', 'german' => 'der Kollege',],
            ['english' => 'female colleague', 'german' => 'die Kollegin',],
            ['english' => 'male partner', 'german' => 'der Partner',],
            ['english' => 'female partner', 'german' => 'die Partnerin',],
            ['english' => 'house', 'german' => 'das Haus',],
            ['english' => 'bed', 'german' => 'das Bett',],
            ['english' => 'table', 'german' => 'der Tisch',],
            ['english' => 'door', 'german' => 'die Tür',],
            ['english' => 'pillow/cushion', 'german' => 'das Kissen',],
            ['english' => 'window', 'german' => 'das Fenster',],
            ['english' => 'wall', 'german' => 'die Wand',],
            ['english' => 'floor', 'german' => 'der Boden',],
            ['english' => 'bedroom', 'german' => 'das Schlafzimmer',],
            ['english' => 'bathroom', 'german' => 'das Badezimmer',],
            ['english' => 'kitchen', 'german' => 'die Küche',],
            ['english' => 'living room', 'german' => 'die Wohnung',],
            ['english' => 'basement', 'german' => 'der Keller',],
            ['english' => 'couch', 'german' => 'die Couch',],
            ['english' => 'chair', 'german' => 'der Stuhl',],
            ['english' => 'sink', 'german' => 'das Waschbecken',],
            ['english' => 'toilet', 'german' => 'die Toilette',],
            ['english' => 'bathtub', 'german' => 'die Badewanne',],
            ['english' => 'shower', 'german' => 'die Dusche',],
            ['english' => 'lamp', 'german' => 'die Lampe',],
            ['english' => 'trash', 'german' => 'der Müll',],
            ['english' => 'refrigerator', 'german' => 'der Kühlschrank',],
            ['english' => 'stove', 'german' => 'der Herd',],
            ['english' => 'microwave', 'german' => 'der Mikrowellenherd',],
            ['english' => 'dishwasher', 'german' => 'die Geschirrspülmaschine',],
            ['english' => 'cabinet', 'german' => 'das Kabinett',],
            ['english' => 'car', 'german' => 'das Auto',],
            ['english' => 'truck', 'german' => 'der Lustkraftwagen (LKW)',],
            ['english' => 'bus', 'german' => 'der Bus',],
            ['english' => 'plane', 'german' => 'das Flugzeug',],
            ['english' => 'train', 'german' => 'der Zug',],
            ['english' => 'boat', 'german' => 'das Boot',],
            ['english' => 'taxi', 'german' => 'das Taxi',],
            ['english' => 'school bus', 'german' => 'der Schulbus',],
            ['english' => 'ticket', 'german' => 'das Ticket',],
            ['english' => 'pass', 'german' => 'der Pass',],
            ['english' => 'semi truck', 'german' => 'der Sattelzug',],
            ['english' => 'city', 'german' => 'die Stadt',],
            ['english' => 'country', 'german' => 'das Land',],
            ['english' => 'mountain', 'german' => 'der Berg',],
            ['english' => 'plains', 'german' => 'die Ebenen',],
            ['english' => 'desert', 'german' => 'die Wüste',],
            ['english' => 'school', 'german' => 'die Schule',],
            ['english' => 'work', 'german' => 'die Arbeit',],
            ['english' => 'homeland', 'german' => 'das Heimatland',],
        ];
        foreach ($words as $word) {
            $article = strtok($word['german'], ' ');
            $gender  = WordGender::by_article($article);
            $german  = str_replace($article . ' ', '', $word['german']);

            $w               = new Word;
            $w->text         = $german;
            $w->english_text = $word['english'];
            $w->gender       = $gender;
            $w->save();
        }
    }
}

