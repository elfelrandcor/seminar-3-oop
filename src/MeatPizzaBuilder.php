<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class MeatPizzaBuilder extends AbstractPizzaBuilder {

    public function makePizza() {
        $pizza = new Pizza();
        $pizza->setIngredient(PIZZA_MEAT);
        return $pizza;
    }
}