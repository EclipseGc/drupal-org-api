<?php
/**
 * @file
 * Contains Factory.php.
 */

namespace EclipseGc\DrupalOrg\Api;

use GuzzleHttp\Client;

class Factory implements FactoryInterface {

  protected $objectTypes = array(
    'user' => '\EclipseGc\DrupalOrg\Api\Resources\User',
    'node' => '\EclipseGc\DrupalOrg\Api\Resources\Node',
    'taxonomy_term' => '\EclipseGc\DrupalOrg\Api\Resources\TaxonomyTerm',
    'project_issue' => '\EclipseGc\DrupalOrg\Api\Resources\Node\ProjectIssue',
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

  public function createObjectType($type, array $data = array()) {
    $data = (isset($data['list'])) ? $data['list'][0] : $data;
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
    switch ($entity_type) {
        case 'project_issue':
            $request = $this->client()->get(['node.json?type={entity_type}&nid={id}', ['entity_type' => $entity_type, 'id' => $id]]);
            break;
        default:
            $request = $this->client()->get(['{entity_type}/{id}', ['entity_type' => $entity_type, 'id' => $id]]);
            break;
    }
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
