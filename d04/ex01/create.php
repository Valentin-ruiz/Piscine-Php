<?php
  if ($_POST['submit'] === 'OK' && !empty($_POST['login']) && !empty($_POST['passwd'])) {
    if (file_exists("../private") == FALSE)
    {
      mkdir("../private", 0777, true);
    }
    if (file_exists('../private/passwd') == FALSE) {
      $user['login'] = $_POST['login'];
      $user['passwd'] = hash('whirlpool', $_POST['passwd']);
      $arr[] = $user;
      file_put_contents('../private/passwd', serialize($arr));
      echo "OK\n";
    }
    else {
      $arr = unserialize(file_get_contents('../private/passwd'));
      foreach($arr as $key) {
        if ($key['login'] === $_POST['login']) {
          echo "ERROR\n";
          exit ();
        }
      }
      $user['login'] = $_POST['login'];
      $user['passwd'] = hash('whirlpool', $_POST['passwd']);
      $arr[] = $user;
      file_put_contents('../private/passwd', serialize($arr));
      echo "OK\n";
    }
  } else {
    echo "ERROR\n";
    exit ();
  }
?>