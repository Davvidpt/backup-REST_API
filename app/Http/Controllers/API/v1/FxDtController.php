<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterArea;
use App\Models\MasterCust;
use App\Models\CustTrans;
use App\Models\LogTrans;
use App\Models\LogTransline;
use App\Models\AbsenTrans;
use App\Models\MasterItem;
use App\Models\MasterRepresentative;
use App\Models\CustTransline;
use App\Models\OrderTrans;
use Illuminate\Support\Facades\DB;

class FxDtController extends Controller
{
    //
    public function MasterArea(){
        return response()->json([
            MasterArea::all()
        ]);
    }

    public function MasterCust(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        if($startDate && $endDate){
            $data = MasterCust::whereBetween(\DB::raw('CAST(modifydate AS DATE)'), [$startDate, $endDate])->get();
        }
        else {
            $data = MasterCust::orderBy('modifydate','desc')->take(1000)->get(); // Ambil 1000 per halaman
        }
        return response()->json($data);
    }   


    public function CustTrans(Request $request){
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        
        if ($startDate && $endDate){
             $data = CustTrans::whereBetween(\DB::raw('CAST(modifydate AS DATE)'), [$startDate, $endDate])->get();
        }else{
             $data = CustTrans::orderBy('modifydate','desc')->take(1000)->get();
        }
        return response()->json(
           $data
        );        
    }


    public function LogTrans(Request $request){
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        
        if($startDate && $endDate){
            $data = LogTrans::whereBetween(\DB::raw('CAST(modifydate AS DATE)'), [$startDate, $endDate])->get();    
        }else{
            $data = LogTrans::orderBy('modifydate','desc')->take(1000)->get();
        }
        return response()->json(
            $data
            ); 
    }


    public function CustTransline(Request $request)
    {
        $startDate = $request->query("startDate");
        $endDate = $request->query("endDate");
        
        if($startDate && $endDate){
            $data = CustTransline::whereBetween(\DB::raw('CAST(modifydate AS DATE)'), [$startDate,$endDate])->get();
        }else{
            $data = CustTransline::orderBy('modifydate','desc')->take(1000)->get();
        }
        return response()->json(
             $data
        );
    }


    public function MasterRepresentative(){
        return response()->json([
            MasterRepresentative::select('representativeid','representativecode','parentrepresentativeid','representativetree',	'name',	'address1',	'address2',	'city',	'phone',	'receivablelimit',	'blocked',	'status',	'costcenterid',	'freedescription1',	'freedescription3',	'createby',	'createdate',	'createat',	'modifyby',	'modifydate',	'modifyat',	'modifystatus',	'syncflag',	'synccomm',	'syncby',	'syncfrom',	'syncdate',)->get()
        ]);
    }


    public function MasterItem(){
        return response()->json([
            MasterItem::select('itemid',	'itemcode',	'blocked',	'allowsales',	'allowpurch',	'allowtrans',	'allowused',	'allowprod',	'itemcategoryid',	'itemtypeid',	'itemgroupid',	'subitemgroupid',	'parentitemgroupid',	'parentitemid',	'pajakid',	'description',	'uomid',	'purchuomid',	'gllinksalesid',	'gllinkstockid',	'gllinkhppid',	'custid',	'suplid',	'averagecost',	'standardcost',	'salesuomid',	'costtype',	'representativeid',	'aliascode',	'mfgcode',	'maxitemuomid',	'maxconversionqty',	'reportuomid',	'purchorderqty',	'salesorderqty',	'expireperiod',	'internalstatus',	'brandid',	'gllinksalestaxid',	'gllinkpurchtaxid',	'createby',	'createdate',	'createat',	'modifyby',	'modifydate',	'modifyat',	'modifystatus',	'pajakuomid',)->get()
        ]);
    }


    public function AbsenTrans()
    {
        $data = AbsenTrans::select(
        'absentransid',
        'absentransentryno',
        'entrydate',
        'staffid',
        'status',
        'shift',
        'shour',
        'sminute',
        'ssec',
        'data',
        'machinecode',
        'rawdata3',
        'createby',
        'createdate',
        'modifyby',
        'modifydate' )
        ->get();

        return response()->json([
        'success' => true,
        'data' => $data
    ]);
}

    
    public function PelunasanPiutang(Request $request){
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        $data = DB::connection('sqlsrv')
            ->table('JBE2307.dbo.logtrans as plt')
            ->join('JBE2307.dbo.logtransline as pltl', function ($join) {
                $join->on('plt.logtransid', '=', 'pltl.logtransid')
                     ->where('pltl.logtranslinetype', '=', 1);
            })
            ->join('JBE2307.dbo.mastercust as mcust', 'plt.custid', '=', 'mcust.custid')
            ->join('JBE2307.dbo.custtransline as pctl', 'plt.logtransentryno', '=', 'pctl.logtransentryno')
            ->leftJoin(DB::raw("(
                SELECT ltinv.logtransentrytext, ctinv.custtransid, ot.ordertransentrytext, ctinvl.totalvalue
                FROM JBE2307.dbo.logtrans ltinv WITH (readpast)
                INNER JOIN JBE2307.dbo.cu ttrans ctinv WITH (readpast) ON ctinv.logtransentryno = ltinv.logtransentryno
                INNER JOIN JBE2307.dbo.custtransline ctinvl WITH (readpast) ON ctinvl.logtransentryno = ltinv.logtransentryno
                INNER JOIN JBE2307.dbo.ordertrans ot ON ot.ordertransentryno = ltinv.ordertransentryno AND ot.transtypeid = 15
            ) as dinv"), 'dinv.custtransid', '=', 'pctl.custtransid')
            ->select(
                'plt.logtransentrytext as no_pelunasan',
                'plt.entrydate as tgl_pelunasan',
                'plt.reference1 as Keterangan',
                'mcust.custcode as Kode',
                'mcust.name as CustName',
                'dinv.logtransentrytext as NoInv',
                'dinv.ordertransentrytext as noso',
                'dinv.totalvalue as NilaiPelunasan'
            )
            ->where('plt.transtypeid', 71)
            ->where('plt.status', 'P')
            ->whereNotNull('pctl.logtranslineentryno')
            ->whereBetween('plt.entrydate', [$startDate, $endDate])
            ->orderBy('plt.entrydate')
            ->orderBy('plt.logtransentrytext')
            ->get();

        return response()->json($data);
    }




 //filter by linemodifydate
    public function LogTransline(Request $request){
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        
        if($startDate && $endDate){
            $data = LogTransline::whereBetween(\DB::raw('CAST(linemodifydate AS DATE)'), [$startDate, $endDate])->get();
        }else{
            $data = LogTransline::orderBy('linemodifydate','desc')->take(1000)->get();
        }
        return response()->json(
            $data
        );
    }



//filter by entrydate
    public function OrderTrans(Request $request){
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        if($startDate && $endDate){
            $data = OrderTrans::whereBetween(\DB::raw('CAST(modifydate AS DATE)'), [$startDate, $endDate])->get();
        }else{
            $data = OrderTrans::orderBy('modifydate','desc')->take(1000)->get();
        }
        return response()->json(
            $data
        );
    }

    



}