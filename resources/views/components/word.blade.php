<?php /** @var \App\Models\Word $word */ ?>
<div
        class="word-card"
        data-id="{{$word->id}}"
        data-text="{{$word->text}}"
        data-plural_text="{{$word->plural_text}}"
        data-english_text="{{$word->english_text}}"
        data-gender="{{$word->gender->readable()}}"
>
    <div class="container">
        @if(!empty($word->image))
            <img src="data:image/png;base64,{{$word->image}}" alt="{{$word->text}}" style="width:200px">
        @endif
        <span>
        {{$word->gender->article()}}
        <b>{{$word->text}}</b>
        </span>
        <br>
        <span style="color:{{$word->gender->color()}}">⬤ {{$word->gender->readable()}}</span>
        <br>
        <span>
            <span class="flag">🇬🇧</span> {{$word->english_text}}</span>
    </div>
</div>