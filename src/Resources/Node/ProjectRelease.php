<?php

namespace EclipseGc\DrupalOrg\Api\Resources\Node;


use EclipseGc\DrupalOrg\Api\FactoryInterface;
use EclipseGc\DrupalOrg\Api\Resources\Node;

/**
 * Class ProjectRelease
 * @package EclipseGc\DrupalOrg\Api\Resources\Node
 */
class ProjectRelease extends Node {

  use NodeCommentTrait;

  /**
   * @var int
   */
  protected $drupalCoreVersion;
  /**
   * @var array
   */
  protected $tags;
  /**
   * @var bool
   */
  protected $project;
  /**
   * @var string
   */
  protected $version;
  /**
   * @var string
   */
  protected $versionMajor;
  /**
   * @var string
   */
  protected $versionMinor;
  /**
   * @var string
   */
  protected $versionPatch;
  /**
   * @var string
   */
  protected $versionExtra;
  /**
   * @var
   */
  protected $weight;
  /**
   * @var
   */
  protected $delta;
  /**
   * @var
   */
  protected $vcsLabel;
  /**
   * @var
   */
  protected $buildType;
  /**
   * @var
   */
  protected $updateStatus;
  /**
   * @var
   */
  protected $releaseFiles;

  /**
   * @param \EclipseGc\DrupalOrg\Api\FactoryInterface $factory
   * @param array $body
   * @param int $taxonomy_vocabulary_6
   * @param int $taxonomy_vocabulary_7
   * @param bool $field_release_project
   * @param string $field_release_version
   * @param string $field_release_version_major
   * @param string $field_release_version_minor
   * @param string $field_release_version_patch
   * @param string $field_release_version_extra
   * @param $field_release_version_ext_weight
   * @param $field_release_version_ext_delta
   * @param $field_release_vcs_label
   * @param $field_release_build_type
   * @param $field_release_update_status
   * @param $field_release_files
   * @param $nid
   * @param $vid
   * @param $is_new
   * @param $type
   * @param $title
   * @param $language
   * @param $url
   * @param $edit_url
   * @param $status
   * @param $promote
   * @param $sticky
   * @param $created
   * @param $changed
   * @param $author
   * @param $book_ancestors
   * @param $comment
   * @param $comments
   * @param $comment_count
   * @param $comment_count_new
   * @param $has_new_content
   * @param int $last_comment_timestamp
   * @param string $field_issue_assigned
   */
  public function __construct(FactoryInterface $factory, $body, $taxonomy_vocabulary_6, $taxonomy_vocabulary_7, $field_release_project, $field_release_version, $field_release_version_major, $field_release_version_minor, $field_release_version_patch, $field_release_version_extra, $field_release_version_ext_weight, $field_release_version_ext_delta, $field_release_vcs_label, $field_release_build_type, $field_release_update_status, $field_release_files,  $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $book_ancestors, $comment, $comments, $comment_count, $comment_count_new, $has_new_content, $last_comment_timestamp = 0, $field_issue_assigned = '') {
    $this->drupalCoreVersion = $taxonomy_vocabulary_6;
    $this->tags = $taxonomy_vocabulary_7;
    $this->project = $field_release_project;
    $this->version = $field_release_version;
    $this->versionMajor = $field_release_version_major;
    $this->versionMinor = $field_release_version_minor;
    $this->versionPatch = $field_release_version_patch;
    $this->versionExtra = $field_release_version_extra;
    $this->weight = $field_release_version_ext_weight;
    $this->delta = $field_release_version_ext_delta;
    $this->vcsLabel = $field_release_vcs_label;
    $this->buildType = $field_release_build_type;
    $this->updateStatus = $field_release_update_status;
    $this->releaseFiles = $field_release_files;

    $this->bookAncestors = $book_ancestors;

    parent::__construct($factory, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $has_new_content);
    $this->setCommentData($comment, $comments, $comment_count, $comment_count_new, $last_comment_timestamp);
  }

  /**
   * @return int
   */
  public function getDrupalCoreVersion() {
    return $this->factory->createObjectType($this->drupalCoreVersion['type'], $this->drupalCoreVersion['id']);
  }

  /**
   * @return int
   */
  public function getTags() {
    $items = [];
    foreach ($this->tags as $listItem) {
      $items[] = $this->factory->createObjectType($listItem['type'], $listItem['id']);
    }
    return $items;
  }

  /**
   * @return boolean
   */
  public function getProject() {
    return $this->factory->createObjectType($this->project['type'], $this->project['id']);
  }

  /**
   * @return string
   */
  public function getVersion() {
    return $this->version;
  }

  /**
   * @return string
   */
  public function getVersionMajor() {
    return $this->versionMajor;
  }

  /**
   * @return string
   */
  public function getVersionMinor() {
    return $this->versionMinor;
  }

  /**
   * @return string
   */
  public function getVersionPatch() {
    return $this->versionPatch;
  }

  /**
   * @return string
   */
  public function getVersionExtra() {
    return $this->versionExtra;
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
  public function getDelta() {
    return $this->delta;
  }

  /**
   * @return mixed
   */
  public function getVcsLabel() {
    return $this->vcsLabel;
  }

  /**
   * @return mixed
   */
  public function getBuildType() {
    return $this->buildType;
  }

  /**
   * @return mixed
   */
  public function getUpdateStatus() {
    return $this->updateStatus;
  }

  /**
   * @return mixed
   */
  public function getReleaseFiles() {
    return $this->releaseFiles;
  }
}