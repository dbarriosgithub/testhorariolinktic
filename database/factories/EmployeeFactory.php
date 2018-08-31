<?php

use Faker\Generator as Faker;

$factory->define(App\employees\Employee::class, function (Faker $faker) {
    return [
    	'cod_employee' =>$faker->ein,
		'firstName'=>$faker->firstName,
        'lastName'=>$faker->lastName,
        'phoneNumber'=>$faker->phoneNumber,
        'email'=>$faker->safeEmail,
        'address'=>$faker->streetAddress,
        'position'=>$faker->text(15),
    ];
});

 