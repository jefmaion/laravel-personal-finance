<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Services\AccountService;
use App\Services\CategoryService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    private $transactionService;
    private $categoryService;
    private $paymentService;
    private $accountService;
    

    public function __construct(
        TransactionService $transactionService, 
        CategoryService $categoryService,
        PaymentService $paymentService,
        AccountService $accountService
    )
    {
        $this->transactionService = $transactionService;
        $this->categoryService    = $categoryService;
        $this->paymentService     = $paymentService;
        $this->accountService     = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dateFrom = $request->get('from') ?? date('Y-m-01');
        $dateTo   = $request->get('to') ?? date('Y-m-t');

        if($request->ajax()){
           return $this->transactionService->listToDatatable($dateFrom, $dateTo);
        }

        $expenses = $this->transactionService->sumExpenses();
        $incomes = $this->transactionService->sumIncomes();

        

        return view('transaction.index', compact('expenses', 'incomes', 'dateFrom', 'dateTo'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction =  new Transaction();
        $transaction->date = date('Y-m-d');
        $categories = $this->categoryService->listParents();
        $payments = $this->paymentService->toSelectBox();
        $accounts = $this->accountService->toSelectBox();
        return view('transaction.create', compact('transaction', 'categories', 'payments', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->except(['_method', '_token']);

        if(!$this->transactionService->create($data)) {
            return redirect()->route('transaction.index')->with('error', $this->transactionService->message());
        }

        return redirect()->route('transaction.index')->with('success', $this->transactionService->message() .  ' (<a href="'.route('transaction.create').'">Adicionar Outro</a>)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$transaction = $this->transactionService->find($id)) {
            return redirect()->route('transaction.index')->with('error', $this->transactionService->message());
        }


        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$transaction = $this->transactionService->find($id)) {
            return redirect()->route('transaction.index')->with('error', $this->transactionService->message());
        }

        $categories = $this->categoryService->listParents();
        $payments = $this->paymentService->toSelectBox();
        $accounts = $this->accountService->toSelectBox();
        return view('transaction.edit', compact('transaction', 'categories', 'payments', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, $id)
    {
        if(!$transaction = $this->transactionService->find($id)) {
            return redirect()->route('transaction.index')->with('error', $this->transactionService->message());
        }

        $data = $request->except(['_token', '_method']);
        
        $this->transactionService->update($transaction, $data);

        return redirect()->route('transaction.show', $transaction)->with('success', $this->transactionService->message());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$transaction = $this->transactionService->find($id)) {
            return redirect()->route('transaction.index')->with('error', $this->transactionService->message());
        }

        $this->transactionService->delete($transaction);

        return redirect()->route('transaction.index')->with('success', $this->transactionService->message());
    }

    public function pay(Request $request, $isPaid) {

        $this->transactionService->changePaid($request->get('transactions'), $isPaid);
        return redirect()->route('transaction.index')->with('success', $this->transactionService->message());
    }

    public function deleteAll(Request $request) {
        $this->transactionService->deleteBatch($request->get('transactions'));
        return redirect()->route('transaction.index')->with('success', $this->transactionService->message());
    }

    public function description(Request $request) {

        return $this->transactionService->listDescriptions($request->get('query'));
    }

    public function import(Request $request) {

        if($request->isMethod('get')) {
            return view('transaction.import');
        }

        $name = $request->file('report')->getClientOriginalName();
        $request->file('report')->move(public_path('upload'), $name);

        
        if (!$xlsx = \Shuchkin\SimpleXLS::parse(public_path('upload') . '\\' . $name)) {
            return;
        } 

        $rows = $xlsx->rows();
        $data = [];

        $i = 6;
        $row = trim($rows[$i][1]);
        while($row !== 'SALDO ANTERIOR') {
            $item = $rows[$i];

            $payment_id = null;

            if(strpos($item[1], 'COMPRA CARTAO DEB') !== false) {
                $payment_id = 2;
            }

            if(strpos($item[1], 'IOF ') !== false) {
                $payment_id = 2;
            }

            if(strpos($item[1], 'REMUNERACAO APLICACAO AUTOMATICA') !== false) {
                $payment_id = 3;
            }

            if(strpos($item[1], 'AUT. FAT.CARTAO') !== false) {
                $payment_id = 2;
            }

            if(strpos($item[1], 'PIX ENVIADO') !== false) {
                $payment_id = 1;
            }

            if(strpos($item[1], 'TED CONTA SALARIO') !== false) {
                $payment_id = 3;
            }

            $date = explode("/", $item[0]);

            $data[] = [
                'date'        => date('Y-m-d', strtotime($date[1] . '/' . $date[0] . '/' . $date[2])),
                'description' => ucwords(strtolower(trim($item[1]))),
                'value'       => (empty($item[4])) ? currency($item[5], true) * -1 : currency($item[4], true),
                'type'        => (empty($item[4])) ? 'D' : 'R',
                'payment_id'  => $payment_id
            ];

            $row = trim($item[1]);
            $i++;
        }



        $categories = $this->categoryService->listParents();
        $payments = $this->paymentService->toSelectBox();
        $accounts = $this->accountService->toSelectBox();

        return view('transaction.import', compact('data', 'categories', 'payments', 'accounts'));

    }

    public function importSave(Request $request) {
        $data = $request->get('import');

        $this->transactionService->import($data);
        return redirect()->route('transaction.index')->with('success', $this->transactionService->message());
    }
}
