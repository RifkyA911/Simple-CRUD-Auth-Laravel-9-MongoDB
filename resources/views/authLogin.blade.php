<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
   <form action="/auth/typeAuth" method="post">
      @csrf
      <input type="hidden" name="auth" value="login">
      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <form action="/auth/register" method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>
</html>