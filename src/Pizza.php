<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class Pizza {
    protected $ingredient;
    protected $sauce;

    /**
     * @param mixed $ingredient
     */
    public function setIngredient($ingredient) {
        $this->ingredient = $ingredient;
    }

    /**
     * @return mixed
     */
    public function getIngredient() {
        return $this->ingredient;
    }

    /**
     * @return mixed
     */
    public function getSauce() {
        return $this->sauce;
    }

    /**
     * @param mixed $sauce
     */
    public function setSauce($sauce) {
        $this->sauce = $sauce;
    }
}