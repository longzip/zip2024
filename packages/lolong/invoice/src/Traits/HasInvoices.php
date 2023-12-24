<?php

/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Invoice\Traits;

use LoLong\Invoice\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasInvoices
{
    /**
     * @return string
     */
    public function invoiceModel(): string
    {
        return config('invoice.model');
    }

    /**
     * @return mixed
     */
    public function invoices(): MorphMany
    {
        return $this->morphMany($this->invoiceModel(), 'invoicelog');
    }

    /**
     * @param $data
     * @param Model      $creator
     * @param Model|null $parent
     *
     * @return static
     */
    public function invoice($data, Model $creator, Model $parent = null)
    {
        $invoiceModel = $this->invoiceModel();

        $invoice = (new $invoiceModel())->createInvoice($this, $data, $creator);

        if (!empty($parent)) {
            $parent->appendNode($invoice);
        }

        return $invoice;
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateInvoice($id, $data)
    {
        $invoiceModel = $this->invoiceModel();

        $invoice = (new $invoiceModel())->updateInvoice($id, $data);

        return $invoice;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteInvoice($id): bool
    {
        $invoiceModel = $this->invoiceModel();

        return (bool) (new $invoiceModel())->deleteInvoice($id);
    }

    /**
     * @return mixed
     */
    public function invoiceCount(): int
    {
        return $this->invoices->count();
    }
}
