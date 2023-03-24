<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>
        <?php
            // Connectie met de database
            require_once "../backend/conn.php";
            // query aanmaken om alle meldingen op te halen
            $query = "SELECT * FROM meldingen";
            // voorbereiden van de query
            $statement = $conn->prepare($query);
            // uitvoeren van de query
            $statement->execute();
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table>
            <tr>
                <th>attractie</th>
                <th>type</th>
                <th>capaciteit</th>
                <th>prioriteit</th>
                <th>melder</th>
                <th>gemeld op</th>
                <th>overige info</th>
                <th>Aanpassen</th>
            </tr>
        <?php foreach ($meldingen as $melding): ?> 
            <tr>
                <td><?php echo $melding['attractie'];?></td>
                <td><?php echo $melding['type'];?></td>
                <td><?php echo $melding['capaciteit'];?></td>
                <td><?php
                if($melding['prioriteit'])
                    {
                        echo 'ja';
                    }
                else
                    {
                        echo 'nee';
                    };
                ?></td>
                <td><?php echo $melding['melder'];?></td>
                <td><?php echo $melding['gemeld_op'];?></td>
                <td><?php echo $melding['overige_info'];?></td>
                <td><a href="edit.php?id=<?php echo $melding['id'];?>">aanpassen</a></td>
            </tr>
        <?php endforeach; ?>
        </table>    
    </div>  

</body>

</html>
