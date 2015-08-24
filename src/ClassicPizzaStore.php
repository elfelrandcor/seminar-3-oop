<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class ClassicPizzaStore extends AbstractPizzaStore {

    public function createStorage() {
        return new FileStorageAdapter();
    }
}