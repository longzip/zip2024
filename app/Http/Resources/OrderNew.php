<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Customer;
use App\User;
use App\Product;
use NoiThatZip\Contact\Models\Contact;

class OrderNew extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $customer = Customer::find($this->deliver_to);
        $id = 1;
        $user = User::find($this->user_id);
        if (isset($customer->phone)) {
            $id = Contact::where('phone',$customer->phone)->first('id');
            if (!empty($id->id)) {
                $id = $id->id;
            }
        }
        $amount = [$this->amount];
        $phone = isset($customer->phone) ? $customer->phone : '';
        $type =  Contact::where('phone',$phone)->orderBy('id','desc')->first();
        return [
            'amount' => number_format ($this->amount,0,'.','.'),
            'costcenter' => $this->costcenter,
            'created_at' => (string)$this->created_at,
            'credit' => $this->credit,
            'customer_id' => $this->customer_id,
            'customer_address' => isset($customer->address_line1) ? $customer->address_line1 : '',
            'customer_name' => isset($customer->name) ? $customer->name : '',
            'customer_phone' => $phone,
            'debit' => $this->debit,
            'sdt' => $this->sdt,
            'xeploai' => isset($type) ? $type['type'] : 0,
            'deleted_at' => $this->deleted_at,
            'deliver_to' => $this->deliver_to,
            'delivery_date' => $this->delivery_date,
            'start_date' => $this->start_date,
            'delivery_method' => $this->delivery_method,
            'description' => $this->description,
            'export' => $this->export,
            'fee_kh' => number_format ($this->fee_kh,0,'.','.'),
            'fee_ld' => number_format ($this->fee_ld,0,'.','.'),
            'fee_vc' => number_format ($this->fee_vc,0,'.','.'),
            'glaccount_id' => $this->glaccount_id,
            'id' => $this->id,
            'idContacts' => $id,
            'invoice_to' => $this->invoice_to,
            'journal_id' => $this->journal_id,
            'note' => $this->note,
            'ordered_by' => $this->ordered_by,
            'pre_pay' => number_format ($this->pre_pay,0,'.','.'),
            'qgg' => number_format ($this->qgg,0,'.','.'),
            'so_number' => $this->so_number,
            'status_id' => $this->status_id,
            'subtotal' => number_format ($this->subtotal,0,'.','.'),
            'thu' => number_format($this->amount - $this->pre_pay ,0,'.','.'),
            'type' => $this->type,
            'updated_at' => (string)$this->updated_at,
            'user_id' => $this->user_id,
            'user_name' => $user['name'],
            'vat' => $this->vat,
            'warehouse' => $this->warehouse,
            'your_ref' => $this->your_ref,
            'products'    => Product::select('id','code as name')->whereIn('id',$this->orderlines()->pluck('product_id'))->get(),
            'orderLine' => $this->orderlines,
            'test' => $amount,
            'status' => $this->status_order,
            
        ];
    }
}
