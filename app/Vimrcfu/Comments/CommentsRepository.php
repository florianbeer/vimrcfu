<?php namespace Vimrcfu\Comments;

interface CommentsRepository {

  /*
   * Validates and creates a new Comment in storage.
   */
  public function create($input);

  /*
   * Validates and updates a Comment in storage.
   */
  public function update(Comment $comment, $input);

}
