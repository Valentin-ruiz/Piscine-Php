<?php
  if ($_POST['submit'] === 'OK' && !empty($_POST['submit']) && !empty($_POST['oldpw']) && !empty($_POST['newpw'])) {
    if (!file_exists('../private/passwd')) {
      echo "ERROR\n";
      exit ();
    }
    $arr = unserialize(file_get_contents('../private/passwd'));
    foreach($arr as $key => $user) {
      if ($user['login'] === $_POST['login'] && $user['passwd'] === hash('whirlpool', $_POST['oldpw'])) {
        $arr[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
        file_put_contents('../private/passwd', serialize($arr));
        echo "OK\n";
        exit() ;
      }
    }
  }
  echo "ERROR\n";
  exit ();
?>