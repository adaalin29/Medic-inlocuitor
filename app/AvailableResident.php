<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class AvailableResident extends Model{
  
    public function scopeAvailable($query){
//       DB::connection()->enableQueryLog();
// //       dd($query);
//       $query -> whereDate('start_date','<=', '2020-05-28')->whereDate('end_date','>=', '2020-05-31')->get();
//       dd(DB::getQueryLog());
//       return $query->where('id', 2);
      if(request()->has('id')){
        
        $vacations = DB::table('vacations')->where('id',request()->id)->first();
        $query->whereDate('start_date','<=', $vacations->start_date)->whereDate('end_date','>=', $vacations->end_date);
      }
        return $query;
    }
}
