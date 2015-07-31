<?php
/**
 * @file
 * Contains ProjectIssue.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources\Node;


use EclipseGc\DrupalOrg\Api\FactoryInterface;
use EclipseGc\DrupalOrg\Api\Resources\Node;

/**
 * Class ProjectModule
 * @package EclipseGc\DrupalOrg\Api\Resources\Node
 */
class ProjectModule extends Node {

  use NodeCommentTrait;

  /**
   * @var
   */
  protected $maintenanceStatus;
  /**
   * @var
   */
  protected $developmentStatus;
  /**
   * @var
   */
  protected $tags;
  /**
   * @var
   */
  protected $projectType;
  /**
   * @var
   */
  protected $machineName;
  /**
   * @var
   */
  protected $hasIssueQueue;
  /**
   * @var
   */
  protected $components;
  /**
   * @var
   */
  protected $defaultComponent;
  /**
   * @var
   */
  protected $projectIssueGuidelines;
  /**
   * @var
   */
  protected $hasReleases;
  /**
   * @var
   */
  protected $releaseVersionFormat;
  /**
   * @var
   */
  protected $homepage;
  /**
   * @var
   */
  protected $changelog;
  /**
   * @var
   */
  protected $demo;
  /**
   * @var
   */
  protected $documentation;
  /**
   * @var
   */
  protected $screenshots;
  /**
   * @var
   */
  protected $license;
  /**
   * @var
   */
  protected $images;
  /**
   * @var
   */
  protected $supportingOrganizations;
  /**
   * @var
   */
  protected $downloadCount;
  /**
   * @var
   */
  protected $phpCsErrors;
  /**
   * @var
   */
  protected $phpCsFull;
  /**
   * @var
   */
  protected $phpCsTimestamp;
  /**
   * @var
   */
  protected $phpCsWarnings;

  /**
   * @param \EclipseGc\DrupalOrg\Api\FactoryInterface $factory
   * @param array $taxonomy_vocabulary_46
   * @param int $taxonomy_vocabulary_44
   * @param int $taxonomy_vocabulary_3
   * @param bool $body
   * @param string $field_project_type
   * @param string $field_project_machine_name
   * @param string $field_project_has_issue_queue
   * @param string $field_project_components
   * @param string $field_project_default_component
   * @param $field_project_issue_guidelines
   * @param $field_project_has_releases
   * @param $field_release_version_format
   * @param $field_project_homepage
   * @param $field_project_changelog
   * @param $field_project_demo
   * @param $field_project_documentation
   * @param $field_project_screenshots
   * @param $field_project_license
   * @param $field_project_images
   * @param $field_supporting_organizations
   * @param $field_download_count
   * @param $field_project_phpcs_errors
   * @param $field_project_phpcs_full
   * @param $field_project_phpcs_ts
   * @param $field_project_phpcs_warnings
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
   * @param $last_comment_timestamp
   */
  public function __construct(FactoryInterface $factory, $taxonomy_vocabulary_46, $taxonomy_vocabulary_44, $taxonomy_vocabulary_3, $body, $field_project_type, $field_project_machine_name, $field_project_has_issue_queue, $field_project_components,
                              $field_project_default_component, $field_project_issue_guidelines, $field_project_has_releases, $field_release_version_format, $field_project_homepage, $field_project_changelog, $field_project_demo, $field_project_documentation,
                              $field_project_screenshots, $field_project_license, $field_project_images, $field_supporting_organizations, $field_download_count, $field_project_phpcs_errors, $field_project_phpcs_full, $field_project_phpcs_ts,
                              $field_project_phpcs_warnings, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $book_ancestors, $comment, $comments, $comment_count, $comment_count_new,
                              $has_new_content, $last_comment_timestamp) {
    $this->developmentStatus = $taxonomy_vocabulary_46;
    $this->maintenanceStatus = $taxonomy_vocabulary_44;
    $this->tags = $taxonomy_vocabulary_3;
    $this->projectType = $field_project_type;
    $this->machineName = $field_project_machine_name;
    $this->hasIssueQueue = $field_project_has_issue_queue;
    $this->components = $field_project_components;
    $this->defaultComponent = $field_project_default_component;
    $this->projectIssueGuidelines = $field_project_issue_guidelines;
    $this->hasReleases = $field_project_has_releases;
    $this->releaseVersionFormat = $field_release_version_format;
    $this->hompage = $field_project_homepage;
    $this->changelog = $field_project_changelog;
    $this->demo = $field_project_demo;
    $this->documentation = $field_project_documentation;
    $this->screenshots = $field_project_screenshots;
    $this->license = $field_project_license;
    $this->images = $field_project_images;
    $this->supportingOrganizations = $field_supporting_organizations;
    $this->downloadCount = $field_download_count;
    $this->phpCsErrors = $field_project_phpcs_errors;
    $this->phpCsFull = $field_project_phpcs_full;
    $this->phpCsTimestamp = $field_project_phpcs_ts;
    $this->phpCsWarnings = $field_project_phpcs_warnings;

    parent::__construct($factory, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $has_new_content);
    $this->setCommentData($comment, $comments, $comment_count, $comment_count_new, $last_comment_timestamp);
  }

  /**
   * @return mixed
   */
  public function getMaintenanceStatus() {
    return $this->maintenanceStatus;
  }

  /**
   * @return mixed
   */
  public function getDevelopmentStatus() {
    return $this->developmentStatus;
  }

  /**
   * @return mixed
   */
  public function getTags() {
    $items = [];
    foreach ($this->tags as $listItem) {
      $items[] = $this->getResource($listItem['resource'], $listItem['id']);
    }
    return $items;
  }

  /**
   * @return mixed
   */
  public function getProjectType() {
    return $this->projectType;
  }

  /**
   * @return mixed
   */
  public function getMachineName() {
    return $this->machineName;
  }

  /**
   * @return mixed
   */
  public function getHasIssueQueue() {
    return $this->hasIssueQueue;
  }

  /**
   * @return mixed
   */
  public function getComponents() {
    return $this->components;
  }

  /**
   * @return mixed
   */
  public function getDefaultComponent() {
    return $this->defaultComponent;
  }

  /**
   * @return mixed
   */
  public function getProjectIssueGuidelines() {
    return $this->projectIssueGuidelines;
  }

  /**
   * @return mixed
   */
  public function getHasReleases() {
    return $this->hasReleases;
  }

  /**
   * @return mixed
   */
  public function getReleaseVersionFormat() {
    return $this->releaseVersionFormat;
  }

  /**
   * @return mixed
   */
  public function getHomepage() {
    return $this->homepage;
  }

  /**
   * @return mixed
   */
  public function getChangelog() {
    return $this->changelog;
  }

  /**
   * @return mixed
   */
  public function getDemo() {
    return $this->demo;
  }

  /**
   * @return mixed
   */
  public function getDocumentation() {
    return $this->documentation;
  }

  /**
   * @return mixed
   */
  public function getScreenshots() {
    return $this->screenshots;
  }

  /**
   * @return mixed
   */
  public function getLicense() {
    return $this->license;
  }

  /**
   * @return mixed
   */
  public function getImages() {
    return $this->images;
  }

  /**
   * @return mixed
   */
  public function getSupportingOrganizations() {
    return $this->supportingOrganizations;
  }

  /**
   * @return mixed
   */
  public function getDownloadCount() {
    return $this->downloadCount;
  }

  /**
   * @return mixed
   */
  public function getPhpCsErrors() {
    return $this->phpCsErrors;
  }

  /**
   * @return mixed
   */
  public function getPhpCsFull() {
    return $this->phpCsFull;
  }

  /**
   * @return mixed
   */
  public function getPhpCsTimestamp() {
    return $this->phpCsTimestamp;
  }

  /**
   * @return mixed
   */
  public function getPhpCsWarnings() {
    return $this->phpCsWarnings;
  }

}