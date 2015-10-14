<?php

namespace EclipseGc\DrupalOrg\Api\Resources;

use EclipseGc\DrupalOrg\Api\FactoryInterface;

class ResourceList implements PagedInterface {

  use GetResource;

  protected $approxResults;
  protected $totalResults;
  protected $loadedPages;
  protected $loadedResults;
  protected $list;
  protected $type;
  protected $params;

  public function __construct(FactoryInterface $factory, $type, $params, $self, $list, $first = '', $last = '', $next = '') {
    $this->params = $params;
    $this->factory = $factory;
    $this->type = $type;
    $this->list = $list;
    $this->loadedResults = count($this->list);
    preg_match('#page=(\d+)#', $last, $matches);
    $this->lastPage = $matches[1];
    $this->approxResults = $this->lastPage + 1 * 100;
    $this->loadedPages = 0;
  }

  public function getItems() {
    $items = [];
    foreach ($this->list as $listItem) {
      $items[] = $this->factory->createObjectType($this->type, $listItem);
    }
    return $items;
  }

  public function getTotalResults() {
    if ($this->totalResults === NULL) {
      $results = $this->factory->pagedRequest($this->type, $this->params, $this->lastPage);
      $this->totalResults = $this->lastPage * 100 + count($results->json()['list']);
    }
    return $this->totalResults;
  }

  public function loadAllObjects() {
    for ($i = $this->loadedPages + 1; $i <= $this->lastPage; $i++) {
      $results = $this->factory->pagedRequest($this->type, $this->params, $i);
      $data = $results->json();
      $this->list = array_merge($this->list, $data['list']);
      $this->loadedResults += count($data['list']);
    }
  }

  public function getAll() {
    $this->loadAllObjects();
    $items = [];
    foreach ($this->list as $listItem) {
      $items[] = $this->factory->createObjectType($this->type, $listItem);
    }
    return $items;
  }

  public function getSomeResources($number = 100) {
    $items = [];
    foreach (array_slice($this->list, 0, $number) as $listItem) {
      $items[] = $this->factory->createObjectType($this->type, $listItem);
    }
    return $items;
  }
}
