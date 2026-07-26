<?php

declare(strict_types=1);

require_once __DIR__ . "/validator.php";
require_once __DIR__ . "/response.php";

function validateProperty(array $data): array
{
    $property = [

        "title" => clean($data["title"] ?? ""),

        "description" => clean($data["description"] ?? ""),

        "property_type" => clean($data["property_type"] ?? ""),

        "room_type" => clean($data["room_type"] ?? ""),

        "gender_preference" => clean($data["gender_preference"] ?? "Unisex"),

        "monthly_rent" => (float)($data["monthly_rent"] ?? 0),

        "security_deposit" => (float)($data["security_deposit"] ?? 0),

        "address" => clean($data["address"] ?? ""),

        "city" => clean($data["city"] ?? ""),

        "state" => clean($data["state"] ?? ""),

        "pincode" => clean($data["pincode"] ?? ""),

        "amenities" => $data["amenities"] ?? []

    ];

    if (

        isEmpty(

            $property["title"],

            $property["description"],

            $property["property_type"],

            $property["room_type"],

            $property["address"],

            $property["city"],

            $property["state"],

            $property["pincode"]

        )

    ) {

        jsonResponse(false, "Please fill all required fields");

    }

    return $property;
}