<?php
/**
 * @file
 * Contains NodeInterface.php.
 */
namespace EclipseGc\DrupalOrg\Api\Resources\Node;

use EclipseGc\DrupalOrg\Api\Resources\ResourceInterface;

interface NodeInterface extends ResourceInterface {

  /**
   * @return \EclipseGc\DrupalOrg\Api\Resources\User
   */
  public function getAuthor();

  /**
   * @return array
   */
  public function getBody();

  /**
   * @return int
   */
  public function getChanged();

  /**
   * @return int
   */
  public function getCreated();

  /**
   * @return string
   */
  public function getEditUrl();

  /**
   * @return mixed NULL|bool
   */
  public function getHasNewContent();

  /**
   * @return bool
   */
  public function getIsNew();

  /**
   * @return string
   */
  public function getLanguage();

  /**
   * @return int
   */
  public function getNid();

  /**
   * @return bool
   */
  public function getPromote();

  /**
   * @return bool
   */
  public function getStatus();

  /**
   * @return bool
   */
  public function getSticky();

  /**
   * @return string
   */
  public function getTitle();

  /**
   * @return string
   */
  public function getType();

  /**
   * @return string
   */
  public function getUrl();

  /**
   * @return int
   */
  public function getVid();

}
