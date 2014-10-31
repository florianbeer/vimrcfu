var tags = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: '/tag/%QUERY',
    filter: function(list) {
      return list;
    }
    }
});
tags.initialize();

$('#tags').tagsinput({
  tagClass: 'label label-default',
  trimValue: true,
  itemValue: 'name',
  itemText: 'name',
  typeaheadjs: {
    name: 'tags',
  displayKey: 'name',
  valueKey: 'id',
  source: tags.ttAdapter()
  }
});

$('#tags').tagsinput('input').on('focus', function () {
  $('.bootstrap-tagsinput').addClass('focus');
}).on('blur', function () {
  $('.bootstrap-tagsinput').removeClass('focus');
});
