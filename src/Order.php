<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class Order {

    protected $processed;
    protected $pizzaType;

    private $pizza = null;
    /** @var AbstractPizzaBuilder[] */
    private $builders = [];


    public function isProcessed() {
        return $this->processed;
    }

    public function process() {
        $builder = $this->factoryBuilder($this->pizzaType);
        $this->pizza = $builder->makePizza();
        $this->processed = true;
        return $this;
    }

    public function factoryBuilder($pizzaType) {
        if ($this->builders[$pizzaType]) {
            return $this->builders[$pizzaType];
        }
        if ($pizzaType == PIZZA_MUSHROOM) {
            $this->builders[$pizzaType] = new MushRoomsPizzaBuilder();
        }
        if ($pizzaType == PIZZA_MEAT) {
            $this->builders[$pizzaType] = new MeatPizzaBuilder();
        }
        if (!$this->builders[$pizzaType]) {
            throw new Exception(sprintf('Тип пиццы `%s` не найден', $pizzaType));
        }
        return $this->builders[$pizzaType];
    }

    /**
     * @return Pizza
     * @throws Exception
     */
    public function getPizza() {
        return $this->pizza;
    }

    public function getPizzaType() {
        return $this->pizzaType;
    }

    /**
     * @param mixed $pizzaType
     */
    public function setPizzaType($pizzaType) {
        $this->pizzaType = $pizzaType;
    }

    public function setPizza(Pizza $pizza) {
        $this->pizza = $pizza;
    }

    public function setProcessed($processed) {
        $this->processed = $processed;
    }
}