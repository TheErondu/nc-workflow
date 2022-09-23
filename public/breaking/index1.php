
<!DOCTYPE html>
<html>
  <head>
    <title>Breaking News</title>
    <link
      rel="stylesheet"
      href="bootstrap.css"
    />
    <script src="jquery-3.6.0.min.js"></script>
</head>
  <body>
  <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success']; ?></div>
                        <?php
                        unset($_SESSION['success']);
                    }
                    ?>
      <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) { ?>
                        <div class="error-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['error']; ?></div>
                        <?php
                        unset($_SESSION['error']);
                    }
                    ?>
    <div class="col-sm-6 col-sm-offset-3">
      <h1>Post Breaking News</h1>

      <form action="playout.php" method="POST">
        <div id="title-group" class="form-group">
          <label for="name">Title</label>
          <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            placeholder="Title"
            required
          />
        </div>

        <div id="content-group" class="form-group">
          <label for="content">content</label>
          <input
            type="text"
            class="form-control"
            id="content"
            name="content"
            placeholder="content"
            required
          />
        </div>

        <button type="submit" class="btn btn-success">
          Submit
        </button>
        <button type="submit" form="stop-form" class="btn btn-success">
          Clear GFX
        </button>
      </form>
      <br>
      <form action="stop.php" method="POST" id="stop-form">
      </form>
    </div>
  </body>
</html>