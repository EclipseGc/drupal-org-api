<?php
/**
 * @file
 * Contains NodeBookTrait.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources\Node;

use EclipseGc\DrupalOrg\Api\Resources\GetResource;

trait NodeBookTrait {
  use GetResource;

  protected $book;

  protected $bookAncestors;

  protected function setBookData($book, $book_ancestors) {
    $this->book = $book;
    $this->bookAncestors = $book_ancestors;
  }

  /**
   * @return mixed
   */
  public function getBook() {
    return $this->getResource($this->book['resource'], $this->book['id']);
  }

  /**
   * @return mixed
   */
  public function getBookAncestors() {
    return $this->bookAncestors;
  }



} 