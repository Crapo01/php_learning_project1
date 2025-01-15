<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');

if ($_POST) {
    $filename='';

    if (!empty($_FILES['file'])){
        $targetDirectory = "../../uploads/";
        echo $targetDirectory;
        echo "<br>";
        var_dump($_FILES) ;
        // echo "<br>";
        // echo $targetDirectory;
        // echo "<br>";
        $file = $_FILES['file']['name'];
        // echo "file:"."<br>";
        // var_dump($file);
        // echo "<br>";

        $path = pathinfo($file);
        // echo "path:"."<br>";
        // var_dump($path);
        // echo "<br>";
        $filename = $path['filename'];
        // echo "file name:"."<br>";
        // var_dump($filename);
        // echo "<br>";
        $ext = $path['extension'];
        // echo "ext:"."<br>";
        // var_dump($ext);
        // echo "<br>";
        $tmpName = $_FILES['file']['tmp_name'];
        $path_filename_ext = $targetDirectory. $filename . ".". $ext;
        if (move_uploaded_file($tmpName, $path_filename_ext)){
            $filename = $filename . '.'. $ext;
        }

        $sql = "INSERT INTO product (name, file, category_id, price) VALUES (?,?,?,?)";
        $a = $pdo->prepare($sql)->execute([$_POST['name'],$filename,$_POST['category'],$_POST['price'],]);
        // redirection
        header("location: index.php");
    }
}

$stm=$pdo->query("SELECT id, name FROM category");
$categories= $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    {# multipart permet de recuperer la file avec $_FILES #}
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                <?php foreach ($categories as $c){?>
                            <option value="<?=$c['id']?>"><?=$c['name']?></option>
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