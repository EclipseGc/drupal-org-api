<?php
/**
 * @file
 * Contains FactoryInterface.php.
 */
namespace EclipseGc\DrupalOrg\Api;

interface FactoryInterface {

  /**
   * Determines the name of a class to instantiate for this type/data combo.
   *
   * @param $type
   *  The object type for which to return a class name.
   * @param array $data
   *  The data that will be passed into the class. This can also be used to
   *  change which class is instantiated.
   * @return string
   *  The class name to instantiate.
   */
  public function getObjectTypeClass($type, array $data);

  /**
   * Makes a request against the appropriate end point.
   *
   * @param $entity_type
   *  The type of entity.
   * @param $id
   *  The id of the entity.
   * @return \GuzzleHttp\Message\ResponseInterface
   * @throws \Exception
   */
  public function request($entity_type, $id);

  /**
   * Results in a full object for the provided data.
   *
   * @param $type
   *  The entity type for which to return an object from the request results.
   * @param array $data
   *  The returned request data. This can be used to change which class is
   *  instantiated.
   * @return \EclipseGc\DrupalOrg\Api\Resources\ResourceInterface
   */
  public function createObjectType($type, array $data = array());
}