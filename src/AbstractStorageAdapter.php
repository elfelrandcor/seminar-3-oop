<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
abstract class AbstractStorageAdapter {

    abstract public function addOrder(Order $order);

    abstract public function hasOrder($number);

    /**
     * @param $number
     * @return Order
     */
    abstract public function getOrder($number);

    /**
     * @return Order[]
     */
    abstract public function getOrders();
}