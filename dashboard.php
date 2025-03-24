<?php
session_start();
$isLogged = false;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
} else {
    $isLogged = true;
    $user_id = $_SESSION['user_id'];
}

include 'db-conf.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="styles/dashbord.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']->name); ?>!</h1>
        <h2>Movie Search App</h2>
        <div>
            <?php
            if($isLogged) {
            ?>
                <a class="logout-btn" href=<?php echo "actions/logout?id=" . $_SESSION['user_id']; ?>>Logout</a>
            <?php
            }
            ?>
        </div>
        <input type="text" id="movieQuery" placeholder="Search movies...">
        <button onclick="searchMovies()">Search</button>
        <div id="results"></div>

        <h2>Favorite Movies</h2>
        <ul id="favoriteMoviesList">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM favorite_movies WHERE user_id = ?");
            $stmt->execute([$user_id]);
            while ($row = $stmt->fetch()) {
                echo "<li>{$row['movie_title']} <a href='actions/remove_favorite.php?id={$row['id']}'>Remove</a></li>";
            }
            ?>
        </ul>
    </div>
    <script src="script.js"></script>
</body>

<script>
function searchMovies() {
    let query = document.getElementById('movieQuery').value;
    if (query.trim() === '') return;
    fetch('ajax/search.php?query=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            let resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';
            if (data.Response === "True") {
                data.Search.forEach(movie => {
                    resultsDiv.innerHTML += `
                        <div>
                            <img src="${movie.Poster}" width="100">
                            <p>${movie.Title}</p>
                            <a href='actions/add_favorite.php?title=${encodeURIComponent(movie.Title)}&id=${movie.imdbID}&poster=${encodeURIComponent(movie.Poster)}'>Add to Favorite</a>
                        </div>`;
                });
            } else {
                resultsDiv.innerHTML = "No movies found!";
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>
</html>