<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Мовні ресурси перевірки введення
    |--------------------------------------------------------------------------
    |
    | Наступні ресурси містять стандартні повідомлення перевірки коректності
    | введення даних. Деякі з цих правил мають декілька варіантів, як,
    | наприклад, size. Ви можете змінити будь-яке з цих повідомлень.
    |
    */
    'accepted' => 'Ви повинні прийняти :attribute.',
    'active_url' => 'Поле :attribute не є правильним URL.',
    'after' => 'Поле :attribute має містити дату не раніше :date.',
    'alpha' => 'Поле :attribute має містити лише літери.',
    'alpha_dash' => 'Поле :attribute має містити лише літери, цифри та підкреслення.',
    'alpha_num' => 'Поле :attribute має містити лише літери та цифри.',
    'array' => 'Поле :attribute має бути масивом.',
    'before' => 'Поле :attribute має містити дату не пізніше :date.',
    'between' => [
        'numeric' => 'Поле :attribute має бути між :min та :max.',
        'file' => 'Розмір файлу в полі :attribute має бути не менше :min та не більше :max кілобайт.',
        'string' => 'Текст в полі :attribute має бути не менше :min та не більше :max символів.',
        'array' => 'Поле :attribute має містити від :min до :max елементів.',
    ],
    'boolean' => 'Поле :attribute повинне містити логічний тип.',
    'confirmed' => 'Поле :attribute не збігається з підтвердженням.',
    'date' => 'Поле :attribute не є датою.',
    'date_format' => 'Поле :attribute не відповідає формату :format.',
    'different' => 'Поля :attribute та :other повинні бути різними.',
    'digits' => 'Довжина цифрового поля :attribute повинна дорівнювати :digits.',
    'digits_between' => 'Довжина цифрового поля :attribute повинна бути від :min до :max.',
    'email' => 'Поле :attribute повинне містити коректну електронну адресу.',
    'filled' => 'Поле :attribute є обов\'язковим для заповнення.',
    'exists' => 'Вибране для :attribute значення не коректне.',
    'image' => 'Поле :attribute має містити зображення.',
    'in' => 'Вибране для :attribute значення не коректне.',
    'integer' => 'Поле :attribute має містити ціле число.',
    'ip' => 'Поле :attribute має містити IP адресу.',
    'json' => 'Дані поля :attribute мають бути в форматі JSON.',
    'max' => [
        'numeric' => 'Поле :attribute має бути не більше :max.',
        'file' => 'Файл в полі :attribute має бути не більше :max кілобайт.',
        'string' => 'Текст в полі :attribute повинен мати довжину не більшу за :max.',
        'array' => 'Поле :attribute повинне містити не більше :max елементів.',
    ],
    'mimes' => 'Поле :attribute повинне містити файл одного з типів: :values.',
    'min' => [
        'numeric' => 'Поле :attribute повинне бути не більше :min.',
        'file' => 'Розмір Файлу в полі :attribute має бути не меншим :min кілобайт.',
        'string' => 'Текст в полі :attribute повинен містити не менше :min символів.',
        'array' => 'Поле :attribute повинне містити не менше :min елементів.',
    ],
    'not_in' => 'Вибране для :attribute значення не коректне.',
    'numeric' => 'Поле :attribute повинно містити число.',
    'regex' => 'Поле :attribute має хибний формат.',
    'required' => 'Поле :attribute є обов\'язковим для заповнення.',
    'required_if' => 'Поле :attribute є обов\'язковим для заповнення, коли :other є рівним :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'Поле :attribute є обов\'язковим для заповнення, коли :values вказано.',
    'required_with_all' => 'Поле :attribute є обов\'язковим для заповнення, коли :values вказано.',
    'required_without' => 'Поле :attribute є обов\'язковим для заповнення, коли :values не вказано.',
    'required_without_all' => 'Поле :attribute є обов\'язковим для заповнення, коли :values не вказано.',
    'same' => 'Поля :attribute та :other мають співпадати.',
    'size' => [
        'numeric' => 'Поле :attribute має бути довжини :size.',
        'file' => 'Файл в полі :attribute має бути розміром :size кілобайт.',
        'string' => 'Текст в полі :attribute повинен містити :size символів.',
        'array' => 'Поле :attribute повинне містити :size елементів.',
    ],
    'timezone' => 'Поле :attribute повинне містити коректну часову зону.',
    'unique' => 'Таке значення поля :attribute вже існує.',
    'url' => 'Формат поля :attribute неправильний.',
    /*
    |--------------------------------------------------------------------------
    | Додаткові ресурси для перевірки введення
    |--------------------------------------------------------------------------
    |
    | Тут Ви можете вказати власні ресурси для підтвердження введення,
    | використовуючи формат "attribute.rule", щоб дати назву текстовим змінним.
    | Так ви зможете легко додати текст повідомлення для заданого атрибуту.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Власні назви атрибутів
    |--------------------------------------------------------------------------
    |
    | Наступні правила дозволяють налаштувати заміну назв полів введення
    | для зручності користувачів. Наприклад, вказати "Електронна адреса" замість
    | "email".
    |
    */
    'attributes' => [
        'title' => '<strong>Заголовка</strong>',
        'description' => '<strong>Опис</strong>',
        'date' => '<strong>Дата</strong>',
        'chapter_id' => '<strong>Розділу</strong>',
        'chapter' => '<strong>Розділу</strong>',
        'is_topical' => '<strong>Актуально до</strong>',
        'top_date_end' => '<strong>Дата актуально до</strong>',
        'date_start' => '<strong>Дата початку</strong>',
        'date_end' => '<strong>Дата закінчення</strong>',
        'image' => '<strong>Зображення</strong>',
        'important' => '<strong>Важливо</strong>',
        'pos' => '<strong>Позицiя</strong>',
        'filename' => '<strong>Файл</strong>',
        'type_menu' => '<strong>Тип меню</strong>',
        'parent_id' => '<strong>Батькiвський вузол</strong>',
        'page_id' => '<strong>Контент сторiнки</strong>',
        'url' => '<strong>URL</strong>',
        'redirect_url' => '<strong>Перенаправлення URL</strong>',
        'is_redirectable' => '<strong>Перехід на вказану сторінку</strong>',
        'content' => '<strong>Зміст</strong>',
        'necessarily' => '<strong>Зображення - не обов\'язково</strong>',
        'email' => '<strong>E-mail</strong>',
        'name' => '<strong>Iм\'я</strong>',
        'group' => '<strong>Группи</strong>',
        'password' => '<strong>Пароль</strong>',
        'password_confirmation' => '<strong>Підтвердіть Пароль</strong>',
    ],
];