<h2>Statistics</h2>
<ul class="list-group">
  <li class="list-group-item">
  <span class="badge">{{ $top_snippet->points  }}</span>
  <i class="fa fa-fire fa-fw"></i>&nbsp;
  <a href="{{ URL::route('snippet.show', $top_snippet->id) }}">Top Snippet</a>
  </li>
  <li class="list-group-item">
  <span class="badge">{{ $top_comments->comments_count  }}</span>
  <i class="fa fa-comments fa-fw"></i>&nbsp;
  <a href="{{ URL::route('snippet.show', $top_comments->id) }}">Most Comments</a>
  </li>
  <li class="list-group-item">
  <span class="badge">{{ $snippets_count  }}</span>
  <i class="fa fa-code fa-fw"></i>&nbsp;
  Snippets
  </li>
  <li class="list-group-item">
  <span class="badge">{{ $comments_count  }}</span>
  <i class="fa fa-comments-o fa-fw"></i>&nbsp;
  Comments
  </li>
  <li class="list-group-item">
  <span class="badge">{{ $users_count  }}</span>
  <i class="fa fa-users fa-fw"></i>&nbsp;
  Users
  </li>
</ul>
