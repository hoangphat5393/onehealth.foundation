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

class GameTask
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
                foreach ($array[0] as $item) {
                    // dd($item);
                    /*Log::debug($item);
                    break;*/
                    Log::debug('Count process on row: ' . $k);

                    $status = $item['status'] ?? '';
                    $min_quantity = $item['min_unit_per_order'] ?? 1;
                    $shop_item = ShopProduct::updateOrCreate(
                        [
                            'sku'   => $item['offer_number'] ?? '',
                        ],
                        [
                            'name'   => $item['title'],
                            'slug' => Str::slug($item['title']),
                            'currency'   => $item['currency'] ?? '',
                            'price'   => $item['price'] ?? 0,
                            'min_quantity'   => $min_quantity,
                            'delivery_method'   => $item['delivery_option'] ?? '',
                            'description'   => $item['description'] ?? '',
                            'status'   => $status == 'Active' ? 1 : 0,
                            'stock'   => $item['stock'] ?? 0,
                            'sort'   => date('dmy'),
                            'image'   => $item['image'] ?? '',
                        ]
                    );

                    // Attribute Server
                    $server_value = $item['server'] ?? '';
                    if ($server_value != '') {
                        $attr_server = Attribute::where('slug', 'server')->first();
                        if ($attr_server) {
                            $attr_server_child = Attribute::firstOrCreate(
                                ['attribute_name' =>  $server_value],
                                [
                                    'slug' => Str::slug($server_value),
                                    'parent' => $attr_server->id,
                                    'status' => 1
                                ]
                            );
                            ShopProductAttribute::firstOrCreate([
                                "attribute_id" => $attr_server_child->id,
                                "shop_product_id" => $shop_item->id,
                            ]);
                        }
                    }

                    // Attribute Rank
                    $rank_value = $item['rank'] ?? '';
                    if ($rank_value != '') {
                        $attr_rank = Attribute::firstOrCreate(
                            ['attribute_name' =>  'Rank'],
                            [
                                'slug' => Str::slug('Rank'),
                                'status' => 1
                            ]
                        );
                        if ($attr_rank) {
                            $attr_rank_child = Attribute::firstOrCreate(
                                ['attribute_name' =>  $rank_value],
                                [
                                    'slug' => Str::slug($rank_value),
                                    'parent' => $attr_rank->id,
                                    'status' => 1
                                ]
                            );
                            ShopProductAttribute::firstOrCreate([
                                "attribute_id" => $attr_rank_child->id,
                                "shop_product_id" => $shop_item->id,
                            ]);
                        }
                    }
                    // Attribute region
                    $region_value = $item['region'] ?? '';
                    if ($region_value != '') {
                        $attr_region = Attribute::firstOrCreate(
                            ['attribute_name' =>  'Region'],
                            [
                                'slug' => Str::slug('Region'),
                                'status' => 1
                            ]
                        );
                        if ($attr_region) {
                            $attr_region_child = Attribute::firstOrCreate(
                                ['attribute_name' =>  $region_value],
                                [
                                    'slug' => Str::slug($region_value),
                                    'parent' => $attr_region->id,
                                    'status' => 1
                                ]
                            );
                            ShopProductAttribute::firstOrCreate([
                                "attribute_id" => $attr_region_child->id,
                                "shop_product_id" => $shop_item->id,
                            ]);
                        }
                    }


                    // Attribute item type
                    $item_type = $item['item_type'] ?? '';
                    if ($item_type != '') {
                        $item_types = explode('>', $item_type);
                        $item_type_parent = 0;
                        foreach ($item_types as $item_type_attr) {
                            $attr_item_type = Attribute::firstOrCreate(
                                ['attribute_name' =>  $item_type_attr],
                                [
                                    'slug' => Str::slug($item_type_attr),
                                    'parent' => $item_type_parent,
                                    'status' => 1
                                ]
                            );
                            $item_type_parent = $attr_item_type->id;
                            ShopProductAttribute::firstOrCreate([
                                "attribute_id" => $attr_item_type->id,
                                "shop_product_id" => $shop_item->id,
                            ]);
                        }
                    }

                    $category_list = $item['category'] ?? '';
                    // dd($item);
                    if ($category_list != '') {
                        $categories = explode('-', $category_list);

                        ShopProductCategory::where('product_id', $shop_item->id)->delete();

                        if (!empty($categories[0]) && !empty($categories[1])) {
                            $shop_category = ShopCategory::firstOrCreate(
                                ['name' => trim($categories[0])],
                                ['slug' => Str::slug($categories[0]), 'status' => 1]
                            );
                            $game = Game::firstOrCreate(
                                ['name' => trim($categories[1])],
                                ['slug' => Str::slug($categories[1]), 'status' => 1]
                            );

                            GameCategory::firstOrCreate([
                                "game_id" => $game->id,
                                "category_id" => $shop_category->id,
                            ]);
                            $datas_item = [
                                "category_id" => $shop_category->id,
                                "product_id" => $shop_item->id,
                                "game_id" => $game->id
                            ];
                            // dd($datas_item);
                            \App\Models\ShopProductCategory::create($datas_item);
                        }
                    }

                    $k++;
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
