var tags = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  dupDetector: function(remoteMatch, localMatch) {
    return remoteMatch.id === localMatch.id;
  },
  prefetch: {
    url: '/tag/prefetch',
    ttl: 300000
  },
  remote: {
    url: '/tag/search/%QUERY'
  }
});
tags.initialize();

$('#tags').tagsinput({
  tagClass: 'label label-default',
  trimValue: true,
  typeaheadjs: {
    name: 'tags',
    displayKey: 'name',
    valueKey: 'name',
    source: tags.ttAdapter()
  }
});

$origEl = $('#tags');
$tagsEl = $('.bootstrap-tagsinput');
tagsinput = $origEl.tagsinput('input');
tagsinput.on('focus', function () {
  $tagsEl.addClass('focus');
}).on('blur', function () {
  $tagsEl.removeClass('focus');
  $origEl.tagsinput('add', $('.tt-input').val());
  tagsinput.val('');
});
