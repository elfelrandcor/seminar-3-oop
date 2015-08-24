<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
abstract class AbstractPizzaStore {

    /** @var  AbstractStorageAdapter */
    protected $storage;

    public function __construct() {
        $this->storage = $this->createStorage();
    }

    abstract public function createStorage();

    public function createOrder($pizzaType) {
        $order = new Order();
        $order->setPizzaType($pizzaType);
        $this->storage->addOrder($order);
        return $this;
    }

    public function takeOrder($number) {
        $order = $this->storage->getOrder($number);
        if (!$order->isProcessed()) {
            throw new Exception('Заказ не обработан');
        }
        return $order->getPizza();
    }

    public function processOrders() {
        foreach ($this->storage->getOrders() as $order) {
            if ($order->isProcessed()) {
                continue;
            }
            $order->process();
        }
        return $this;
    }
}