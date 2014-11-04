<?php namespace Vimrcfu\Users;

interface UsersRepository {

  /*
   * Update or create a User with data
   * from GitHub OAuth2 API.
   *
   * Datastructure:
   * id, url, avatar url, email, name
   */
  public function findOrCreate($data);

}
