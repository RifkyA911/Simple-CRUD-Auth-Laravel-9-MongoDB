<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
   <form action="/users/typeRequest" method="post">
      @csrf
      <input type="hidden" name="action" value="insert" required> <!-- ini wajib ditambahkan untuk if else di req->input form controller-->
      <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  
</body>
</html>