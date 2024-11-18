<?php 
    $api_url = 'http://localhost/gridview_Mod3/api.php';
    $sort_column = $_GET['sort_column'] ?? 'id';
    $sort_order = $_GET['sort_order'] ?? 'asc';

    $api_url .= "?sort_column=" . urlencode($sort_column) . "&sort_order=" . urlencode($sort_order);

    $json_data = file_get_contents($api_url);

    $data = json_decode($json_data, true);

    if(isset($data['data'])) {
        $items = $data['data'];
        $pagination = $data['pagination'] ?? [];
    } else {
        $items = [];
        $pagination = [];
    }

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