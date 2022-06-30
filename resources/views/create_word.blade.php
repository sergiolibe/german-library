<?php

use App\Enum\WordGender;

$genders = [WordGender::MASCULINE, WordGender::FEMININE, WordGender::NEUTRAL,];
?>

Add new word
<br>
<br>
<form method="POST" action="/api/words">
    <input type="text" name="text" placeholder="text" required> : text<br>
    <input type="text" name="english_text" placeholder="english_text" required> : english_text<br>
    <select name="gender">
        <?php /** @var WordGender $gender */ ?>
        @foreach($genders as $gender)
            <option value="{{$gender->value}}">{{$gender->readable()}} ({{$gender->article()}})</option>
        @endforeach
    </select> : gender<br><br><br>
    <button type="submit">Create</button>
</form>