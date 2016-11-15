<?php
/**
 * @file
 * Contains DrupalClient.php.
 */

namespace EclipseGc\DrupalOrg\Api;


use EclipseGc\DrupalOrg\Api\Resources\GetResource;
use GuzzleHttp\Client;

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
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\User
   */
  public function getUser($id) {
    return $this->getResource('user', $id);
  }

  /**
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\Node\NodeInterface;
   */
  public function getNode($id) {
    return $this->getResource('node', $id);
  }

  /**
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\Node\ProjectIssue;
   */
  public function getProjectIssue($id) {
    return $this->getResource('project_issue', $id);
  }

  /**
   * @param $id
   * @return \EclipseGc\DrupalOrg\Api\Resources\TaxonomyTerm
   */
  public function getTaxonomyTerm($id) {
    return $this->getResource('taxonomy_term', $id);
  }
} 
