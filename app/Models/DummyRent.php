<?php

namespace App\Models;

class DummyRent
{
    public static function all()
    {
        return [
            [
                'id' => 1,
                'customer_name' => 'Budi',
                'car' => 'Toyota Avanza',
                'date' => '2025-04-10',
            ],
            [
                'id' => 2,
                'customer_name' => 'Siti',
                'car' => 'Honda Brio',
                'date' => '2025-04-11',
            ],
            [
                'id' => 3,
                'customer_name' => 'Agus',
                'car' => 'Suzuki Ertiga',
                'date' => '2025-04-12',
            ],
        ];
    }
}
