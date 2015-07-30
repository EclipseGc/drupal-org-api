<?php

/**
 * Implements a basic file cache for DrupalClient.
 */

namespace EclipseGc\DrupalOrg\Api;

//use EclipseGc\DrupalOrg\Api\FactoryInterface;
//use EclipseGc\DrupalOrg\Api\Factory;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Message\Response;

/**
 * Class FileCacheFactory
 *
 * Uses a simple directory cache to store requests. This directory defaults to
 * $HOME/.drupal-api-cache, but is configurable in the constructor.
 *
 * @package EclipseGc\DrupalOrg\Api
 */
class FileCacheFactory implements FactoryInterface {
  /**
   * @var Factory
   */
  protected $baseFactory;
  /**
   * @var
   */
  protected $cacheDirectory;

  /**
   * Constructor
   * @param $factory FactoryInterface
   * @param $cacheDirectory string
   *  The directory in which to store cache files. Defaults to
   *  $HOME/.drupal-api-cache.
   * @throws \Exception
   */
  public function __construct(FactoryInterface $factory, $cacheDirectory = '.drupal-api-cache') {
    $this->baseFactory = $factory;

    if (!strstr($cacheDirectory, '/') !== FALSE) {
      if (realpath($cacheDirectory) == '') {
        // It's not local, so default to the home directory.
        $cacheDirectory = $_SERVER['HOME'] . '/' . $cacheDirectory;
      }
      else {
        $cacheDirectory = realpath($cacheDirectory);
      }
    }

    if (!file_exists($cacheDirectory)) {
      // Try to create it.
      if (!mkdir($cacheDirectory)) {
        throw new \Exception('Unable to create cache directory: ' . $cacheDirectory);
      }
    }

    if (!is_writable($cacheDirectory)) {
      throw new \Exception('Cache directory is not writable: ' . $cacheDirectory);
    }

    $this->cacheDirectory = $cacheDirectory;
  }

  /**
   * Caching request mechanism. Returns cached requests if we have them.
   * @inheritdoc
   */
  public function request($entity_type, $id) {
    $cacheFilePath = $this->cacheDirectory . '/' . $entity_type . '/' . $id;

    echo $cacheFilePath . PHP_EOL;

    if (file_exists($cacheFilePath)) {
      echo 'cache hit!' . PHP_EOL;
      $data = unserialize(file_get_contents($cacheFilePath));
      if (isset($data->list)) {
        $data = reset($data->list);
      }
      $data = new Response(200, ['Content-Type' => 'application/json'], Stream::factory(json_encode($data)));
    }
    else {
      // No data.
      echo 'cache miss!' . PHP_EOL;
      $data = $this->baseFactory->request($entity_type, $id);

      if (!file_exists($this->cacheDirectory . '/' . $entity_type)) {
        mkdir($this->cacheDirectory . '/' . $entity_type);
      }
      else {
        file_put_contents($cacheFilePath, serialize(json_decode($data->json())));
      }
    }

    return $data;
  }

  /**
   * @inheritdoc
   */
  public function getObjectTypeClass($type, array $data) {
    return $this->baseFactory->getObjectTypeClass($type, $data);
  }

  /**
   * @inheritdoc
   */
  public function createObjectType($type, array $data = array()) {
    return $this->baseFactory->createObjectType($type, $data);
  }
}