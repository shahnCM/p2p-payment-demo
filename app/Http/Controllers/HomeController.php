<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTransferObjects\TestDto;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionReportService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test (TransactionRequest $request, TransactionReportService $trs)
    {
//        $testDto = TestDto::instance()->dirtyDto([
//            'car' => 'Mazda',
//            'bike' => 'Indian',
//            'ship' => null,
//        ]);
//
//        dd($testDto);

        dump($request);

        dump($trs->thirdHighestAmountOfTransactionByUser(2));
        dump($trs->userWhoUsedMostConversion());
        dump($trs->userWhoUsedHighestConversion());
        dump($trs->totalAmountConvertedForParticularUser(2));

        dd('ok');
    }
}
