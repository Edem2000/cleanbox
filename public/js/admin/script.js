$(document).ready(function () {
  $('#blog-cards-slider-container .delete').click(function(){
    $('.custom-modal-overlay').addClass('active');
    const id = $(this).attr('data-article-id');
    const action = $('#admin_news_delete').attr('action');
    var action_new = action.substr(0, action.lastIndexOf("/") + 1) + id;
    $('#admin_news_delete').attr('action', action_new);

  });
  $('#press-cards-slider-container .delete').click(function(){
    $('.custom-modal-overlay').addClass('active');
    const id = $(this).attr('data-article-id');
    const action = $('#admin_press_delete').attr('action');
    var action_new = action.substr(0, action.lastIndexOf("/") + 1) + id;
    $('#admin_press_delete').attr('action', action_new);
  });

  $('.custom-modal-overlay #close').click(function(){
    $('.custom-modal-overlay').removeClass('active');
  });
  $('.order-show').click(function () {
    $(this).parents('.order-card').addClass('active');
  });
  $('.order-hide').click(function () {
    $(this).parents('.order-card').removeClass('active');
  });
});
