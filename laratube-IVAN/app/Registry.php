<?php

namespace App;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class Registry
{
    static function Record(string $reference, string $localizador, string $data )
    {
        Register::create([
            'reference' => $reference,
            'localizador' => $localizador,
            'data' => $data
        ]);
    }

    static function Observer(string $reference, string $localizador, string $data )
    {
        $pointer = Pointer::all();

        Log::info('This is some useful information');

        if($pointer->isEmpty())
        {
            Pointer::create([
                'localizador' => $localizador,
            ]);
        }

        Observer::create([
            'reference' => $reference,
            'localizador' => $localizador,
            'data' => $data
        ]);
    }
}
