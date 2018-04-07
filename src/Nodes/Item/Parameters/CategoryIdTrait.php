<?php

namespace Shopee\Nodes\Item\Parameters;

trait CategoryIdTrait
{
    public function getCategoryId(): int
    {
        return $this->parameters['category_id'];
    }

    /**
     * Should call shopee.item.GetCategories to get category first.Related to result.categories.category_id
     *
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId(int $categoryId)
    {
        $this->parameters['category_id'] = $categoryId;

        return $this;
    }
}
