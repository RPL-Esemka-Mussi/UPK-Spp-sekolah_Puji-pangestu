
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>upk</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <h1 class="h3 mb-3 fw-normal py-5">Please login</h1>
      <form action="/auth" method="post">
        @csrf


        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" id="email" placeholder="name@example.com">
          <label for="email">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
          <label for="password">Password</label>
        </div>


        <button class="w-100 btn btn-lg btn-primary" type="submit">login</button>
      </form>
      <small class="d-block text-center mt-3">Not registrered? <a href="/register">Register Now!</a> </small>
    </main>



      </body>
    </html>



