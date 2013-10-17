<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

if (isset($_POST['submit'])) {
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
        $portfolioManager = new PortfolioManager($pdo);
        $portfolio = new Portfolio(array(
            'name'      => $name,
            'content'   => $content,
            'img'       => $realImageName,
        ));
        $portfolioManager->add($portfolio);
    } else {
        echo 'Upload échoué !';
    }
}

echo $twig->render('Portfolio/add.html.twig');