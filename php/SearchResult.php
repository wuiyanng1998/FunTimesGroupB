<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta charset="UTF-8">
    <title>My Account</title>
    <link href="../css/extrastyles.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="margin-bottom: 4vh">
    <a class="navbar-brand " href="../index.html" style="color: #9a9da0"><img align="middle"
                                                                              alt="Brand"
                                                                              height="20vw"
                                                                              src="../img/dvd-logo-png-10.png"
                                                                              width="40vw"/> Express </a>
    <button aria-controls="toggleNav" aria-expanded="false"
            aria-label="Toggle navigation" class="navbar-toggler"
            data-target="#toggleNav"
            data-toggle="collapse"
            type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="toggleNav">
        <div class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link " href="../index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../myaccount.html">MyAccount</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Films</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Series</a>
            </li>
        </div>

        <form class="form-inline my-2 my-md-0" method='post' action='../databasePhp/search.php' name='searchForm'>
            <input class="form-control input-lg-2" id="searchTxt" placeholder="Search" type="text" name="search">
            <button class="btn btn-default" id="search" type="submit">
                <img align="middle" height="18vw" src="../img/585e4ae1cb11b227491c3393.png" width="18vw"/></button>
        </form>
    </div>
</nav>

<h1 align="middle">Search results</h1>

<table class="table table-striped">
    <div class="table responsive">
        <thead>
        <tr>
            <th>Film id</th>
            <th>Title</th>
            <th>Release year</th>
            <th>Length (minutes)</th>
            <th>Actor</th>


        </tr>
        </thead>
        <tbody>


        <?php

        require_once('phpDatabaseConnection.php');
        session_start();
        $search = $_SESSION['search'];

        $qryFind = "SELECT * from film join film_actor on film.film_id = film_actor.film_id";
        $qryFind .= " JOIN actor on actor.actor_id= film_actor.actor_id";
        $qryFind .= " WHERE CONCAT( first_name, ' ', last_name) LIKE '%" . $search . "%'";
        $qryFind .=" OR  CONCAT(last_name, ' ', first_name)LIKE '%".$search . "%'
        UNION
        SELECT * from film join film_actor on film.film_id = film_actor.film_id ";
        $qryFind .="JOIN actor on actor.actor_id= film_actor.actor_id WHERE title LIKE '%".$search . "%'";

        $connection = connectToDb();

        //Check if the name exists
        $result_set = mysqli_query($connection, $qryFind);

        if (mysqli_num_rows($result_set) == 0) {
            echo "Sorry... no such films were found";
        } else {

            while ($row = mysqli_fetch_assoc($result_set)) {
                echo '
                <tr>
                    <td scope="row">' . $row['film_id'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td> ' . $row['release_year'] . '</td>
                    <td> ' . $row['length'] . '</td>
                    <td> ' . $row['first_name']  .  " " .$row['last_name'] . '</td>
                </tr>';
            }
        }

        ?>

        </tbody>
    </div>
</table>


</body>

</html>
