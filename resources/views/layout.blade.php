<?php  
// connecting to db
 session_start();
    $database_name = "demo";
    $con = mysqli_connect("localhost","root","",$database_name);?>
    
<!DOCTYPE html>
<html>
<head>
    <title> Cash Register</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    {{-- <link href="{{ asset('../css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
<div class="container" style="width: 60%">
        <ul class="nav nav-pills card-header-pills">
                         <li class="nav-item">
                         <a class="nav-link" href="/">All Products</a>
                         </li>
                         <li class="nav-item">
                         <a class="nav-link " href="cart-favorite">Favorite</a>
                         </li>
                       </ul>
    <div class="row">
        {{-- creting fatch from table in db --}}
         <?php
            $query = "SELECT * FROM cash_mashin ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>

                    <div class="continer">
                        <form method="post" action="cart-favorite?<?php echo htmlspecialchars($row["id"]); ?>">
                        <input type="hidden" value="{{ @csrf_token() }}">
                            <div class="product">
                                <h5 class="text-danger"><?php echo $row["favorite"]; ?></h5>
                                <h5 class="text-info"><?php echo $row["name"]; ?></h5>
                                <h5 class="text-danger"><p><?php echo $row["price"];?>$</p></h5>
                                <h5 class="text-danger" style="text-decoration: line-through;"><p><?php echo $row["price"];?>$</p></h5>
                                <h5 class="text-danger"><p><?php echo $row["discount"]; ?>%</p></h5>
                                <input type="number" class="form-control" value="0">
                                <input type="hidden" value="<?php echo $row["name"]; ?>">
                                <input type="hidden" value="<?php echo $row["price"]; ?>">
                                <input type="hidden" value="<?php echo $row["discount"]; ?>">
                                <input type="hidden" value="<?php echo $row["favorite"]; ?>">
                                <input type="submit" style="margin-top: 8px;"
                                class="btn btn-success" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="dropdown">
                <button type="button" class="btn btn-primary" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart   <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
 
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info">$ {{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View Cart Shop </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<br/>
<div class="container">
   
    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
   
    @yield('content')
</div>
   
@yield('scripts')


</body>
</html>