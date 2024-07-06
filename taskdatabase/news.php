<?php require_once "php/connect.php";
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM `news` WHERE `id` = '$id'");
    $result = mysqli_fetch_assoc($query);
    $timestamp = strtotime($result['date']);
    $date = date('d.m.Y', $timestamp);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Галактический вестник / Новости</title>
  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/news.css">
  <link type="Image/x-icon" href="img/favicon.svg" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header__container container">
      <a class="header__logo" href="./index.php">
        <img src="img/logo.png" alt="Логотип Галактический вестник">
      </a>
    </div>
  </header>

  <section class="news">
    <div class="container">
      <a class="news__link" href="./index.php">Главная / <span class="colortext"><?php echo $result['title']; ?></span></a>
      <h1 class="news__title"><?php echo $result['title']; ?></h1>
      <ul class="news__list">
        <li class="reset-list news__card">
          <div class="news_rotate">
            <div class="news__text">
            <span class="news__card_date"><?php echo $date ?></span>
              <h3 class="news__card_title"><?php echo $result['announce']; ?></h3>
              <?php echo $result['content']; ?>
            </div>
            <img class="resizephoto" src="./imagestonews/<?php echo $result['image']; ?>" alt="Фото">
          </div>
          <a class="news_card_btn" href="./index.php"> <svg class="arrow" width="26" height="16" viewbox="0 0 26 16"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.293015 8.70711C-0.097509 8.31658 -0.097509 7.68342 0.293015 7.2929L6.65698 0.928934C7.0475 0.53841 7.68066 0.538409 8.07119 0.928934C8.46171 1.31946 8.46171 1.95262 8.07119 2.34315L2.41434 8L8.07119 13.6569C8.46171 14.0474 8.46171 14.6805 8.07119 15.0711C7.68067 15.4616 7.0475 15.4616 6.65698 15.0711L0.293015 8.70711ZM26 9L1.00012 9L1.00012 7L26 7L26 9Z"
                fill="currentColor" />
            </svg>
            <span class="link__text">Назад к новостям</span>
          </a>
        </li>
      </ul>
      <div class="news__borderbottom">
      <svg width="1520" height="1" viewbox="0 0 1520 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="-4.37114e-08" y1="0.500122" x2="1520" y2="0.499989" stroke="#6C6E7B" />
      </svg>
    </div>
    </div>
  </section>
  <section class="footer">
    <div class="container">
      <p class="footer__descr">&copy;&nbsp;2023&nbsp;&mdash; 2412 &laquo;Галактический вестник&raquo;</p>
    </div>
  </section>
</body>

</html>
