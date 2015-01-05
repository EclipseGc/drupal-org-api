<?php
/**
 * @file
 * Contains NodeCommentTrait.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources\Node;


trait NodeCommentTrait {

  protected $comment;

  protected $comments;

  protected $commentCount;

  protected $commentCountNew;

  protected $lastCommentTimeStamp;

  protected function setCommentData($comment, $comments, $comment_count, $comment_count_new, $last_comment_timestamp) {
    $this->comment = $comment;
    $this->comments = $comments;
    $this->commentCount = $comment_count;
    $this->commentCountNew = $comment_count_new;
    $this->lastCommentTimeStamp = $last_comment_timestamp;
  }

  /**
   * @return mixed
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * @return mixed
   */
  public function getCommentCount() {
    return $this->commentCount;
  }

  /**
   * @return mixed
   */
  public function getCommentCountNew() {
    return $this->commentCountNew;
  }

  /**
   * @return mixed
   */
  public function getComments() {
    return $this->comments;
  }

  /**
   * @return mixed
   */
  public function getLastCommentTimeStamp() {
    return $this->lastCommentTimeStamp;
  }

} 