<?php
    include("./database/conn.php");

    if($_SESSION['durum'] != 1){
        header("Location: ./login.php");
    }

    // Müşteri verilerini çek
    $sqlSelectLogs = "SELECT * FROM rapor ORDER BY id DESC";
    $stmtSelectLogs = $conn->query($sqlSelectLogs);
    $logs = $stmtSelectLogs->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor</title>
    <?php require_once("./include/header.php") ?>
</head>
<body>
<a href="./" class="backArrow">&#x21e6;</a>
<div class="tahta overflow-x-Table"style="width: 1360px; height: 650px; background-color: white; margin-top: 32px; margin-left: 70px; border-radius: 0.5rem;" >
    <table class="projectTables w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <tr>
            <th>Açıklama</th>
            <th>Durum</th>
            <th>Tarih</th>
        </tr>
        <?php 
        foreach($logs as $log) {
        ?>
        <tr>
            <td><?php echo($log['aciklama']) ?></td>
            <td>
                <?php 
                    if($log['durum'] == "1") {
                        echo('<span class="olumluTik">&#x2713;</span>');
                    }else {
                        echo('<span class="olumsuzTik">&#x2715;</span');
                    }
                ?>
            </td>
            <td><?php echo($log['saat'] . "/" . $log['tarih']); ?></td>
        </tr>
        <?php
        }
        ?>
        
    </table>
</div>    
</body>
</html>