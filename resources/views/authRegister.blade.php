<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
   <form action="/auth/typeAuth" method="post">
      @csrf
      <input type="hidden" name="auth" value="register">
      <div class="form-group">
          <label for="username">username</label>
          <input type="username" name="username" class="form-control" required>
      </div>
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
</body>
</html>