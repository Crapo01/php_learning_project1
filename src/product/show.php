<?php

require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../config/global.php');

if ($_GET) {
    $stm = $pdo->prepare("SELECT * FROM product WHERE id = ?");
    $stm->bindValue(1,$_GET['id']);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
}

?>

<main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                   
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="img-fluid" src="<?= BASE_URL?>uploads/<?= $row['file']?>"/>
                                <div class="card-body">
                                    <p class="card-text"><?= $row['name']?> </p>
                                <a href="index.php" class="btn btn-primary">Retour</a>
                                <a href="delete.php?id=<?= $row['id']?>" class="btn btn-danger">Delete</a>
                                <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Edit</a>
                                
                            </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>

    </main>

<?php
require_once (__DIR__ . '/../../includes/footer.php');