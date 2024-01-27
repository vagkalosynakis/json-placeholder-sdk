# Client agnostic sdk for jsonplaceholder mock api

### TO DOs

* ~~Separate classes into more explicit namespaces (http, models, etc)~~
* ~~Add traits for models (canGet, canDelete, canUpdate, etc)~~
* ~~Remove client from final version~~
* Add tests (Earlier supported version?)
* ~~Merge headers with body in client requests~~

## Check PHP compatibility with `PHP Code Sniffer`. Change version accordingly.

`./vendor/bin/phpcs -p . --standard=PHPCompatibility --ignore=*/vendor/* --runtime-set testVersion 7.4-`

## Usage

* Initialize the DI container inside the app bootstrap file.
* Get the `Credentials` from the container and set them using its setters.
* Create an implementation of the `ClientInterface`.
* Bind its implementation inside the container to ensure the DI can resolve the Interface dependencies
* Get the `Helper` from the container.
* Use the `Helper` for everything.

## Example

### Create a bootstrap file (index.php, etc) with:

```
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Vkal\Classes\http\Credentials;
use Vkal\Classes\Container;
use Vkal\Classes\Models\Helper;
use Vkal\Interfaces\ClientInterface;

require 'VkalClient.php';

$container = new Container();

// Get credentials for client
$credentials = $container->get(Credentials::class)
    ->setEnv('demo')
    ->setClientId('clientid')
    ->setClientSecret('clientsecret');

// Create a client that implements the ClientInterface
$vkal_client = new VkalClient($credentials);

// Bind the implementation to the interface for DI resolution
$container->set(
    ClientInterface::class,
    function (Container $c) { return $c->get(VkalClient::class); }
);

// Resolve the client
$helper = $container->get(Helper::class);

$user = $helper->users()->get(1);
echo '<pre>';
print_r(json_decode($user->getBody(), true));
echo '</pre>';
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
    $this->client->setDefaultOption('headers', $this->headers);
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