<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
</head>
<body>
   <hr>
   <p>Daftar user :</p>
   @foreach($users as $user)
        <h1>{{ $user->name }}</h1>
        <div>{{ $user->email }}</div>
   @endforeach
</body>
</html> 