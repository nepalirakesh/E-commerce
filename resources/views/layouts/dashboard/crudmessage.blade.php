@if (Session::has('success'))
    <div class="container mt-2 w-25 text-center">
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

@if (Session::has('delete'))
    <div class="container mt-2 w-25 text-center">
        <div class="alert alert-danger" role="alert">
            {{ Session::get('delete') }}
        </div>
    </div>
@endif

@if (Session::has('update'))
    <div class="container mt-2 w-25 text-center">
        <div class="alert alert-success" role="alert">
            {{ Session::get('update') }}
        </div>
    </div>
@endif

@if (Session::has('fail'))
    <div class="container mt-2 w-25 text-center">
        <div class="alert alert-danger" role="alert">
            {{ Session::get('fail') }}
        </div>
    </div>
@endif

@if (Session::has('notAvailable'))
    <div class="container text-center" style="width:auto;font-size:24px;margin-top:100px;margin-right:0px;">
        {{ Session::get('notAvailable') }}
    </div>
@endif

@if (Session::has('payment_success'))
        <div class="alert alert-success text-center" role="alert">
            {{ Session::get('payment_success') }}
        </div>
@endif
