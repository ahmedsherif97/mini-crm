<?php

use App\Models\User;
use Illuminate\Support\Str;
use App\Exceptions\ClassDoesntExists;
use App\Exceptions\CustomHttpException;
use Illuminate\Validation\ValidationException;

function user($guard = null) : ?User
{
    return auth($guard)->user();
}

function app_url($url = "")
{
    return 'https://api.mountruck.com' . $url;
}

function current_user_id()
{
    return auth()->id();
}

function seller()
{
    return auth()->user()->seller;
}

function nexmo_phone_format($phone)
{
    return preg_replace('/^(\+|00)/', '', $phone);
}

function seller_id(){
    $seller = seller();

    if ($seller)
        return $seller->id;
    return null;
}

function files_names($name)
{
    return array_filter(scandir(app_path($name)), function ($item) {
        return  $item !== '.' &&
                $item !== '..';
    });
}

function str_snake_to_upper_case(string $word)
{
    return Str::title(str_replace('_', ' ', $word));
}

function response_error($errors, $code = 0)
{
    throw new CustomHttpException($errors, $code);
}

function response_unauthorized($message = "You're not authorized for this action", $code = 401)
{
    throw new CustomHttpException(
        compact('message'),
        $code
    );
}

function transform_to_rate($value, $max = 5)
{
    switch (true) {
        case $value > $max:
            return $max;

        case $value < 0:
            return 0;

        default:
            return (int) round($value);
    }
}

function response_validation(array $messages)
{
    throw ValidationException::withMessages($messages);
}

function random_by($num = 6)
{
    $start = (int) str_repeat(1, $num);
    $end = (int) str_repeat(9, $num);
    return rand($start, $end);
}

function class_name($model, $prefix = 'App\\Models\\', $suffix = null)
{
    // TODO: throw exception if model doesn't exists
    // if ( !class_exists($model) ) {
    //     throw new ClassDoesntExists;
    // }

    if (gettype($model) == 'object') {
        $model = (new ReflectionClass($model))->getShortName();
    }
    if (gettype($model) === 'string') {
        $model = Str::studly($model);

        if (Str::startsWith($model, 'App\\Models\\')) {
            $model = last_part_of($model);
        }

        $model = Str::singular(ucfirst($model));

        if (Str::startsWith($prefix, 'Resources')) {
            $prefix = "App\Http\\{$prefix}\\";
            $suffix .= 'Resource';
        }
    }

    return $prefix . $model . $suffix;
}

function last_part_of($string, $delimiter = '\\')
{
    $array = explode($delimiter, $string);

    $array = collect($array)->map(function ($syllable) use ($delimiter) {
        return str_replace($delimiter, "", $syllable);
    })->toArray();

    return end($array);
}

function get_value(?array $payload, string $key)
{
    return array_key_exists($key, $payload) ? $payload[$key] : null;
}

function model_singular($modelname, $separator = '_')
{
    $modelname = strtolower($modelname);

    if (collect(config('app.models.singularnames'))->contains($modelname)) {
        return Str::slug($modelname, $separator);
    }

    return Str::slug(Str::singular($modelname), $separator);
}

// function set_boolean($value = null, $default = true)
// {
//     return filter_var($value, $default, FILTER_VALIDATE_BOOL);
// }

function per_page($perPage = 15)
{
    if (request('per_page') == 'all') {
        return 999;
    }

    return request('per_page') ? (int) request('per_page') : $perPage;
}

function delete_error_response($name)
{
    return response([
        'message' => __('services.delete_errors', [
            'attribute' => $name,
        ]),
    ], 403);
}

function sum(... $numbers) {
    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }
    return $sum;
}

function value_to_bool($value)
{
    return filter_var($value, FILTER_VALIDATE_BOOL);
}

function get_conversion_rate()
{
    $currency = config('exchange-rates.currency');
    return config("exchange-rates.available_currencies.$currency");
}
