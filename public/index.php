<html>
  <head>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
      crossorigin="anonymous"
    />
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    <title>JSON Server</title>
  </head>

  <body>
    <header>
      <div class="container">
        <nav>
          <ul>
            <li class="title">
              JSON Server
            </li>
            <li>
              <a href="https://github.com/users/typicode/sponsorship">
                <i class="fas fa-heart"></i>GitHub Sponsors
              </a>
            </li>
            <li>
              <a href="https://my-json-server.typicode.com">
                <i class="fas fa-burn"></i>My JSON Server
              </a>
            </li>
            <li>
              <a href="https://thanks.typicode.com">
                <i class="far fa-laugh"></i>Supporters
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">
        <h1>Congrats!</h1>
        <p>
          You're successfully running JSON Server
          <br />
          ✧*｡٩(ˊᗜˋ*)و✧*｡
        </p>

        <div id="resources"></div>

        <p>
          To access and modify resources, you can use any HTTP method:
        </p>
        <p>
          <code>GET</code>
          <code>POST</code>
          <code>PUT</code>
          <code>PATCH</code>
          <code>DELETE</code>
          <code>OPTIONS</code>
        </p>

        <div id="custom-routes"></div>

        <h1>Documentation</h1>
        <p>
          <a href="https://github.com/typicode/json-server">
            README
          </a>
        </p>
      </div>
    </main>

    <footer>
      <div class="container">
        <p>
          To replace this page, create a
          <code>./public/index.html</code> file.
        </p>
      </div>
    </footer>


    <script src="script.js"></script>



    <?php
      // подключение composer autoload
      require_once('../vendor/autoload.php');

      // подключение созданного класса
      use App\APIController;

      // создание экземпляра класса
      $api = new APIController();

      // получение данных о первом пользователе и вывод его имени
      $api->userGetData(1);
      echo $api->getUser(1)->name;

      echo "<br><br>";

      // получение постов пользователя
      echo $api->postsGetData(1);
      // вывод заголовка поста с индексом 11
      echo $api->getUserPosts(1)[11]->title;
      echo "<br>";
      // вывод постов пользователя через цикл
      $user1posts = $api->getUserPosts(1);
      foreach($user1posts as $user1post){
        echo json_encode($user1post);
        echo gettype($user1post);
        echo "<br>";
      }

      echo "<br><br>";

      // получение заданий пользователя
      echo $api->todosGetData(1);
      // вывод заголовка задания с индексом 0
      echo $api->getUserTodos(1)[0]->title;
      echo "<br>";
      // вывод заданий пользователя через цикл
      $user1todos = $api->getUserTodos(1);
      foreach($user1todos as $user1todo){
        echo json_encode($user1todo);
        echo gettype($user1todo);
        echo "<br>";
      }

      echo "<br><br>";

      // добавление поста у пользователя 1 с заголовком title' и телом 'body'
      echo $api->addPost(1, 'title', 'body');

      echo "<br><br>";

      // изменение заголовка и тела поста с индексом 0 у пользователя 1
      echo $api->editPost(1, 0, 'new title', 'new body');

      echo "<br><br>";

      // удаление индексом 1 у пользователя 1
      echo $api->deletePost(1, 1);
    ?>



  </body>
</html>
