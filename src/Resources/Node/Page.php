<?php
/**
 * @file
 * Contains Page.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources\Node;


use EclipseGc\DrupalOrg\Api\FactoryInterface;
use EclipseGc\DrupalOrg\Api\Resources\Node;

class Page extends Node {

  use NodeCommentTrait;
  use NodeBookTrait;

  protected $upload;

  public function __construct(FactoryInterface $factory, $upload, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $book, $book_ancestors, $comment, $comments, $comment_count, $comment_count_new, $has_new_content, $last_comment_timestamp) {
    $this->upload = $upload;
    parent::__construct($factory, $body, $nid, $vid, $is_new, $type, $title, $language, $url, $edit_url, $status, $promote, $sticky, $created, $changed, $author, $has_new_content);
    $this->setCommentData($comment, $comments, $comment_count, $comment_count_new, $last_comment_timestamp);
    $this->setBookData($book, $book_ancestors);
  }
}