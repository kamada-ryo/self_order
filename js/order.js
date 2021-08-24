let height = $('ul#myTab').height();
$('div.container').css('margin-top', height+15);



function showList() {
  $.ajax({
    type: "POST",
    url: "order_list.php",
    data: {
      key: true
    },
    dataType: "html",
    success: function (response) {
      $('#order-list').html(`${response}`);
    }
  });
}

showList();

$('#order-list-tab').on('click',function(){
  showList();
});

//.menu-form内のボタンクリック時のイベント
$('.menu-form input[type="button"]').on('click',function(){
  let msg = '';
  let array = $(this).parent().serializeArray();
  $.ajax({
    type: "POST",
    url: "order_list.php",
    data: {
      id:array[0].value,
      name:array[1].value,
      price:array[2].value,
      count:array[3].value,
    },
    success: function () {
      $('#toast1').toast('show');
    }
  });
})

//キャンセル処理
$(document).on('click','.cancel>input[type="button"]',function(){
  $.ajax({
    type: "POST",
    url: "order_list.php",
    data: {
      cancel: $(this).data('id')
    },
    success: function () {
      showList();
    }
  });
})