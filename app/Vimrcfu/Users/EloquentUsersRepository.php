<?php namespace Vimrcfu\Users;

class EloquentUsersRepository implements UsersRepository {

  /**
   * @param array data
   * @return mixed
   */
  public function findOrCreate($data)
  {
    $user = User::firstOrNew(['github_id' => $data['github_id']]);
    $user->fill($data);
    $user->save();

    return $user;
  }

}
