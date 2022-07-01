<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    echo('hello');
    echo('<br>');
    
    $test01 = 123;
    $test02 = 456;
    var_dump($test01 . $test02);
    // echo $test;
    echo('<br>');

    // ---------------------------------------
    
    const max = 10;
    echo max;
    echo('<br>');
    
    // ---------------------------------------
    
    $array = [1, 2, 3];
    echo ('<pre>');
    var_dump($array);
    echo ('</pre>');
    
    // ---------------------------------------
    
    $array_member = [
      'name' => 'matsu',
      'age' => 28
      
    ];
    
    echo $array_member['name'];
    echo('<br>');
    
    // ---------------------------------------
    $height = 90;
    
    if($height == 90) {
      echo '身長は' . $height . 'cmです。';
      
    } else {
      echo '身長は' . $height . 'cmではありません。';
    }
    echo('<br>');
    
    // ---------------------------------------
    $signal = 'red';
    
    if($signal === 'red') {
      echo '止まれ';
    } else if ($signal === 'yellow') {
      echo '一旦停止';
      
    } else {
      echo '進む';
    }
    
    echo('<br>');
    // == 一致
    // 型も一致
    
    
    // ---------------------------------------
    // データが入っているかどうか
    $check = '1';
    
    if(!empty($check)) {
      echo '変数は空ではありません';
    }
    
    echo('<br>');
    // ---------------------------------------
      // 三項演算子
    // 条件 ? 真 : 偽
    $math = 80;
    $comment = $math > 80 ? 'good' : 'not good';

    echo $comment;

    echo('<br>');
    
    // ---------------------------------------
    //複数の値 foreach
    $members = [
      '香川' => [
        'height' => 170,
        'hobby' => 'サッカー'
      ],
      '本田' => [
        'height' => 175,
        'hobby' => '伸び代'
      ]

    ];

    // バリューのみ表示（多段階で展開）
    foreach($members as $member) {
      foreach($member as $player) {
        echo $player;

      }
    }
    echo('<br>');
    
    // キーとバリューそれぞれ表示
    // foreach($members as $key => $value) {
      //   echo $key . 'は' . $value . 'です';
      // }
      
    // ---------------------------------------
    // for（繰り返す数が決まっている）
    // while（繰り返す数が決まっていない）
    echo('<br>');
    
    // continue, break
    for($i = 0; $i < 10; $i++) {
      if($i === 5) {
        // break;
        // continue;
      }
      echo $i;
      
      }
      
    echo('<br>');
    
    $j = 0;
    while($j < 5) {
      echo $j;
      $j++;
      
    }
    echo('<br>');
    // ---------------------------------------
    // switch文（if文の方がベター）
    // switch → ==で判定
    // if → ==と===で指定できる
    $data = 4;

    switch($data) {
      case 1:
        echo '1です';
        break;
      case 2:
        echo '2です';
        break;
      case 3:
        echo '3です';
        break;
      default:
        echo 'それ以外';
    }

    echo('<br>');
    // ---------------------------------------
    
    // インプット引数なし
    // アウトプット戻り値なし
    function test01() {
      echo 'テスト１';
    }
    
    test01();
    echo('<br>');
    
    // ---------------------------------------
    
    // インプット引数あり
    // アウトプット戻り値なし
    
    $comment02 = 'テスト２';
    function test02($str) {
      echo $str;
    }
    
    test02($comment02);
    
    echo('<br>');
    
    // ---------------------------------------
    // インプット引数なし
    // アウトプット戻り値あり
    
    function test03() {
     return 5;

    }
    // 実行元に結果は返ってくるのみ。
    $test03_check = test03();
    var_dump($test03_check);
    
    
    echo('<br>');
    
    // ---------------------------------------
    // インプット引数あり
    // アウトプット戻り値あり
    function test04($int01, $int02) {
      $int03 = $int01 + $int02;
      return $int03;

    }
    
    $total = test04(2, 5);
    echo $total;
    
    
    echo('<br>');
    // ---------------------------------------
    // 文字列組み込み関数
    
    // 文字の長さ
      // マルチバイト
      // 日本語では SJIS, UTF-8 3~6バイト
      $text_len = 'アイウエオ';
      
      // バイト数
      echo strlen($text_len);
      echo('<br>');
      
      // 日本語の文字数をとる
      echo mb_strlen($text_len);
      echo('<br>');
      
    // 文字の置換
      $str = '文字列を置換します。';
      echo str_replace('置換', 'ちかん', $str);
      echo('<br>');
      
      // 指定文字列で配列として分割
      $str_02 = '指定文字列で、分割します。';
      var_dump(explode('、', $str_02));
      echo('<br>');
      
      
      // 正規表現
      // 文字化どうか
      // 数字かどうか
      // 郵便番号
      // メールアドレスかどうか
      
      $str_03 = '特定の文字列が含まれるかboolian型で確認する';
      echo preg_match('/特定の文字列/', $str_3);



    echo('<br>');
    
    
    // 指定文字列から文字列を取得する
    echo substr('abcde', 1);
  
    echo('<br>');



    // ---------------------------------------
      // ユーザー定義関数で組み込み関数を作る
        // 郵便番号チェック
        $postalCode = '123-4567';

        function checkPostalCcode($str) {
          $replaced = str_replace('-', '', $str);
          $length = strlen($replaced);

          if($length === 7) {
            return true;
          } else {
            return false;

          }

        }

        var_dump((checkPostalCcode($postalCode)));


    echo('<br>');
    // ---------------------------------------

    $globalVariable = 'グローバル変数です。';

    function checkScope() {
      $localVariable = 'ローカル変数です。';
      echo $localVariable;

      global $globalVariable;
      echo $globalVariable;

    }

    echo $globalVariable;

    checkScope();

    echo('<br>');
    // ---------------------------------------


    require 'common.php';
    echo $commonVariable;

    echo __DIR__;
    
    commonTest();


    echo('<br>');
    // ---------------------------------------
    
    ?>
</body>
</html>