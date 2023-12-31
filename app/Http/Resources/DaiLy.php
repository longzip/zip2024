<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Product;
use App\Customer;
use App\Company;
use App\ActivityLogs;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use NoiThatZip\SalesArea\Models\SalesArea;
use NoiThatZip\Quote\Http\Resources\Quoteda as QuoteResource;
use NoiThatZip\Task\Http\Resources\Task as TaskResource;
use NoiThatZip\Video\Http\Resources\Video as VideoResource;
use NoiThatZip\Attachment\Http\Resources\Attachment as AttachmentResource;

class DaiLy extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       	return [
            'id' => $this->id,
            'title'      => $this->title,
            'last_name'  => $this->last_name,
            'name'  => $this->name,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'dientich'    => $this->dientich,
            'address'    => $this->address,
            'city'       => $this->city,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'duyet' => $this->duyet,
            'status'     => (integer)$this->status,
            'costcenters' => $this->costcentersList(),
            'products'    => Product::select('id','code as name')->whereIn('id',$this->productLines()->pluck('product_id'))->get(),
            'user_id'    => $this->user_id,
            'username'   => User::find($this->user_id)->name,
            'amount'     =>  $this->quotes->max('total'),
            'comments'   =>  $this->comments,
            'tasks'      =>  TaskResource::collection($this->tasks),
            'quotes'     =>  QuoteResource::collection($this->quotes),
            'medias'     =>  $this->getMedia(),
            'videos'     =>  VideoResource::collection($this->videos),
            'attachs'     =>  AttachmentResource::collection($this->attachs),
            'kh15s'      =>  $this->kh15s,
            'losts'      =>  $this->losts,
            'note'      =>  $this->note,
            'type'      =>  $this->type,
            'isPublished' => $this->isPublished(),
            // 'orders'    => $orders,
            'isUnread'    => $this->thread_id,
            'created_at' => (string)$this->created_at,
        ];
    }
}
