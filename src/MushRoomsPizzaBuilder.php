<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class MushRoomsPizzaBuilder extends AbstractPizzaBuilder {

    public function makePizza() {
        $pizza = new Pizza();
        $pizza->setIngredient(PIZZA_MUSHROOM);
        return $pizza;
    }
}