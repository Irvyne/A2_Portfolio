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

var_dump($portfolio);

echo $twig->render('Portfolio/edit.html.twig', array(
    'portfolio' => $portfolio,
));

