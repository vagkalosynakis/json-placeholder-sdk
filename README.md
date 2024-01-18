# Client agnostic sdk for jsonplaceholder mock api

### TO DOs

* ~~Separate classes into more explicit namespaces (http, models, etc)~~
* ~~Add traits for models (canGet, canDelete, canUpdate, etc)~~
* ~~Remove client from final version~~
* Add tests

## Usage

### Create a bootstrap file (index.php, etc) with:

```
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Vkal\Classes\http\Credentials;

require 'VkalClient.php';
require 'Helper.php';

$credentials = new Credentials('demo', 'id', 'secret');
$vkal_client = new VkalClient($credentials);
$helper = new Helper($vkal_client);

$users = $helper->users->get();
```

### Create a Client to provide to the SDK like `guzzle`:

```
<?php
use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\http\Credentials;
use Vkal\Classes\http\Response;
use GuzzleHttp\Client;

class VkalClient implements ClientInterface {

  protected Credentials $credentials;
  protected mixed $client;
  protected array $headers;

  public function __construct(Credentials $credentials)
  {
    $this->headers = [];
    $this->credentials = $credentials;
    $this->client = new Client([]);
  }

  public function getToken(): string
  {
    return 'random token';
  }

  public function setHeaders(array $headers): self
  {
    $this->headers = $headers;
    return $this;
  }

  public function request(string $method, string $url, array $body = []): Response
  {
    $response = $this->client->request($method, $url, $body);
    return new Response(
      $response->getStatusCode(),
      $response->getBody()
    );
  }
}
```

### Create a helper function to implement use the SDK with:

```
<?php

use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\Models\Posts;
use Vkal\Classes\Models\Users;

class Helper {
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function posts() {
        return new Posts($this->client);
    }

    public function users() {
        return new Users($this->client);
    }
}
```