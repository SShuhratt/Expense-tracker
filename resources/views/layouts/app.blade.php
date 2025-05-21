<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Expense Tracker')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<x-navbar />

<main>
    @yield('content')
</main>

<x-footer />

</body>
</html>
