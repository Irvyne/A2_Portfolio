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

unlink(__DIR__.'/uploads/'.$portfolio->getImg());

$portfolioManager->delete($portfolio);

header('Location: index.php');
