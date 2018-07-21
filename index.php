<?php
require __DIR__ . '/Breadcrumb.php';
echo "<pre>";

$oBreadcrumb = new Breadcrumb();

$oBreadcrumb
    ->add('Home', '/index')
    ->add('Nível 1', '/nivel-1')
    ->add('Item');

echo "Breadcrumb->getHtml";
echo $oBreadcrumb->getHtml();

$oBreadcrumb->addFirst('Nível 0', 'nivel-0');
echo "Breadcrumb->addFirst";
echo $oBreadcrumb->getHtml();

$oBreadcrumb->addLast('Ultimo Item', 'ultimo-item');
echo "Breadcrumb->addLast";
echo $oBreadcrumb->getHtml();

$oBreadcrumb->addBefore(3,'Nível < 3', '#');
echo "Breadcrumb->addBefore 3";
echo $oBreadcrumb->getHtml();

$oBreadcrumb->addAfter(3,'Nível > 3', '#');
echo "Breadcrumb->addAfter 3";
echo $oBreadcrumb->getHtml();

$oBreadcrumb->remove(1);
echo "Breadcrumb->remove 1";
echo $oBreadcrumb->getHtml();

$aBreadcrumb = [
    ['texto' => 'Home', 'link' => "/index"],
    ['texto' => 'Nível 1', 'link' => "/nivel-1"],
    ['texto' => 'Item'],
];
$oBreadcrumbA = Breadcrumb::createFromArray($aBreadcrumb);
echo "Breadcrumb::createFromArray";
print_r($aBreadcrumb);
echo $oBreadcrumbA->getHtml();


