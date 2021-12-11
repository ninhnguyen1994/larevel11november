<?php
 
namespace App\Libraries;

use Illuminate\View\View;
use  App\Products;

class ProductHotComposer
{
    /**
     * bind data to the view.
     * bind data in view. $view-> with('ten_key_se_dung_trong_view',$data);
     * @param view $view
     * @return void
     */

     public function compose(View $view) {
         $productHot = Products::with('images')->where('status_hight_light',1)->get();
         
         $view->with('productHots',$productHot);
     }
}
