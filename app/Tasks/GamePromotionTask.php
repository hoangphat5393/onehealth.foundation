<?php

namespace App\Tasks;

use App\Constants\BaseConstants;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use InApps\IAModules\Helpers\LogHelper;

use App\Imports\GameImport;
use App\Models\ShopProduct;
use App\Models\ShopCategory;
use App\Models\ShopProductCategory;
use App\Models\ShopProductAttribute;
use App\Models\Attribute;
use App\Models\Game;
use App\Models\GameCategory;

class GamePromotionTask
{
    /**
     * @param $name
     * @return string
     */
    public function getData($url_excel)
    {
        try {
            $array = Excel::toArray(new GameImport, $url_excel);

            $k = 0;
            if (!empty($array[0])) {
                $offer_number = '';
                foreach ($array[0] as $item) {
                    // Log::debug("line $k");
                    $product = ShopProduct::where('sku', $item['offer_number'])->first();
                    if ($product) {
                        //xóa promotion của product khi gặp product sku đầu tiên, các sku cùng product tiếp theo sẽ ko bị xóa
                        if ($offer_number != $item['offer_number']) {
                            $offer_number = $item['offer_number'];
                            \App\Models\ShopProductPromotion::where('shop_product_id', $product->id)->delete();
                            Log::debug("Offer_number $offer_number");
                        }

                        if (!empty($item['promotion_quatity'])) {
                            $promotion_quatity = (int)$item['promotion_quatity'];

                            \App\Models\ShopProductPromotion::create([
                                "shop_product_id" => $product->id,
                                "qty_to_promotion" => $promotion_quatity,
                                "promotion" => $item['promotion_price'] ?? 0,
                                "promotion_unit" => $item['unit'] ?? '$'
                            ]);
                        }
                        $k++;
                    }
                }
                // unlink($url_excel);
                Log::debug('======================done game !=======================');
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
