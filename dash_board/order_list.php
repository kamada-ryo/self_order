<?php
session_start();

if(!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['name']) && !isset($_SESSION['user']['login']) && !isset($_SESSION['user']['pass'])){

  header('Location: login.php');

}

$active = 'order_list';

include_once 'header.php';

?>

<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-primary active">
      <input type="radio" name="options" id="option1" autocomplete="off" checked value="0" style="display:none">未提供
    </label>
    <label class="btn btn-primary">
      <input type="radio" name="options" id="option2" autocomplete="off" value="1" style="display:none">提供済
    </label>
  </div><!-- buttons -->

  <div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
      <div class="card">
        <h5 class="card-header">注文リスト</h5>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">卓番</th>
                    <th scope="col">商品名</th>
                    <th scope="col">個数</th>
                    <th scope="col">注文時間</th>
                    <th scope="col">提供状況</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
    
                <tbody id="list">
  
                </tbody>
                              
              </table>
            </div><!-- table-responsive -->     
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col-12 col-xl-8 mb-4 mb-lg-0 -->
    </div><!-- row -->
  </main>

</div>
</div>


<div style="position:fixed;top:10%;left:50%;z-index:2100000000">
  <div id="toast1" class="toast mx-auto position-fixed fade hide start-50 translate-middle" data-delay="1500" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:2100000000">
    <div class="toast-body text-center">
      <p class="my-auto" id="toast"></p>
    </div>
  </div>
</div>



<!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- popper -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

  <script src="../js/orderlist.js"></script>
</body>
</html>