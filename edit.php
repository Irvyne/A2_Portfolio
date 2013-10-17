<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

if (!empty($_GET['id']))
    $id = (int) $_GET['id'];
else
    header('Location: index.php');

require '_header.php';

$portfolioManager = new PortfolioManager($pdo);

$portfolio = $portfolioManager->find($id);

if (false === $portfolio) {
    header("HTTP/1.0 404 Not Found");
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['image_name']) && !empty($_FILES['image'])) {
        $image = $_FILES['image'];
        $tmp = $image['tmp_name'];
        $tmpImageName = $image['name'];
        $tmpImageNameExplodeExtension = explode('.', $tmpImageName);
        $extension = strtolower($tmpImageNameExplodeExtension[(sizeof($tmpImageNameExplodeExtension) - 1)]);
        $dirToUpload = __DIR__.'/uploads';
        $name = $_POST['name'];
        $content = $_POST['content'];
        $imageName = $_POST['image_name'];
        $realImageName = $imageName.'.'.$extension;
        if (move_uploaded_file($tmp, $dirToUpload.'/'.$realImageName)) {
            unlink($dirToUpload.'/'.$portfolio->getImg());
            $portfolio->setImg($realImageName);
        } else {
            echo 'Upload échoué !';
        }
    }
    if (!empty($_POST['name']) && !empty($_POST['content'])) {
        $portfolio->setName($_POST['name']);
        $portfolio->setContent($_POST['content']);
    }
    $portfolioManager->update($portfolio);
}

echo $twig->render('Portfolio/edit.html.twig', array(
    'portfolio' => $portfolio,
));

