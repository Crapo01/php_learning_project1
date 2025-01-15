<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');


$stm=$pdo->query("SELECT id, name FROM category");
$categories= $stm->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    $filename='';

    if (!empty($_FILES['file'])){
        $targetDirectory = "../../uploads/";
                        
        $file = $_FILES['file']['name'];        
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $tmpName = $_FILES['file']['tmp_name'];
        $path_filename_ext = $targetDirectory. $filename . ".". $ext;
        if (move_uploaded_file($tmpName, $path_filename_ext)){
            $filename = $filename . '.'. $ext;
        }

        $data = [
            'name' => $_POST['name'],
            'file' => $filename,
            'price' => $_POST['price'],
            'category' => $_POST['category'],
            'id' => $_GET['id']
        ];

        $sql = "UPDATE product SET name=:name, file=:file, price=:price, category_id=:category WHERE id=:id";
        $a = $pdo->prepare($sql)->execute($data);
        // redirection
        header("location: index.php");
    }
}
if ($_GET) {
    $stm = $pdo->query("SELECT * FROM product WHERE id=".$_GET['id']);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
}

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    {# multipart permet de recuperer la file avec $_FILES #}
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=$row['name']?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="price" id="price" value="<?=$row['price']?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                <?php foreach ($categories as $c){?>
                            <option value="<?=$c['id']?>" <?=($row['category_id']==$c['id'])? "selected":""?>><?=$c['name']?></option>
                            <?php } ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>

    </main>

<?php
require_once (__DIR__ . '/../../includes/footer.php');