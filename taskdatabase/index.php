<?php require_once "php/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Галактический вестник</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link type="Image/x-icon" href="img/favicon.svg" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="UTF-8"></script>
</head>

<body>
  <header class="header">
    <div class="header__container container">
      <a class="header__logo" href="">
        <img src="img/logo.png" alt="Логотип Галактический вестник" width="390px" height="74px">
      </a>
    </div>
  </header>

  <section class="hero">
    <div class="container">
      <div class="hero__wrap">
        <div class="hero__content">
          <h1 class="hero__title">Возвращение этнографа</h1>
          <p class="hero__descr">Сегодня с&nbsp;Проксимы вернулась этнографическая экспедиция Джона Голдрама.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="news">
    <div class="container">
      <h2 class="news__title">Новости</h2>
      <ul class="news__list" style="display:none">
        <?php
          $query = mysqli_query($conn, "SELECT * FROM `news` ORDER BY `date` DESC");
          while($result = mysqli_fetch_assoc($query)){
            $id = $result['id'];
            $timestamp = strtotime($result['date']);
            $title = $result['title'];
            $announce = $result['announce'];
            $date = date('d.m.Y', $timestamp);
            echo "<li class='reset-list news__card'>
                  <span class='news__card_date'>$date</span>
                  <h3 class='news__card_title'>$title</h3>
                  $announce
                  <a class='news_card_btn' href='news.php?id=$id'>Подробнее
                    <svg class='arrow' width='27' height='16' viewbox='0 0 27 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                      <path d='M1 7C0.447715 7 4.82823e-08 7.44772 0 8C-4.82823e-08 8.55228 0.447715 9 1 9L1 7ZM26.707 8.70711C27.0975 8.31658 27.0975 7.68342 26.707 7.2929L20.343 0.928934C19.9525 0.538409 19.3193 0.538409 18.9288 0.928934C18.5383 1.31946 18.5383 1.95262 18.9288 2.34315L24.5857 8L18.9288 13.6569C18.5383 14.0474 18.5383 14.6805 18.9288 15.0711C19.3193 15.4616 19.9525 15.4616 20.343 15.0711L26.707 8.70711ZM1 9L25.9999 9L25.9999 7L1 7L1 9Z' fill='currentColor' />
                    </svg>
                  </a>
                </li>";
          }
        ?>
      </ul>
      <div class="pagination">
        <li class="reset-list page-item current-page previous-page"><a class="page-link" href="#"></a>1</li>
        <li class="reset-list page-item current-page disable"><a class="page-link" href="#"></a>2</li>
        <li class="reset-list page-item current-page"><a class="page-link" href="#"></a>3</li>
        <li class="reset-list page-item current-page"><a class="page-link" href="#"></a>4</li>
        <li class="reset-list page-item current-page"><a class="page-link" href="#"></a>5</li>
        <li class="reset-list page-item next-page"><a class="page-link" href="#">
        <svg width="17" height="16" viewbox="0 0 17 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M1 7C0.447715 7 -4.82823e-08 7.44772 0 8C4.82823e-08 8.55228 0.447715 9 1 9L1 7ZM16.466 8.70711C16.8565 8.31658 16.8565 7.68342 16.466 7.29289L10.102 0.928931C9.7115 0.538407 9.07834 0.538407 8.68781 0.928932C8.29729 1.31946 8.29729 1.95262 8.68781 2.34315L14.3447 8L8.68781 13.6569C8.29729 14.0474 8.29729 14.6805 8.68781 15.0711C9.07834 15.4616 9.7115 15.4616 10.102 15.0711L16.466 8.70711ZM1 9L15.7589 9L15.7589 7L1 7L1 9Z" fill="currentColor" />
</svg>
        </a></li>
      </div>

      <script type="text/javascript">
        function getPagelist(totalPages, page, maxLength){
          function range(start, end){
            return Array.from(Array(end - start + 1),(_, i) => i + start);
          }

          var sideWidth = maxLength < 5 ? 1 : 2;
          var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
          var rigthWidth = (maxLength - sideWidth * 2 - 3) >> 1;

          if(totalPages <= maxLength){
            return range(1, totalPages);
          }

          if(page <= maxLength - sideWidth - 1 - rigthWidth){
            return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
          }

          if(page >= totalPages - sideWidth - 1 - rigthWidth){
            return range(1,sideWidth).concat(0,range(totalPages- sideWidth - 1 - rigthWidth - leftWidth, totalPages));
          }

          return range(1, sideWidth).concat(0, range(page - leftWidth, page + rigthWidth), 0,range(totalPages - sideWidth + 1, totalPages));
        }

        $(function(){
          var numerOfItems = $(".news__list .news__card").length;
          var limitPerPage = 4;//Сколько карточек новостей будет отображаться на странице
          var totalPages = Math.ceil(numerOfItems / limitPerPage)
          var paginationSize = 3;//кол-во элементов страниц в пагинации
          var currentPage;

          function showPage(whichPage){
            if(whichPage < 1 || whichPage > totalPages) return false;

            currentPage = whichPage;

            $(".news__list .news__card").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

            $("pagination li").slice(1, -1).remove();

            getPagelist(totalPages, currentPage, paginationSize).forEach(item => {
              $("<li>").addClass("page-item").addClass("current-page").toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
                .attr({href: "javascript:void(0)"}));
            });

            $(".previous-page").toggleClass("disable", currentPage === 1);
            $(".next-page").toggleClass("disable", currentPage === totalPages);
            return true;
          }

          $(".news__list").show();
          showPage(1);

          $(document).on("click", ".pagination li.current-page:not(.active)",function(){
            return showPage(+$(this).text());
          });
        });
      </script>

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
