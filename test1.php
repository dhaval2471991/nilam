<?php
$databaseHost = 'localhost';
$databaseName = 'magento1';
$databaseUsername = 'root';
$databasePassword = 'root123';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
// NUMBER OF ROWS TO SHOW PER PAGE
$limit = 10;
 
// GET PAGE AND OFFSET VALUE
if (isset($_GET['p'])) {
    $page = $_GET['p'] - 1;
    $offset = $page * $limit;
} else {
    $page = 0; 
    $offset = 0;
}
 
// COUNT TOTAL NUMBER OF ROWS IN TABLE
$sql = "SELECT count(id) FROM reg";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);
$total_rows = $row[0];
 
// DETERMINE NUMBER OF PAGES
if ($total_rows > $limit) {
    $number_of_pages = ceil($total_rows / $limit);
} else {
    $pages = 1;
    $number_of_pages = 1;
}
 
// FETCH DATA USING OFFSET AND LIMIT
$result = mysqli_query($mysqli, "SELECT * FROM reg LIMIT $offset, $limit");
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
 
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>id</td>
        <td>name</td>
        <td>last</td>        
    </tr>
    <?php 
    while($res = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$res[0]."</td>";
        echo "<td>".$res[1]."</td>";
        echo "<td>".$res[2]."</td>";            
    }
    ?>    
    </table>
    
    <?php
    // SHOW PAGE NUMBERS
    if ($page) {
        echo "<a href='index.php?page=1'>First</a> ";
    }
    for ($i=1;$i<=$number_of_pages;$i++) {
        echo "<a href='index.php?p=$i'>".$i."</a> ";
    }    
    if (($page + 1) != $number_of_pages) {
        echo "<a href='index.php?p=$number_of_pages'>Last</a> ";
    }
    ?>
</body>
</html>
