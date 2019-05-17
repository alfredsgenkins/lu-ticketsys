<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Order;
use App\Ticket;
use App\TicketOrder;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $total = 0.0;
        $display_result = array();

        $current_cart = $request->session()->get('cart', array());

        if (!count($current_cart)) {
            return redirect('cart');
        }

        foreach ($current_cart as $id => $count)
        {
            if ($count > 0)
            {
                $ticket = Ticket::findOrFail($id);
                $total += $ticket->price;
                $display_result[] = $ticket;
            }
        }

        return view('order_create', array('total' => $total, 'tickets' => $display_result));
    }

    public function listOrders() {
        if (!Auth::check()) {
            return redirect('login');
        }

        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->orderBy('created_at', 'asc')->get();

        return view('orders', array('orders' => $orders));
    }

    public function showOrder(Request $request, $id) {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            return redirect('login');
        }

        $order->tickets = TicketOrder::where('order_id', $order->id)->get();
        return view('order_show', array('order' => $order));
    }

    public function placeOrder(Request $request)
    {
        $current_cart = $request->session()->get('cart', array());

        $address = Input::get('address');
        $phone = Input::get('phone');

        if (!Auth::check()) {
            return redirect('login');
        }

        if (!$address || !$phone) {
            return redirect('order');
        }

        $order = new Order;
        $order->user_id = Auth::id();
        $order->address = $address;
        $order->phone = $phone;
        $order->save();

        foreach ($current_cart as $id => $count) {
            if ($count > 0) {
                $ticket = Ticket::findOrFail($id);

                $ticketOrder = new TicketOrder;
                $ticketOrder->ticket_id = $ticket->id;
                $ticketOrder->order_id = $order->id;
                $ticketOrder->save();
            }
        }

        $request->session()->remove('cart');
        return redirect('orders');
    }
}
