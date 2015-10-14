<?php
/**
 * @file
 * Contains GetResource.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources;

trait GetResource {

  /**
   * @var \EclipseGc\DrupalOrg\Api\FactoryInterface
   */
  protected $factory;

  protected function getResource($resource_type, $id) {
    $response = $this->factory->request($resource_type, $id);
    return $this->factory->createObjectType($resource_type, $response->json());
  }

  public function getPagedResource($resource_type, array $params) {
    $response = $this->factory->pagedRequest($resource_type, $params);
    return $this->factory->createList($resource_type, $params, $response->json());
  }
}
