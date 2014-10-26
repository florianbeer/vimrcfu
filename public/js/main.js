
$(function() {
  $('.votelink').on('click', function (e) {
    var link = $(this);
    e.preventDefault();
    $.get($(this).attr('href'), function (data) {
      link.addClass('disabled');
      if(link.hasClass('up')) {
        $('.votelink.down').removeClass('disabled');
      } else {
        $('.votelink.up').removeClass('disabled');
      }
      $('.score').html(data);
    });
  });
});
