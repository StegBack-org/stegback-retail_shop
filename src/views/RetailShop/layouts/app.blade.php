<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stegback Admin - </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
     

  @include('RetailShop::includes.header')
  {{-- @include('RetailShop::includes.sidebar') --}}

 

    @yield('content')
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    @if($message = Session::get('message'))
    <script>
        $(document).ready(function() {
            iziToast.success({
                title: '',
                message: '{{ $message }}',
                position: 'topRight',
                timeout: 5000
            });
        });
    </script>
    @endif

    @if($error= Session::get('error'))
    <script>
        $(document).ready(function() {
            iziToast.error({
                title: '',
                message: '{{ $error }}',
                position: 'topRight',
                timeout: 5000
            });
        });
    </script>
    @endif

 
    @yield('script')
</body>

</html>