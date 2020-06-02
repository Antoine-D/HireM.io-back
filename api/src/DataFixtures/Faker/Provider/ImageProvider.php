<?php

namespace App\DataFixtures\Faker\Provider;

use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Faker;

class ImageProvider
{
    public static function image()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new ImagesGeneratorProvider($faker));
        $file = $faker->imageGenerator();
        $img64 = base64_encode(file_get_contents($file));
        unlink($file);
        return $img64;
    }
}
