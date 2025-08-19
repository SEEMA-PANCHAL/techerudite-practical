<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

    <div class="d-flex gap-3">
        <a href="{{ route('admin.register') }}" class="btn btn-primary">
            Admin Register
        </a>

        <a href="{{ route('customer.register') }}" class="btn btn-secondary">
            Customer Register
        </a>
    </div>

</body>
</html>
