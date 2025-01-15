<?php

require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../config/database.php');
$stm = $pdo->query("SELECT id,name FROM `product`");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php

                    // ECRITURE LONGUE
                    // foreach ($rows as $row) {
                    //     echo '<div class="col-md-4"><div class="card mb-4 box-shadow"><img class="img-fluid" src="https://fakeimg.pl/250x100/"/><div class="card-body"><p class="card-text">' . $row['name'] . ' </p></div></div></div>';
                    // }
                    // VERSION PLUS LISIBLE:
                    ?>
                    <?php foreach ($rows as $row) {?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="img-fluid" src="https://fakeimg.pl/250x100/"/>
                                <div class="card-body">
                                    <p class="card-text"><?= $row['name']?> </p>
                                <a href="show.php?id=<?=$row['id']?>">Afficher le produit</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <a href="new.php" class="btn btn-primary">New</a>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');