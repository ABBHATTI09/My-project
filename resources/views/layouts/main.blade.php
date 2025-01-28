<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Add your CSS or other head elements here -->
         <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxT+L+1T7HZ3ZG29Tma54WW4oa3JvRa5NpOZjMhFY04yZpvD8cHuo5vl0iw" crossorigin="anonymous">

<!-- Your Custom CSS -->
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Header -->
    @include('layouts.header')
    @if(session()->has('user_id'))
        @include('layouts.sidebar')
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS (includes Bootstrap JS and Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQXuhbuJeYBlV5mZYyxs/ZDxFcpjY5AdPnHtn3MnmUD3DdrdsyeIpLa3NlGdq4nt" crossorigin="anonymous"></script>
    <!-- Your Custom JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>

</body>
</html>
