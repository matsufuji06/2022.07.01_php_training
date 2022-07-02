<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

  // スーパーグローバル変数 php 9種類
  // 連想配列
  if(!empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
  }

  // if(!empty($_SESSION)) {
  //   echo '<pre>';
  //   var_dump($_SESSION);
  //   echo '</pre>';
  // }

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');

}

  // 入力、確認、完了 input.php, conform.php, tahnks.php
  // CSRF 偽物のinput.php->悪意のあるページ。本物のフォーム情報かどうか確かめる必要がある（セッションを利用）
  // input.php

  $pageFlag = 0;

  // バリデーションの実行と受け取り
  $errors = validation($_POST);


  if(!empty($_POST['btn_confirm']) && empty($errors)) {
    $pageFlag = 1;
  }

  if(!empty($_POST['btn_submit'])) {
    $pageFlag = 2;
  }



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <?php if($pageFlag === 0) : ?>

    <?php
      if(!isset($_SESSION['csrfToken'])) {
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $csrfToken;
      }
      $token = $_SESSION['csrfToken'];

    ?>

    <?php if(!empty($errors) && !empty($_POST['btn_confirm'])): ?>
      <?php echo '<ul>' ;?>
        <?php 
          foreach($errors as $error) {
          echo '<li>' . $error . '</li>' ;
          }
        ?>
      <?php echo '</ul>' ;?>
    <?php endif; ?>

    <form method="POST" action="input.php" >
      氏名
      <input type="text" name="your_name" value="<?php if(!empty($_POST['your_name'])){ echo h($_POST['your_name']); } ?>">
      <br>

      メールアドレス
      <input type="email" name="email" value="<?php if(!empty($_POST['email'])){ echo h($_POST['email']); } ?>">
      <br>

      ホームページ
      <input type="url" name="url" value="<?php if(!empty($_POST['url'])){ echo h($_POST['url']); } ?>">
      <br>

      性別
      <input type="radio" name="gender" 
      value="0" <?php if(isset($_POST['gender'] ) && $_POST['gender'] === '0') {echo 'checked';} ?>>男性</input>

      <input type="radio" name="gender" 
      value="1" <?php if(isset($_POST['gender'] ) && $_POST['gender'] === '1') {echo 'checked';} ?>>女性</input>
      <br>

      年齢
      <select name="age" id="">
        <option value="">選択してください</option>
        <option value="1">〜１９歳</option>
        <option value="2">２０歳〜２９歳</option>
        <option value="3">３０歳〜３９歳</option>
        <option value="4">４０歳〜４９歳</option>
        <option value="5">５０歳〜５９歳</option>
        <option value="6">６０歳〜</option>
      </select>
      <br>

      お問い合わせ内容
      <textarea name="contact">
        <?php if(!empty($_POST['contact'])){ echo h($_POST['contact']); } ?>
      </textarea>
      <br>

      注意事項のチェック
      <input type="checkbox" name="caution" value="1"></input>
      <br>

      <input type="submit" name="btn_confirm" value="確認する">
      <input type="hidden" name="csrf" value="<?php echo $token; ?>">
    </form>
  <?php endif; ?>

  <?php if($pageFlag === 1) : ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
      <form method="POST" action="input.php" >
        氏名
        <?php echo h($_POST['your_name']); ?>
        <br>
        
        メールアドレス
        <?php echo h($_POST['email']); ?>
        <br>

        ホームページ
        <?php echo h($_POST['url']); ?>
        <br>

        性別
        <?php
          if($_POST['gender'] === '0') { echo '男性'; }
          if($_POST['gender'] === '1') {echo '女性'; }
        ?>
        <br>

        年齢
        <?php
          if($_POST['age'] === '1') { echo '〜１９歳'; }
          if($_POST['age'] === '2') { echo '２０歳〜２９歳'; }
          if($_POST['age'] === '3') { echo '３０歳〜３９歳'; }
          if($_POST['age'] === '4') { echo '４０歳〜４９歳'; }
          if($_POST['age'] === '5') { echo '５０歳〜５９歳'; }
          if($_POST['age'] === '6') { echo '６０歳〜'; }
        ?>
        <br>

        お問い合わせ内容
          <?php echo h($_POST['contact']); ?>

        <br>

        注意事項のチェック
        <input type="checkbox" name="caution" value="1"></input>

        
        <input type="submit" name="back" value="戻る">
        <input type="submit" name="btn_submit" value="送信する">
        <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
        <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
        <input type="hidden" name="url" value="<?php echo h($_POST['url']); ?>">
        <input type="hidden" name="gender" value="<?php echo h($_POST['gender']); ?>">
        <input type="hidden" name="age" value="<?php echo h($_POST['age']); ?>">
        <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">

        <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">

      </form>
    <?php endif; ?>
  <?php endif; ?>
    
  <?php if($pageFlag === 2) : ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
      送信が完了しました。

      <?php unset($_SESSION['csrfToken']); ?>
    <?php endif; ?>
  <?php endif; ?>

  
</body>
</html>