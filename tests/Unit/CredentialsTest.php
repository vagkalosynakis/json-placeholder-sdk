<?php

use Vkal\Classes\http\Credentials;

test('Correct Credentials', function () {
    $environment = 'demo';
    $clientId = 'clientid';
    $clientSecret = 'clientsecret';
    $credentials = new Credentials();

    $credentials->setEnv($environment);
    $credentials->setClientId($clientId);
    $credentials->setClientSecret($clientSecret);

    expect($credentials->getEnv())
        ->toBeString()
        ->toBe($environment)
        ->and($credentials->getClientId())
        ->toBeString()
        ->toBe($clientId)
        ->and($credentials->getClientSecret())
        ->toBeString()
        ->toBe($clientSecret);

});
