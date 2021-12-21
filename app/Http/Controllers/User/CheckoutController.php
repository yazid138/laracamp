<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Checkout\Store;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Checkout;
use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Midtrans\Snap;
use Midtrans\Config;
use Exception;

class CheckoutController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Camp $camp, Request $request)
    {
        if ($camp->isRegistered) {
            $request->session()->flash('error', "You already registered on {$camp->title} camp.");
            return redirect(route('user.dashboard'));
        }
        return view('checkout.create', ['camp' => $camp]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, Camp $camp)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['camp_id'] = $camp->id;

        $user = $request->user();
        // $user->name = $validated['name'];
        // $user->email = $validated['email'];
        // $user->occupation = 'tes';
        $user->occupation = $data['occupation'];
        $user->save();

        $checkout = Checkout::create($data);
        $this->getSnapRedirect($checkout);

        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect(route('checkout.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function success()
    {
        return view('checkout.success');
    }

    /**
     * Midtrans Handler
     * @param \App\Models\Checkout $checkout
     */
    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId = $checkout->id . '-' . Str::random(5);
        $price = $checkout->Camp->price * 1000;
        $checkout->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price
        ];

        $items_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$checkout->Camp->title} Camp"
        ];

        $user_data = [
            'first_name' => $checkout->User->name,
            'last_name' => '',
            'address' => $checkout->User->address,
            'city' => '',
            'postal_code' => '',
            'phone' => $checkout->User->phone,
            'country_code' => 'IDN',
        ];

        $customer_details = [
            'first_name' => $checkout->User->name,
            'last_name' => '',
            'email' => $checkout->User->email,
            'phone' => $checkout->User->phone,
            'billing_address' => $user_data,
            'shipping_address' => $user_data,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'items_details' => $items_details
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $error) {
            return false;
        }
    }
}
