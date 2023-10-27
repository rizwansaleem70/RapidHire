<?php

namespace App\Traits;

use App\Models\Deal;
use PDF;
use PHPUnit\Framework\MockObject\BadMethodCallException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait General{

    public function scopeLike($query,$column,$value){
        return $query->where($column,'LIKE','%'.$value.'%');
    }

    public function generatePdf()
    {
        if (!$this instanceof Deal){
            throw new BadMethodCallException("generate pdf call for only Deal Model");
        }

        $deal = Deal::whereId($this->id)->with('status','category','token','transactionType','property.property_category','property.type','property.extraLand','agent.status','client.status','possessionStatus','paymentCategory','payments.paymentType')->first();

        // if (!is_null($deal->pdf_path)){
        //     return $deal->pdf_path;
        // }

        if (env('APP_ENV') == "local"){
            $qrcode = "";
        }else{
            $qrcode= QrCode::format('png')->generate(route('deal.show',$deal->system_number));
        }

        $filepath = 'deal_pdf/'.$deal->system_number.'.pdf';
        $pdf = PDF::loadView('pdf',compact('deal','qrcode'))->save(storage_path('app/public/').$filepath);
        $this->pdf_path = $filepath;
        $this->save();

        return $pdf->stream($filepath);
    }
}
