<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Categories.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Category\Traits;

use LoLong\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCategories
{
    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            config('category.models.category'),
            'model',
            'model_has_categories'
        );
    }

    public function categoriesList(): array
    {
        $items = [];
        $this->categories()->each(function($category) use (&$items){
            $items[] = array('id' => $category->id, 'name' => $category->name );
        });
        return $items;
    }

    public function assignCategory(...$categories)
    {
        $categories = collect($categories)
            ->flatten()
            ->map(function ($category) {
                return $this->getStoredCategory($category);
            })
            ->all();

        $this->categories()->saveMany($categories);

        return $this;
    }

    public function removeCategory($category)
    {
        $this->categories()->detach($this->getStoredCategory($category));
    }

    public function syncCategories(...$categories)
    {
        $this->categories()->detach();

        return $this->assignCategory($categories);
    }

    public function hasCategory($categories)
    {
        if (is_string($categories)) {
            return $this->categories->contains('name', $categories);
        }

        if ($categories instanceof Category) {
            return $this->categories->contains('id', $categories->id);
        }

        if (is_array($categories)) {
            foreach ($categories as $category) {
                if ($this->hasCategory($category)) {
                    return true;
                }
            }

            return false;
        }

        return $categories->intersect($this->categories)->isNotEmpty();
    }

    public function hasAnyCategory($categories)
    {
        return $this->hasCategory($categories);
    }

    public function hasAllCategories($categories)
    {
        if (is_string($categories)) {
            return $this->categories->contains('name', $categories);
        }

        if ($categories instanceof Category) {
            return $this->categories->contains('id', $categories->id);
        }

        $categories = collect()->make($categories)->map(function ($category) {
            return $category instanceof Category ? $category->name : $category;
        });

        return $categories->intersect($this->categories->pluck('name')) === $categories;
    }

    protected function getStoredCategory($category): Category
    {
        if (is_numeric($category)) {
            return app(Category::class)->findById($category);
        }

        if (is_string($category)) {
            return app(Category::class)->findByName($category);
        }

        return $category;
    }
}
