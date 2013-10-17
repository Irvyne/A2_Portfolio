<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

$portfolioManager = new PortfolioManager($pdo);

$portfolios = $portfolioManager->findAll();

echo $twig->render('Portfolio/list.html.twig', array(
    'portfolios' => $portfolios,
));