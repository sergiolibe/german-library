<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">

    <title>Words</title>
</head>
<body>

<input
        type="text"
        class="input-search"
        name="search_input"
        placeholder="Search something :)"
>
<span class="clean-input">🗑</span>

@foreach($words as $word)
    @include('components.word', ['word'=>$word])
@endforeach

{{--<script src="https://cdn.jsdelivr.net/npm/fuzzysort@1.9.0/fuzzysort.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
<script>
    let input = document.querySelector('.input-search');
    let words = document.querySelectorAll('.word-card');

    // const dataset_keys = ['text', 'plural_text', 'english_text', 'gender',]
    if (input !== null && typeof Fuse !== undefined) input.addEventListener('input', function (evt) {

        // console.log(evt, this.value);
        let search_text = this.value.trim();
        words.forEach(word => {
            if (search_text.length === 0) {
                word.classList.remove('hidden');
                return;
            }
            let dataset   = word.dataset;
            const options = {includeScore: true, ignoreLocation: true};

            let list_to_match = [dataset.text, dataset.plural_text, dataset.english_text, dataset.gender];

            let special_matches      = ["ß", "β", "Ä", "ä", "Ö", "ö", "Ü", "ü"];
            let special_replacements = ["#", "#", "$", "$", "%", "%", "&", "&"];
            for (let i = 0; i < special_matches.length; i++) {
                let special_match       = special_matches[i];
                let special_replacement = special_replacements[i];
                if (search_text.includes(special_match)) search_text = search_text.replaceAll(special_match, special_replacement);

                for (let j = 0; j < list_to_match.length; j++) {
                    if (list_to_match[j].includes(special_match)) list_to_match[j] = list_to_match[j].replaceAll(special_match, special_replacement);
                }
            }
            // console.log(search_text, list_to_match);

            const fuse = new Fuse(list_to_match, options)

            const results = fuse.search(search_text);
            word.classList.add('hidden');

            // console.log(dataset.id, results);

            // Score is better when closer to zero
            for (let i = 0; i < results.length; i++) {
                let result    = results[i];
                            console.log(dataset.id, result);
                let max_score = 0.3;
                if (search_text.length === 1) max_score = 0.30;
                if (result.refIndex === 3) max_score = 0.05;
                if (result.score <= max_score) {
                    word.classList.remove('hidden');
                    break;
                }
            }
        })
    });

    let trash_icon = document.querySelector('.clean-input');
    if (trash_icon !== null) trash_icon.addEventListener('click', function (evt) {
        if (input !== null) {
            input.value = '';
            input.dispatchEvent(new Event('input', {bubbles: true}));
        }
    });

</script>
</body>
</html>