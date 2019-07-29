<?php

namespace App\Model\Daily;

use App\TwijackModel\SettingModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillModel extends Model
{
    use SoftDeletes;

    protected $table = 'bill';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeId($query,$id){
        return $query->where('id',$id);
    }

    public function scopeType($query,$type){
        return $query->where('type',$type);
    }

    public function scopeDay($query,$day){
        $date = explode(' - ',$day);
        return $query->where('day','>=',$date[0])->where('day','<=',$date[1]);
    }

    public function scopeName($query,$name){
        return $query->where('consumeText','like','%'.$name.'%');
    }

    public function display($param,$m = 'list',$page = 10){
        $bill = self::orderBy('id','desc');

        if($param['t'] != 'all'){
            $bill->type($param['t']);
            if($param['p'] != 'all' && $param['t'] == 1){
                $bill->where('categoryP',$param['p']);
            }

            if($param['r'] != 'all' && $param['t'] == 2){
                $bill->where('categoryR',$param['r']);
            }
        }

        if($param['k']){
            $bill->name($param['k']);
        }

        if($m == 'sum'){
            if($param['t'] == 'all'){
                $bill->type(1);
            }
            $bill = $bill->sum('bucks');
        }else{
            $bill = $bill->paginate($page);
        }

        return $bill;
    }

    public function meSpentMoney($param){
        if(!@$param['id']){
            self::create([
                'bucks' => $param['bucks'],
                'consumeText' => $param['consumeText'],
                'categoryP' => $param['categoryP'],
                'categoryR' => $param['categoryR'],
                'type' => $param['type'],
                'day' => config('constants.day')
            ]);

            if($param['type'] == 1){
                SettingModel::UpdateMoney('money','- '.$param['bucks']);
            }else{
                SettingModel::UpdateMoney('money','+ '.$param['bucks']);
            }
        }else{
            self::id($param['id'])->update([
                'bucks' => $param['bucks'],
                'consumeText' => $param['consumeText'],
                'categoryP' => $param['categoryP'],
                'categoryR' => $param['categoryR'],
                'type' => $param['type'],
            ]);
        }
    }

    public function chart($date,$page = 10){
        $chart = self::day($date)
            ->type(1)
            ->groupBy('day')
            ->orderBy('day')
            ->selectRaw('sum(bucks) as bucks,day');

        $chartClone = clone $chart;

        $chartInfo['list'] = $chart->paginate($page);
        $chartInfo['chart'] = $chartClone->get()->toArray();

        $chartInfo['sum'] = self::day($date)->type(1)->sum('bucks');

        return $chartInfo;
    }
}
