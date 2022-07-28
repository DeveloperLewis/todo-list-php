<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">TODO™</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Front Page</a>
        </li>
        <?php

        if(!isset($_SESSION['uid'])) {
          echo '<li class="nav-item">';
          echo '<a class="nav-link" href="/user/register">Register</a>';
          echo '</li>';
        }

        if(!isset($_SESSION['uid'])) {
          echo '<li class="nav-item">';
          echo '<a class="nav-link" href="/user/login">Login</a>';
          echo '</li>';
        }

        if(isset($_SESSION['uid'])) {
          echo '<li class="nav-item">';
          echo '<a class="nav-link" href="/todo">Todo List</a>';
          echo '</li>';
        }

        if(isset($_SESSION['uid'])) {
          echo '<li class="nav-item">';
          echo '<a class="nav-link" href="/user/logout">Logout</a>';
          echo '</li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
