<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
           return $this->accountService->listToDatatable();
        }

        return view('account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Account();
        return view('account.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $data = $request->except('_token');

        if(!$account = $this->accountService->create($data)) {
            return redirect()->route('account.index')->with('error', $this->accountService->message());
        }

        return redirect()->route('account.show', $account)->with('success', $this->accountService->message());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$account = $this->accountService->find($id)) {
            return redirect()->route('account.index')->with('error', $this->accountService->message());
        }

        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$account = $this->accountService->find($id)) {
            return redirect()->route('account.index')->with('error', $this->accountService->message());
        }


        return view('account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {

        if(!$account = $this->accountService->find($id)) {
            return redirect()->route('account.index')->with('error', $this->accountService->message());
        }

        $data = $request->except(['_token', '_method']);
        
        $this->accountService->update($account, $data);

        return redirect()->route('account.show', $account)->with('success', $this->accountService->message());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$account = $this->accountService->find($id)) {
            return redirect()->route('account.index')->with('error', $this->accountService->message());
        }

        $this->accountService->delete($account);

        return redirect()->route('account.index')->with('success', $this->accountService->message());
    }
}
