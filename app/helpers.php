<?php
    /* Helper functions for our application */

    // Generates meta data and returns as an array.
    if (! function_exists('gen_meta')) {
        function gen_meta(string $title=null, string $description=null, string $robots=null, string $image=null, string $web_type=null, string $key_words=null) {
            return [
                'title' => ($title) ? $title : config('meta.defaults.title'),
                'description' => ($description) ? $description : config('meta.defaults.description'),
                'image' => ($image) ? $image : config('meta.defaults.image'),
                'web_type' => ($web_type) ? $web_type : config('meta.defaults.web_type'),
                'key_words' => ($key_words) ? $key_words : config('meta.defaults.key_words')
            ];
        }
    }