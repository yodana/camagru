<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title> Camagru </title>
        <meta charset="UTF-8">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Camagru</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                </div>
            </div>
        </nav>
        <section class="jumbotron text-center">
            <div class="container">
            <h1 class="jumbotron-heading">Bienvenue sur Camagru !</h1>

            <form id="form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" id="submit-button" onclick="this.disabled = 'disabled'">Submit</button>
        </form>
        <p id="logError" class="text-danger"></p>
            <p>
                <a href="/register" class="btn btn-primary my-2">Pas encore inscrit ?</a>
            </p>
            </div>
        </section>
        <script type="text/javascript" src="../js/form_login.js"></script>
    </body>
</html>