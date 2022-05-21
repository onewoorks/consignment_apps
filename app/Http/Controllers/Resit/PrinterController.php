<?php  

namespace App\Http\Controllers\Resit;
use App\Http\Controllers\Controller;

use App\Traits\Printer\BarcodeResit;

class PrinterController extends Controller{

    use BarcodeResit; 
    private $print_data = array();

    public function __construct(){

    }

    private function ownerHeader($resit_id){
        $data[] = $this->text("");
        $data[] = $this->text("2WENTY TWO GLOBAL SERVICES",1,1,1);
        $data[] = $this->text(["+6017802422","Receipt #$resit_id"]);
        $this->print_data = $data;
    }

    private function footer($kepada_kedai, $bank_name, $bank_acct_name, $account_bank, $staff){
        $data = $this->print_data;
        $data[] = $this->line();
        $data[] = $this->text($kepada_kedai);
        $data[] = $this->line();
        $data[] = $this->text($bank_name,0,1);
        $data[] = $this->text($bank_acct_name,0,1);
        $data[] = $this->text($account_bank,0,1);
        $data[] = $this->text("");
        $data[] = $this->text($staff,0,1);
        $data[] = $this->text(date('j F Y h:i'),0,1);
        $data[] = $this->text("");
        return $data;
    }

    public function getSales($resit_id){
        $data = array();
        $this->ownerHeader($resit_id);
        $data = $this->print_data;

        $data[] = $this->text(' ');

        $sales_data = $this->mockSalesData();
        
        $data[] = $this->text($sales_data['total_items'].' items (Qty '. $sales_data['quantity'].')');
        $data[] = $this->line();
        foreach($sales_data['items'] as $sale){
            $data[] = $this->text($sale);
        }
        $data[] = $this->line();
        $data[] = $this->text('Total : ' . $sales_data['total_price'],1);
        $data[] = $this->text('Payment method : ');
        $data[] = $this->text($sales_data['payment_method'].': '.$sales_data['total_price']);

        $this->print_data = $data;
        $data = $this->footer('MUTIARA RUNCIT', 'MAYBANK', '2WENTY TWO GLOBAL SERVICES', '563046342234', '0178002422 (ASYRAF)');
        
        $info['resit_data'] = json_encode($data,JSON_FORCE_OBJECT);
        return view('mob.resit.jualan', $info);
    }

    private function mockSalesData(){
        $items =  array(
                ['3 x Akso Ice Grape','40.50'],
                ['1 UN x 13.50'],
                ['2 x Akso Ice Watermelon', '27.00'],
                ['1 UN x 13.50'],
                ['3 x Akso Mango Smoothie', '40.50'],
                ['1 UN x 13.50'],
                ['1 x Akso Fizzy Cola', '13.50'],
                ['1 UN x 13.50'],
                ['3 x Akso Strawberry Milkshake', '40.50'],
                ['1 UN x 13.50'],
                ['1 x Akso Ice Lychee','13.50'],
                ['1 UN x 13.50'],
                ['3 x NastyFix Passion Fruit', '54.00'],
                ['1 UN x 18.00'],
                ['3 x NastyFix RootBeer','36.00'],
                ['1 UN x 18.00'],
                ['3 x NastyFix Blackurant', '54.00'],
                ['1 UN x 18.00'],
                ['3 x NastyFix Ice Peach','54.00'],
                ['1 UN x 18.00'],
                ['2 x NastyFix Bubblegum','36.00'],
                ['1 UN x 18.00'],
                ['1 x NastyFix Pineapple Lemonade','18.00'],
                ['1 UN x 18.00']
        );
        $total_items = 0;
        $quantity = 0;
        $total_price = 0;
        foreach($items as $item){
            if(count($item)>1){
                $total_items++;
                $q = explode(" ",$item[0]);
                $quantity += $q[0];
                $total_price += $item[1];
            }
        }
        return array(
            'total_items' => $total_items,
            'items' => $items,
            'quantity' => $quantity,
            'total_price' => number_format($total_price,2),
            'payment_method' => 'Cash'
        );
    }

}