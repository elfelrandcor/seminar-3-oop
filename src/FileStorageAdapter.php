<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class FileStorageAdapter extends AbstractStorageAdapter {

    protected $storage;

    public function __construct() {
        $this->storage = new FileStorage();
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

        $stored = $this->storage->read();
        $stored = json_decode($stored, true);
        $stored[] = $data;
        $stored = json_encode($stored);

        $this->storage->write($stored);
        return count($stored);
    }

    public function hasOrder($number) {
        $number = $number - 1;
        $stored = $this->storage->read();
        $stored = json_decode($stored, true);
        return !!$stored[$number];
    }

    public function getOrder($number) {
        $number = $number - 1;
        $stored = $this->storage->read();
        $stored = json_decode($stored, true);

        $data = $stored[$number];
        if (!$data) {
            throw new Exception("Заказ не найден");
        }
        return $this->restoreOrder($data);
    }

    /**
     * @return Order[]
     */
    public function getOrders() {
        $stored = $this->storage->read();
        $stored = json_decode($stored, true);

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