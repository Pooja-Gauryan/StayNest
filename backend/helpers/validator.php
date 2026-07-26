<?php

declare(strict_types=1);

function clean(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function isEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isEmpty(...$fields): bool
{
    foreach ($fields as $field) {

        if (trim($field) === "") {

            return true;

        }
    }

    return false;
}