<!DOCTYPE html>
<html>
<head>
  <title>TALLTON CHALACO LACERDA SANTOS - Autos Database</title>
  <meta charset="UTF-8">
  <link type="text/css" rel="stylesheet" href="css.css">
  <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
</head>
<body>
<header>
  <h1>Please Log in</h1>
</header>
<main>
  <form method="post">
    <table>
      <tr><td>User Email: </td><td><input type="text" name="email"></td></tr>
      <tr><td>Password: </td><td><input type="password" name="pass"></td></tr>
      <tr><td><input type="submit" name="submit" value="Log In"></td>
      <td><input type="button" name="cancel" onclick="location.href='logout.php'; return false;" value="Cancel"></td></tr>
    </table>
  </form>
</main>
</body>
</html>
