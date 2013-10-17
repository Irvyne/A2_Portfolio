<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require '_header.php';

$portfolio = new Portfolio(array(
    'name'      => 'Nom du portfolio',
    'content'   => 'Contenu',
    'img'       => '/efezf/ezfezf.png',
    'createdAt' => date('Y-m-d H:i:s'),
    'updatedAt' => date('Y-m-d H:i:s'),
));

$portfolioManager = new PortfolioManager($pdo);

//$portfolioManager->add($portfolio);

var_dump($portfolio);