<?php

namespace Drupal\apodcall\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Http\ClientFactory;
use Drupal\Component\Serialization\Json;

class apodController extends ControllerBase {

  protected $clientFactory;

  public function __construct(ClientFactory $client_factory) {
    $this->clientFactory = $client_factory;
  }

  public static function create(ContainerInterface $container) {
    parent::create($container);
    return new static(
      $container->get('http_client_factory')
    );
  }

  public function getApod() {
    $client = $this->clientFactory->fromOptions([
      'headers' => [
        'Accept' => 'application/json',
      ],
    ]);
    $response = $client->get('https://api.nasa.gov/planetary/apod?api_key=n2dfLB1blQacHisOk3oNDeEplXoXOn82PnjAvjVv');
    $data = Json::decode($response->getBody());
    return [
      '#theme' => 'apod',
      '#data' => $data,
    ];
  }
}
