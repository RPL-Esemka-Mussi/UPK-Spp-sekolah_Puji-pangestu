@extends('main.bootstrap')

@section('content')


<body class="text-center">

    <main class="form-signin w-100 m-auto">
      <form>
        <div class="col-md-5>" </div>
        <main class="form-registration">
        <h1 class="h3 mb-3 fw-normal py-5">Registration From</h1>
        <form action="/register"method="post"
        @csrf

        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top" id="name" placeholder="name">
          <label for="floatingInput">name</label>
        </div>

        <div class="form-floating">
          <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
          <label for="email">email address</label>
        </div>

        <div class="form-floating">
            <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="password">
            <label for="password">password</label>
          </div>


        <button class="w-100 btn btn-lg btn-primary" type="submit">Regisret</button>
      </form>
      <small class="d-block text-center mt-3">Already registered? <a href="/login">Login</a> </small>
    </main>



      </body>
    </html>


@endsection
