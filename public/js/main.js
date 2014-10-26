
$(function() {
  $('.votelink').on('click', function (e) {
    var link = $(this);
    e.preventDefault();
    $.get($(this).attr('href'), function (data) {
      link.removeClass('dark');
      if(link.hasClass('up')) {
        $('.votelink.down').addClass('dark');
      } else {
        $('.votelink.up').addClass('dark');
        console.log($('here'));
      }
      $('.score').html(data);
    });
  });
});
