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

  public function getResource($resource_type, $id) {
    $response = $this->factory->request($resource_type, $id);
    return $this->factory->createObjectType($resource_type, $response->json());
  }

}
