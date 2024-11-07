<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Vinyl Records</title>
    <style>
        body {
            background-color: #121212; 
            color: #ffffff; 
            font-family: Arial, sans-serif; 
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: none; 
            padding: 0; 
        }
        li {
            margin: 20px; 
            text-align: center;
        }
        img {
            max-width: 200px; 
            height: auto; 
        }
    </style>
</head>
<body>
    <center> 
    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 1; 
        $limit = 2;
        $url = "http://localhost:3000/api/records?page=$page&limit=$limit";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data['data'])) {
            echo "<h1>Vinyl Records</h1><ul>";
            foreach ($data['data'] as $record) {
                echo "<li>";
                echo "<img src='http://localhost:3000{$record['image']}' alt='{$record['title']} by {$record['artist']}'>";
                echo "<p>{$record['title']} by {$record['artist']} ({$record['year']}) - Genre: {$record['genre']}</p>";
                echo "</li>";
            }
            echo "</ul>";

            if ($data['previous']) {
                echo "<a href='?page={$data['previous']}'>Previous</a> ";
            }
            if ($data['next']) {
                echo "<a href='?page={$data['next']}'>Next</a> ";
            }
        } else {
            echo "<p>No Records Available.</p>";
        }
    ?>
    </center>
</body>
</html>
