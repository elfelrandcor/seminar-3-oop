<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class DatabaseStorageAdapter extends AbstractStorageAdapter {

    protected $storage;

    public function __construct() {
        $this->storage = new DatabaseStorage();
    }

    public function addOrder(Order $order) {
        if ($order->isProcessed()) {
            throw new Exception('Заявка уже была выполнена');
        }
        $pizza = $order->getPizza();
        $data = [
            'type' => $order->getPizzaType(),
            'processed' => $order->isProcessed(),
            'pizza' => [
                'ingredient' => $pizza ? $pizza->getIngredient() : null,
                'sauce' => $pizza ? $pizza->getSauce() : null,
            ],
        ];
        return $this->storage->addRow($data);
    }

    public function hasOrder($number) {
        return $this->storage->hasRow($number);
    }

    public function getOrder($number) {
        foreach ($this->storage->getRows() as $row) {
            if ($row['number'] != $number) {
                continue;
            }
            return $this->restoreOrder($row);
        }
        throw new Exception("Заказ не найден");
    }

    /**
     * @return Order[]
     */
    public function getOrders() {
        $stored = $this->storage->getRows();
        $orders = [];
        foreach ($stored as $data) {
            $orders[] = $this->restoreOrder($data);
        }
        return $orders;
    }

    /**
     * @param $row
     * @return Order
     */
    private function restoreOrder($row) {
        $pizza = new Pizza();
        $pizza->setIngredient($row['pizza']['ingredient']);
        $pizza->setSauce($row['pizza']['sauce']);

        $order = new Order();
        $order->setPizzaType($row['type']);
        $order->setProcessed($row['processed']);
        $order->setPizza($pizza);
        return $order;
    }
}