<?php

/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Item\Traits;

use LoLong\Item\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasItems
{
    /**
     * @return string
     */
    public function itemModel(): string
    {
        return config('item.model');
    }

    /**
     * @return mixed
     */
    public function Items(): MorphMany
    {
        return $this->morphMany($this->ItemModel(), 'Itemlog');
    }

    /**
     * @param $data
     * @param Model      $creator
     * @param Model|null $parent
     *
     * @return static
     */
    public function Item($data, Model $creator, Model $parent = null)
    {
        $itemModel = $this->ItemModel();

        $item = (new $itemModel())->createItem($this, $data, $creator);

        if (!empty($parent)) {
            $parent->appendNode($item);
        }

        return $item;
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        $itemModel = $this->ItemModel();

        $item = (new $itemModel())->updateItem($id, $data);

        return $item;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteItem($id): bool
    {
        $itemModel = $this->ItemModel();

        return (bool) (new $itemModel())->deleteItem($id);
    }

    /**
     * @return mixed
     */
    public function itemCount(): int
    {
        return $this->items->count();
    }
}
