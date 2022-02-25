<?php

use App\Models\Country;

function getLocation(string $ip = "68.10.149.45") {
    $url = 'https://iptoearth.expeditedaddons.com/?api_key=' . config('iptoearth.key') . '&ip=' . $ip;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    try {
        $response = curl_exec($ch);
        curl_close($ch);
    } catch (\Throwable $e) {
    }

    return json_decode($response, false);
}

function getClientCountry(): ?Country
{
    request()->ip();

    $loc = getLocation(request()->getClientIp());
    $cc = $loc->country_code;

    return Country::where('country_code', '=', $cc)->first();
}
