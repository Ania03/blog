<?PHP
$connection = mysqli_connect('localhost', 'root', '', 'blog_testing');
if (!$connection) {
  printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
  exit;
}
?>