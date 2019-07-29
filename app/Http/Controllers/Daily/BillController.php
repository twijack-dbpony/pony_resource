<?php

namespace App\Http\Controllers\Daily;

use App\Http\Requests\BillRequest as BR;
use Illuminate\Http\Request as R;
use App\Http\Controllers\Controller;
use App\Model\Daily\BillModel as B;
use Illuminate\Support\Arr;

class BillController extends Controller
{
    public function display(R $re,B $b){
        $type = $re->input('type','all');
        $categoryP = $re->input('categoryP','all');
        $categoryR = $re->input('categoryR','all');
        $keyword = $re->input('keyword');

        $param = [
            't' => $type,
            'p' => $categoryP,
            'r' => $categoryR,
            'k' => $keyword
        ];

        $bill = $b->display($param);
        $sum = $b->display($param,'sum');

        return view('daily.bill.display',[
            'bill' => $bill,
            'sum' => $sum,
            'type' => $type,
            'categoryP' => $categoryP,
            'categoryR' => $categoryR,
            'keyword' => $keyword
        ]);
    }

    public function operation(B $b,$id = false){
        if($id){
            $bill = $b::find($id);
            $attachment = ['bill' => $bill,'id' => $id];
        }else{
            $attachment = [];
        }

        return view('daily.bill.operation',$attachment);
    }

    public function postOperation(BR $re,B $b){
        $re->validated();

        $b->meSpentMoney($re->all());
        return redirect()->route('d_psd')->with('postscript','nicely done!');
    }

    public function chart(R $re,B $b){
        $date = $re->input('date') ? : config('constants.day').' - '.config('constants.day');
        $chart = $b->chart($date);

        if(@$chart['chart']){
            $HighChart['day'] = implode(',',Arr::pluck($chart['chart'],'day'));
            $HighChart['bucks'] = implode(',',Arr::pluck($chart['chart'],'bucks'));
        }

        return view('daily.bill.chart',[
            'date' => $date,
            'chart' => $chart,
            'hc' => @$HighChart
        ]);
    }

    public function chartChild($date,B $b){
        $bill = $b::where('day',$date)->type(1)->orderBy('created_at')->get();
        return view('daily.bill.child',['bill' => $bill]);
    }
}
