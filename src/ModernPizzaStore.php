<?php

/**
 * @author Juriy Panasevich <panasevich@worksolutions.ru>
 */
class ModernPizzaStore extends AbstractPizzaStore {

    public function createStorage() {
        return new DatabaseStorageAdapter();
    }
}