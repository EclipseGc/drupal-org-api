<?php

namespace EclipseGc\DrupalOrg\Api\Resources;

use EclipseGc\DrupalOrg\Api\FactoryInterface;


interface PagedInterface {
  public function __construct(FactoryInterface $factoryInterface, $type, $params, $self, $list, $first = '', $last = '', $next = '');

  public function getAll();

  public function getSomeResources($number = 100);
}