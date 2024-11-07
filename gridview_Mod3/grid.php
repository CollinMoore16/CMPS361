<?php 
    $data = [
        ["id" => 1, "name" => "BIGS Dill Pickle", "qty" => 5, "rank" => 1],
        ["id" => 2, "name" => "BIGS Taco Supreme", "qty" => 8, "rank" => 2],
        ["id" => 3, "name" => "BIGS Ranch", "qty" => 2, "rank" => 4],
        ["id" => 4, "name" => "David's Orignal", "qty" => 3, "rank" => 5],
        ["id" => 5, "name" => "David's Ranch", "qty" => 7, "rank" => 3]
    ];

    $sort_column = $_GET['sort_column'] ?? 'id';
    $sort_order = $_GET['sort_order'] ?? 'asc';

    usort($data, function($a, $b) use ($sort_column, $sort_order) {
        if ($a[$sort_column] == $b[$sort_column]) return 0;
        return ($a[$sort_column] < $b[$sort_column] ? -1 : 1) * ($sort_order == 'asc' ? 1 : -1);
    });

    function toggleSortOrder($current_order) {
        return $current_order === 'asc' ? 'desc' : 'asc';
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Grid View</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #000;
            margin: 0;
            color: #d3c4a1;
        }
        table {
            width: auto;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            overflow: hidden;
            background-color: #1a1a1a;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            white-space: nowrap;
        }
        th {
            background-color: #2e4a40;
            color: #d3c4a1;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        th:hover {
            background-color: #3d6055;
        }
        th a {
            color: inherit;
            text-decoration: none;
        }
        tr:nth-child(even) {
            background-color: #262626;
        }
        tr:hover {
            background-color: #333;
        }
        td {
            border-bottom: 1px solid #3d6055;
        }
        </style>
    </head>

    <body>

    <table>
        <thead>
            <tr>
                <th> <a href= "?sort_column=id&sort_order=<?= toggleSortOrder($sort_order) ?>">ID</a></th>
                <th> <a href= "?sort_column=name&sort_order=<?= toggleSortOrder($sort_order) ?>">NAME</a></th>
                <th> <a href= "?sort_column=qty&sort_order=<?= toggleSortOrder($sort_order) ?>">QTY</a></th>
                <th> <a href= "?sort_column=rank&sort_order=<?= toggleSortOrder($sort_order) ?>">RANK</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['qty']) ?></td>
                    <td><?= htmlspecialchars($row['rank']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </body>
</html>