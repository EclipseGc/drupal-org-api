<?php
/**
 * @file
 * Contains Factory.php.
 */

namespace EclipseGc\DrupalOrg\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

class Factory implements FactoryInterface {

  protected $objectTypes = array(
    'user' => '\EclipseGc\DrupalOrg\Api\Resources\User',
    'node' => '\EclipseGc\DrupalOrg\Api\Resources\Node',
    'taxonomy_term' => '\EclipseGc\DrupalOrg\Api\Resources\TaxonomyTerm',
  );

  function __construct(Client $client) {
    $this->client($client);
  }

  public function getObjectTypeClass($type, array $data) {
    if (isset($this->objectTypes[$type])) {
      $class = $this->objectTypes[$type];
      return $class::getClass($data);
    }
    throw new \Exception(sprintf('No object type %s', $type));
  }

  public function createList($type, $params, array $data = array()) {
    $reflector = new \ReflectionClass('\EclipseGc\DrupalOrg\Api\Resources\ResourceList');
    $data['type'] = $type;
    $data['params'] = $params;
    if (!isset($data['factory'])) {
      $data['factory'] = $this;
    }
    $arguments = [];
    foreach ($reflector->getMethod('__construct')->getParameters() as $param) {
      $param_name = $param->getName();
      if (array_key_exists($param_name, $data)) {
        $arguments[] = $data[$param_name];
      }
    }
    return $reflector->newInstanceArgs($arguments);
  }

  public function createObjectType($type, array $data = array()) {
    $objectClass = $this->getObjectTypeClass($type, $data);
    $reflector = new \ReflectionClass($objectClass);
    if (!isset($data['factory'])) {
      $data['factory'] = $this;
    }
    $arguments = [];
    foreach ($reflector->getMethod('__construct')->getParameters() as $param) {
      $param_name = $param->getName();
      if (array_key_exists($param_name, $data)) {
        $arguments[] = $data[$param_name];
      }
    }
    return $reflector->newInstanceArgs($arguments);
  }

  /**
   * @param $entity_type
   * @param $id
   * @return \GuzzleHttp\Message\ResponseInterface
   * @throws \Exception
   */
  public function request($entity_type, $id) {
    $request = $this->client()->get(['{entity_type}/{id}', ['entity_type' => $entity_type, 'id' => $id]]);
    if ($request->getStatusCode() != 200) {
      throw new \Exception(sprintf('Status code was not OK. %d returned instead.', $request->getStatusCode()));
    }
    return $request;
  }

  public function pagedRequest($entity_type, array $params, $page = 0) {
    if (!isset($params['page'])) {
      $params['page'] = $page;
    }
    // You have to add the .json or it doesn't work?
    $request = $this->client()->createRequest('GET', $entity_type . '.json');
    // Add our request params.
    $request->getQuery()->merge($params);

    var_dump($request->getUrl());

    $request = $this->client()->send($request);

    if ($request->getStatusCode() != 200) {
      throw new \Exception(sprintf('Status code was not OK. %d returned instead.', $request->getStatusCode()));
    }
    return $request;

  }

  /**
   * Statically stores and returns a guzzle client.
   *
   * The Guzzle client is quite large and we really don't want to deal with it
   * during debugging, so we store it statically in a method to hide it away.
   *
   * @param \GuzzleHttp\Client $new_client
   *
   * @return \GuzzleHttp\Client
   */
  protected function client(Client $new_client = NULL) {
    static $client;
    if (!is_null($new_client)) {
      $client = $new_client;
    }
    return $client;
  }

} 