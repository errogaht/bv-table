<?php

return [
    'field_phone'          => 'Телефон',
    'field_email'          => 'Email',
    'field_city'           => 'Город',
    'field_metro'          => 'Метро',
    'field_age'            => 'Возраст',
    'field_how_long'       => 'Как давно знаком с СК',
    'field_preferred_date' => 'В какие дни удобно',
    'field_source'         => 'Откуда',
    'field_comment'        => 'Комментарий',

    'status_label'=> [
        \App\Contact::STATUS_NEW     => 'Новый',
        \App\Contact::STATUS_WORK    => 'Обработка',
        \App\Contact::STATUS_SUCCESS => 'Посещает',
        \App\Contact::STATUS_FAIL    => 'Отказ',
    ],

    'status_style'=> [
        \App\Contact::STATUS_NEW     => 'success',
        \App\Contact::STATUS_WORK    => 'warning',
        \App\Contact::STATUS_SUCCESS => 'info',
        \App\Contact::STATUS_FAIL    => 'danger',
    ],

    'status_update' => [
        \App\Contact::STATUS_NEW     => 'Вернул в Новые',
        \App\Contact::STATUS_WORK    => 'Взял в Обработку',
        \App\Contact::STATUS_SUCCESS => 'Отметил, что Посещает',
        \App\Contact::STATUS_FAIL    => 'Отказ',
    ]
    
    
];