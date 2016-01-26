<?php
return [
    'createReservation' => [
        'type' => 2,
        'description' => 'Permission to create a reservation',
    ],
    'updateReservation' => [
        'type' => 2,
        'description' => 'Permission to update a reservation',
    ],
    'operator' => [
        'type' => 1,
        'children' => [
            'createReservation',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'operator',
            'updateReservation',
        ],
    ],
];
