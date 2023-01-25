<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
   <form action="/users/typeRequest" method="post">
      @csrf
      <input type="hidden" name="action" value="find" required>
      <label for="">Cari Nama User</label>
      <input type="text" value="Rifky Akhmad" name="name" required>
      <br>
      <button type="submit">Cari</button>
   </form>
   <br>
   <form action="/auth/typeAuth" method="post">
    @csrf
       <input type="hidden" name="auth" value="logOut">
       <button type="submit">Log Out</button>
   </form>
   <br>
   <hr>
   <a href="create" type="button">buat user</a>
   @foreach($users as $user)
        <h1>{{ $user->name }}</h1>
        <div>{{ $user->email }}</div>
        <form action="/users/edit" method="get">
         @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <button type="submit">Edit</button>
        </form>
        <form action="/users/typeRequest" method="post">
         @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="action" value="delete">
            <button type="submit">Delete</button>
        </form>
   @endforeach
</body>
</html> 