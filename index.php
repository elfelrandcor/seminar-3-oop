<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/vendor/defines.php";

$classicPizzaStore = new ClassicPizzaStore();

$order1 = $classicPizzaStore->createOrder(PIZZA_MUSHROOM);
$order2 = $classicPizzaStore->createOrder(PIZZA_MEAT);

$classicPizzaStore->processOrders();

$classicPizzaStore->takeOrder($order1);
$classicPizzaStore->takeOrder($order2);

$modernPizzaStore = new ModernPizzaStore();

$order1 = $modernPizzaStore->createOrder(PIZZA_MUSHROOM);

$modernPizzaStore->processOrders();

$modernPizzaStore->takeOrder($order1);
