# Client agnostic sdk for jsonplaceholder mock api

### TO DOs

* Add todos here

## Check PHP compatibility with `PHP Code Sniffer`. Change version accordingly.

`./vendor/bin/phpcs -p . --standard=PHPCompatibility --ignore=*/vendor/* --runtime-set testVersion 7.4-`

## Usage

* Initialize the DI container inside the app bootstrap file.
* Get the `Credentials` from the container and set them using its setters.
* Get the `helper` from the container and set the credentials
* Use the `Helper` for anything.
* Optionally,Create an implementation of the `ClientInterface`.
* Bind its implementation inside the container to ensure the DI can resolve the Interface dependencies
* Set the client of the helper using `setClient`.
* Use the `Helper` for everything.

## Example

### Create a curl client class that implements the ClientInterface

```
<?php
use Vkal\Interfaces\ClientInterface;
use Vkal\Classes\http\Credentials;
use Vkal\Classes\http\Response;
use GuzzleHttp\Client;

class VkalClient implements ClientInterface {

  protected $credentials;
  protected $client;
  protected $headers;

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
    $response = $this->client->request(
      $method,
      $url,
      array_merge(
        ['verify' => false],
        ['form_params' => $body]
      )
    );
    return new Response(
      $response->getStatusCode(),
      $response->getBody()
    );
  }
}
```

### Create a bootstrap file (index or other entrypoint)

```
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Vkal\Classes\http\Credentials;
use Vkal\Classes\Container;
use Vkal\Classes\Helper;
use Vkal\Interfaces\ClientInterface;

require 'VkalClient.php';

$container = new Container();

// Get credentials for client
$credentials = $container->get(Credentials::class)
    ->setEnv('demo')
    ->setClientId('clientid')
    ->setClientSecret('clientsecret');

// Bind the implementation to the interface for DI resolution
$container->set(
    ClientInterface::class,
    function (Container $c) { return $c->get(VkalClient::class); }
);

// Resolve the helper
$helper = $container->get(Helper::class);
$helper->setCredentials($credentials);
$helper->setClient($container->get(VkalClient::class));

echo '<pre>';
print_r(json_decode($helper->posts()->get(1)->getBody(), true));
echo '</pre>';
```