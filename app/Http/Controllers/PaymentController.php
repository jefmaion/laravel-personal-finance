<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
           return $this->paymentService->listToDatatable();
        }

        return view('payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = new Payment();
        return view('payment.create', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->except('_token');

        if(!$payment = $this->paymentService->create($data)) {
            return redirect()->route('payment.index')->with('error', $this->paymentService->message());
        }

        return redirect()->route('payment.show', $payment)->with('success', $this->paymentService->message() . ' (<a href="'.route('payment.create').'">Adicionar Outro</a>)');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$payment = $this->paymentService->find($id)) {
            return redirect()->route('payment.index')->with('error', $this->paymentService->message());
        }

        return view('payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$payment = $this->paymentService->find($id)) {
            return redirect()->route('payment.index')->with('error', $this->paymentService->message());
        }


        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePaymentRequest $request, $id)
    {

        if(!$payment = $this->paymentService->find($id)) {
            return redirect()->route('payment.index')->with('error', $this->paymentService->message());
        }

        $data = $request->except(['_token', '_method']);
        
        $this->paymentService->update($payment, $data);

        return redirect()->route('payment.show', $payment)->with('success', $this->paymentService->message());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$payment = $this->paymentService->find($id)) {
            return redirect()->route('payment.index')->with('error', $this->paymentService->message());
        }

        $this->paymentService->delete($payment);

        return redirect()->route('payment.index')->with('success', $this->paymentService->message());
    }
}
