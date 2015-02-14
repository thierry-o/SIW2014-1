<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <title>
   Laravel
  </title>
 </head>
 <body>
  <form action="{{ url('get') }}" method="POST">
   <input type='hidden' name='var3' value='hello' />
   <input type='hidden' name='var4' value='clivern' />
   <input type='submit' value='Submit' />
  </form>
 </body>
</html>