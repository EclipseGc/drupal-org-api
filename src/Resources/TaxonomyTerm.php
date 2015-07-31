<?php
/**
 * @file
 * Contains Taxonomy Term object.
 */

namespace EclipseGc\DrupalOrg\Api\Resources;

use EclipseGc\DrupalOrg\Api\FactoryInterface;

/**
 * Class TaxonomyTerm
 * @package EclipseGc\DrupalOrg\Api\Resources
 */
class TaxonomyTerm implements ResourceInterface {

  use GetResource;

  /**
   * @var
   */
  protected $tid;
  /**
   * @var
   */
  protected $name;
  /**
   * @var
   */
  protected $description;
  /**
   * @var
   */
  protected $weight;
  /**
   * @var
   */
  protected $node_count;
  /**
   * @var
   */
  protected $url;
  /**
   * @var
   */
  protected $parent;
  /**
   * @var
   */
  protected $parents_all;

  /**
   * @param array $data
   * @return string
   */
  public static function getClass(array $data) {
    return get_called_class();
  }

  /**
   * @param \EclipseGc\DrupalOrg\Api\FactoryInterface $factory
   * @param $tid
   * @param $name
   * @param $description
   * @param $weight
   * @param $node_count
   * @param $url
   * @param $parent
   * @param $parents_all
   */
  public function __construct(FactoryInterface $factory, $tid, $name, $node_count = 0, $url = '', $parent = array(), $parents_all = array(), $weight = 0, $description = '') {
    $this->factory = $factory;
    $this->tid = $tid;
    $this->name = $name;
    $this->description = $description;
    $this->weight = $weight;
    $this->node_count = $node_count;
    $this->url = $url;
    $this->parent = $parent;
    $this->parents_all = $parents_all;
  }

  /**
   * @return mixed
   */
  public function getTid() {
    return $this->tid;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @return mixed
   */
  public function getWeight() {
    return $this->weight;
  }

  /**
   * @return mixed
   */
  public function getNodeCount() {
    return $this->node_count;
  }

  /**
   * @return mixed
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @return TaxonomyTerm
   */
  public function getParent() {
    return $this->getResource($this->parent['resource'], $this->parent['id']);
  }

  /**
   * @return array
   */
  public function getParentsAll() {
    $parents_all = [];
    foreach ($this->parents_all as $id => $parent) {
      $parents_all[$id] = $this->getResource($parent['resource'], $parent['id']);
    };
    return $parents_all;
  }
}