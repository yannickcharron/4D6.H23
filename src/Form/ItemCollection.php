<?php

namespace App\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ItemCollection {

    private $items;

    public function __construct($items)
    {
        $this->items = new ArrayCollection($items);
    }

    public function getItems() : Collection 
    {
        return $this->items;
    }

}