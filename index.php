<?php

    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    // 1. เติม : mixed ไว้ท้ายฟังก์ชัน current
    function current(): mixed {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    // 2. เติม : void ไว้ท้ายฟังก์ชัน beginChildren
    function beginChildren(): void {
        echo "<tr>";
    }

    // 3. เติม : void ไว้ท้ายฟังก์ชัน endChildren
    function endChildren(): void {
        echo "</tr>" . "\n";
    }
}

    require_once ("config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    $stmt = $conn->prepare("SELECT id, firstname, lastname FROM users");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }

?>

</body>
</html>