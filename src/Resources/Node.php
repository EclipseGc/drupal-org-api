<?php
/**
 * @file
 * Contains Node.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources;


use EclipseGc\DrupalOrg\Api\FactoryInterface;
use EclipseGc\DrupalOrg\Api\Resources\Node\NodeInterface;

class Node implements NodeInterface {

  use GetResource;

  /**
   * @var array
   */
  protected $body;

  /**
   * @var int
   */
  protected $nid;

  /**
   * @var int
   */
  protected $vid;

  /**
   * @var bool
   */
  protected $isNew;

  /**
   * @var string
   */
  protected $type;

  /**
   * @var string
   */
  protected $title;

  /**
   * @var string
   */
  protected $language;

  /**
   * @var string
   */
  protected $url;

  /**
   * @var string
   */
  protected $editUrl;

  /**
   * @var bool
   */
  protected $status;

  /**
   * @var bool
   */
  protected $promote;

  /**
   * @var bool
   */
  protected $sticky;

  /**
   * @var int
   */
  protected $created;

  /**
   * @var int
   */
  protected $changed;

  /**
   * @var array
   */
  protected $author;

  /**
   * @var mixed NULL|bool
   */
  protected $hasNewContent;

  /**
   * @param array $data
   * @return string
   *   The class name to instantiate.
   *
   *   This will be the specific class for this Node bundle IF it exists,
   *   otherwise the typical Node class will be used.
   */
  public static function getClass(array $data) {
    $type = str_replace(' ', '', ucwords(str_replace('_', ' ', $data['type'])));
    $class = get_called_class() . "\\$type";
    if (class_exists($class)) {
      return $class;
    }
    return get_called_class();
  }

  /**
   * @param FactoryInterface $factory
   * @param array $body
   * @param int $nid
   * @param int $vid
   * @param bool $is_new
   * @param string $type
   * @param string $title
   * @param string $language
   * @param string $url
   * @param string $edit_url
   * @param bool $status
   * @param bool $promote
   * @param bool $sticky
   * @param int $created
   * @param int $changed
   * @param array $author
   * @param mixed NULL|bool $has_new_content
   */
  public function __construct(FactoryInterface $factory, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $has_new_content) {
    $this->factory = $factory;
    $this->body = $body;
    $this->nid = $nid;
    $this->vid = $vid;
    $this->isNew = $is_new;
    $this->type = $type;
    $this->title = $title;
    $this->language = $language;
    $this->url = $url;
    $this->editUrl = $edit_url;
    $this->status = $status;
    $this->promote = $promote;
    $this->sticky = $sticky;
    $this->created = $created;
    $this->changed = $changed;
    $this->author = $author;
    $this->hasNewContent = $has_new_content;
  }

  /**
   * @return array
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * @return \EclipseGc\DrupalOrg\Api\Resources\User
   */
  public function getAuthor() {
    return $this->getResource($this->author['resource'], $this->author['id']);
  }

  /**
   * @return int
   */
  public function getChanged() {
    return $this->changed;
  }

  /**
   * @return int
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * @return string
   */
  public function getEditUrl() {
    return $this->editUrl;
  }

  /**
   * @return mixed NULL|bool
   */
  public function getHasNewContent() {
    return $this->hasNewContent;
  }

  /**
   * @return bool
   */
  public function getIsNew() {
    return $this->isNew;
  }

  /**
   * @return string
   */
  public function getLanguage() {
    return $this->language;
  }

  /**
   * @return int
   */
  public function getNid() {
    return $this->nid;
  }

  /**
   * @return bool
   */
  public function getPromote() {
    return $this->promote;
  }

  /**
   * @return bool
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * @return bool
   */
  public function getSticky() {
    return $this->sticky;
  }

  /**
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @return int
   */
  public function getVid() {
    return $this->vid;
  }

}
