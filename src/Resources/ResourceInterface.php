<?php
/**
 * @file
 * Contains ResourceInterface.php.
 */
namespace EclipseGc\DrupalOrg\Api\Resources;

interface ResourceInterface {

  public static function getClass(array $data);

  public function getResource($resource_type, $id);

}