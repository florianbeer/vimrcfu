<?php

return array(

  /*
  |--------------------------------------------------------------------------
  | oAuth Config
  |--------------------------------------------------------------------------
  */

  /**
   * Storage
   */
  'storage' => 'Session',

  /**
   * Consumers
   */
  'consumers' => [
    'GitHub' => [
      'client_id'     => getenv('GITHUB_CLIENT'),
      'client_secret' => getenv('GITHUB_SECRET'),
      'scope'         => ['user:email'],
    ],
  ],

);
