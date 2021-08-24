$(window).on('load', function () {
    $('#toast1').toast('show');
});

$('input[type="button"].delete').on('click', function () {
  if(window.confirm('削除します｡ よろしいですか?')){
    let target = $(this).parent().attr('id');
    $(`form#${target}`).submit();
  }
})