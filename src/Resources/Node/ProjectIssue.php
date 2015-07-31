<?php
/**
 * @file
 * Contains ProjectIssue.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources\Node;


use EclipseGc\DrupalOrg\Api\FactoryInterface;
use EclipseGc\DrupalOrg\Api\Resources\Node;

class ProjectIssue extends Node {

  use NodeCommentTrait;

  protected $taxonomy;

  protected $issueStatus;

  protected $issuePriority;

  protected $issueCategory;

  protected $issueComponent;

  protected $issueAssigned;

  protected $project;

  protected $issueCredit;

  protected $issueFiles;

  protected $issueParent;

  protected $issueRelated;

  protected $issueVersion;

  public function __construct(FactoryInterface $factory, $body, $taxonomy_vocabulary_9, $field_issue_status, $field_issue_priority, $field_issue_category, $field_issue_component, $field_project, $field_issue_files, $field_issue_related, $field_issue_version, $field_issue_credit, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $book_ancestors, $comment, $comments, $comment_count, $comment_count_new, $has_new_content, $last_comment_timestamp = 0, $field_issue_assigned = '') {
    $this->taxonomy = $taxonomy_vocabulary_9;
    $this->issueStatus = $field_issue_status;
    $this->issuePriority = $field_issue_priority;
    $this->issueCategory = $field_issue_category;
    $this->issueComponent = $field_issue_component;
    $this->issueAssigned = $field_issue_assigned;
    $this->project = $field_project;
    $this->issueFiles = $field_issue_files;
//    $this->issueParent = $field_issue_parent;
    $this->issueRelated = $field_issue_related;
    $this->issueCredit = $field_issue_credit;
    $this->issueVersion = $field_issue_version;
    $this->bookAncestors = $book_ancestors;
    parent::__construct($factory, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $has_new_content);
    $this->setCommentData($comment, $comments, $comment_count, $comment_count_new, $last_comment_timestamp);
  }

  /**
   * @return mixed
   */
  public function getBookAncestors() {
    return $this->bookAncestors;
  }

  /**
   * @return mixed
   */
  public function getIssueAssigned() {
    return $this->issueAssigned;
  }

  /**
   * @return mixed
   */
  public function getIssueCategory() {
    return $this->issueCategory;
  }

  /**
   * @return mixed
   */
  public function getIssueComponent() {
    return $this->issueComponent;
  }

  /**
   * @return mixed
   */
  public function getIssueFiles() {
    return $this->issueFiles;
  }

  /**
   * @return mixed
   */
  public function getIssueParent() {
    return $this->issueParent;
  }

  /**
   * @return mixed
   */
  public function getIssuePriority() {
    return $this->issuePriority;
  }

  /**
   * @return mixed
   */
  public function getIssueRelated() {
    return $this->issueRelated;
  }

  /**
   * @return mixed
   */
  public function getIssueStatus() {
    return $this->issueStatus;
  }

  /**
   * @return mixed
   */
  public function getIssueVersion() {
    return $this->issueVersion;
  }

  /**
   * @return mixed
   */
  public function getProject() {
    return $this->project;
  }

  /**
   * @return mixed
   */
  public function getTaxonomy() {
    return $this->taxonomy;
  }

}