$(function() {
  $('.votelink').on('click', function (e) {
    var link = $(this);
    e.preventDefault();
    $.get(link.attr('href'), function (data) {
      toggle_link(link, data);
    });
  });
  $('.toggle-visibility').on('click', function () {
    toggle_visibility($(this));
  });
});

function toggle_link(link, data) {
  link.removeClass('dark');
  if(link.hasClass('up')) {
    $('.votelink.down').addClass('dark');
  } else {
    $('.votelink.up').addClass('dark');
  }
  $('.points').html(data);
}

function toggle_visibility(id) {
  elToHide = id.next();
  elToHide.toggleClass('hidden');
}

