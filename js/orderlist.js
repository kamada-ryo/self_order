let status = 0;

  function display_list(num){
    $.ajax({
      type: "POST",
      url: "list.php",
      data: {status : `${num}`},
      dataType: "html",
      success: function (response) {
        $('tbody#list').html(response);
      }
    });
}
  


//初回の読み込み
  display_list(status);

//再帰的なsetTimeout インターバルは3,000ms
  setTimeout(function run(){
    console.log('reload');
    display_list(status);
    setTimeout(run, 3000);
  }, 3000);
  
  $('input[name="options"]').on('change',function(){
    if($(this).val() == 1){
      $(this).parent().addClass('active');
      $(this).parent().prev().removeClass('active');
    }else{
      $(this).parent().addClass('active');
      $(this).parent().next().removeClass('active');
    }
    
    status = parseInt($(this).val());
    display_list(status);
  })

  $(document).on('click','input.change-btn',function(){
    let change = 0;
    if($(this).data('status') == 0){
      change = 1;
    }
   

    $.ajax({
      type: "POST",
      url: "list.php",
      data: {
        order: $(this).data('order'),
        product: $(this).data('product'),
        change: `${change}`
      },
      success: function (response) {
        display_list(status);
        $("#toast").html(response);
        $('#toast1').toast('show');
      }
    });
  })