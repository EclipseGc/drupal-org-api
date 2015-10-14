<?php
/**
 * @file
 * Contains DrupalClient.php.
 */

namespace EclipseGc\DrupalOrg\Api;


use EclipseGc\DrupalOrg\Api\Resources\GetResource;
use EclipseGc\DrupalOrg\Api\Resources\ResourceList;
use GuzzleHttp\Client;

/**
 * Class DrupalClient
 * @package EclipseGc\DrupalOrg\Api
 */
class DrupalClient {

  use GetResource;

  /**
   * @return static
   */
  public static function create() {
    $factory = static::createFactory();
    return new static($factory);
  }

  /**
   * @return \EclipseGc\DrupalOrg\Api\FactoryInterface
   */
  public static function createFactory() {
    $guzzle = new Client([
      'base_url' => 'https://www.drupal.org/api-d7/',
      'defaults' => ['headers' => ['Accept' => 'application/json']]
    ]);
    return new Factory($guzzle);
  }

  /**
   * @param FactoryInterface $factory
   */
  public function __construct(FactoryInterface $factory) {
    $this->factory = $factory;
  }

  /**
   * Returns a user.
   *
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\User
   */
  public function getUser($id) {
    return $this->getResource('user', $id);
  }

  /**
   * Returns a node.
   *
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\Node\NodeInterface;
   */
  public function getNode($id) {
    return $this->getResource('node', $id);
  }

  /**
   * Returns a
   *
   * @param $moduleName
   *   Module name or node ID for a project.
   * @return \EclipseGc\DrupalOrg\Api\Resources\Node\ProjectModule
   */
  public function getModule($moduleName) {
    if (is_integer($moduleName)) {
      return $this->getNode($moduleName);
    }
    $moduleItems = $this->getPagedResource('node', ['field_project_machine_name' => $moduleName])->getItems();
    return reset($moduleItems);
  }


  /**
   * Returns all of the issues for a project.
   *
   * @param $moduleName
   *   You can pass in an integer or a string.
   * @return ResourceList
   */
  public function getIssuesForProject($moduleName) {
    $nid = $this->getModuleNodeId($moduleName);
    $issues = $this->getPagedResource('node', ['field_project' => $nid]);
    return $issues;
  }

  /**
   * Returns the releases for the specified module.
   *
   * @param $moduleName
   *   You can pass in an integer or a string.
   * @return ResourceList
   */
  public function getReleasesForProject($moduleName) {
    $nid = $this->getModuleNodeId($moduleName);
    $releases = $this->getPagedResource('node', ['type' => 'project_release', 'field_release_project' => $nid]);
    return $releases;
  }

  /**
   * Resolves a node ID from a module name or node ID.
   *
   * @param $mixed string|int
   *   Node machine name or ID.
   * @return int
   */
  public function getModuleNodeId($mixed) {
    return is_integer($mixed) ? $mixed : $this->getModule($mixed)->getNid();
  }

  /**
   * Returns a module name from a string or a node ID.
   *
   * @param $mixed string|int
   *   Node machine name or ID.
   * @return string
   */
  public function getModuleName($mixed) {
    if (!is_integer($mixed)) {
      return $mixed;
    }
    else {
      // @var $node ProjectModule
      $node = $this->getNode($mixed);
      return $node->getMachineName();
    }
  }

  /**
   * Get all of the projects, and optionally filter by some fields.
   *
   * @param array $options
   *  Here, you can place any extra fields by which to filter the results.
   * @return ResourceList
   * @see https://www.drupal.org/api
   */
  public function getProjects(array $options = array()) {
    $options = ['type' => 'project_module'] + $options;
    return $this->getPagedResource('node', $options);
  }
}
