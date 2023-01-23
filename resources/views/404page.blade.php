<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not Found</title>
</head>
<body style="position: relative;min-height:90vh;">
    <h1 class="text-muted" style="position:absolute;top:50%;right:45%">404 | NOT FOUND!</h1>
    <form action="{{ route('logout') }}" method="post" style="position: absolute;top:0%;right:0%">
        @csrf
        <button type="submit">logout</button>
    </form>
</body>
</html>
