<?php

use \Michelf\Markdown;

class Comment extends Eloquent {
  protected $fillable = ['body', 'user_id', 'comment_id'];

  public static $rules = [
    'body' => 'required|min:4'
    ];

  public function getMarkdownBody($body)
  {
    $body = Markdown::defaultTransform($body);
    $body = strip_tags($body, '<em><strong><code><blockquote><p><br>');
    return $body;
  }

  public function snippet()
  {
    return $this->belongsTo('Snippet');
  }

  public function user()
  {
    return $this->belongsTo('User');
  }

}
