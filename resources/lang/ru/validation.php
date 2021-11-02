<?php

return [
    'user' => [
        'name' => [
            'required' => 'Передайте имя',
        ],
        'surname' => [
            'required' => 'Передайте фамилию',
        ],
        'patronymic' => [
            'required' => 'Передайте отчество',
        ],
        'password' => [
            'min' => 'Минимальное количество символов должно составлять 6',
            'required' => 'Передайте пароль',
            'confirmed' => 'Подтвердите пароль',
            'regex' => 'Неверный формат пароля',
        ],
        'email' => [
            'required' => 'Передайте почту',
            'unique' => 'Пользователь с такой почтой уже существует',
            'email' => 'Введите правильный тип почты',
        ],
        'date_of_birth' => [
            'required' => 'Передайте дату вашего рождения',
        ]
    ],
    'smile' => [
        'content' => [
            'required' => 'Передайте смайлик'
        ]
    ],
    'image' => [
        'content' => [
            'required' => 'Передайте данные'
        ]
    ],
];
