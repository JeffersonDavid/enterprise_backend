<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrdersComponent extends Component
{

    protected \App\Models\MailNotifications $mailNotification;

    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( \App\Models\MailNotifications $mailNotification )
    {
        
        $this->mailNotification = $mailNotification;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $order = $this->mailNotification->customer_transaction_data->order;
        $product = \App\Models\Product::where('product_type', $order->product_type)->first();

        $data = [
            'order_id' => $order->order_id,
            'customer_name' => $this->mailNotification->customer_data->name,
            'quantity' => $order->quantity,
            'price' => $product->product_price,
            'total'=> (int) $order->quantity * (int) $product->product_price,
            'product_name' => $product->product_name,
            'message' =>  'Hola '.  $this->mailNotification->customer_data->name . ", tu pedido ha sido notificado correctamente. Nos pondremos en contacto contigo al numero ".$this->mailNotification->customer_data->phone." antes de un plazo de 24 horas para formalizar la compra."
        ];
    
        //logger()->info('testing orddr relation');
        logger()->info(json_encode($data));

        return view('components.orders-component', $data );
    }
}
