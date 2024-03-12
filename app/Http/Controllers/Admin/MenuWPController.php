<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use App\Models\MenuItems;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MenuWPController extends Controller
{
    public function createnewmenu()
    {
        $menu = new Menus();
        $menu->name = request()->input("menuname");
        $menu->save();
        return response()->json(array("resp" => $menu->id));
        // return json_encode(array("resp" => $menu->id));
    }

    public function deleteitemmenu()
    {
        $menuitem = MenuItems::find(request()->input("id"));
        $menuitem->delete();
    }

    public function deletemenug()
    {
        $menus = new MenuItems;
        $getall = $menus->getall(request()->input("id"));
        if (count($getall) == 0) {
            $menudelete = Menus::find(request()->input("id"));
            $menudelete->delete();
            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));
        }
    }

    // Update menu
    public function updateitem()
    {
        $arraydata = request()->input("arraydata");

        // dd($arraydata);
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $menuitem = MenuItems::find($value['id']);
                $menuitem->label = $value['label'] ?? '';
                $menuitem->image = $value['image'];
                $menuitem->slug = $value['slug'] ?? '';
                $menuitem->link = $value['link'] ?? '';
                $menuitem->class = $value['class'] ?? '';
                // if (config('menu.use_roles')) {
                //     $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0;
                // }
                $menuitem->save();
            }
        } else {
            $menuitem = MenuItems::find(request()->input("id"));
            $menuitem->label = request()->input("label");
            $menuitem->image = request()->input("image");
            $menuitem->slug = request()->input("slug");
            $menuitem->link = request()->input("url");
            $menuitem->class = request()->input("clases");
            // if (config('menu.use_roles')) {
            //     $menuitem->role_id = request()->input("role_id") ? request()->input("role_id") : 0;
            // }
            $menuitem->save();
        }
    }

    // Add custom link
    public function addcustommenu()
    {
        $menuitem = new MenuItems;
        $menuitem->label = request()->input("labelmenu");
        $menuitem->slug = request()->input("slug");
        $menuitem->link = request()->input("linkmenu");

        // if (config('menu.use_roles')) {
        //     $menuitem->role_id = request()->input("rolemenu") ? request()->input("rolemenu")  : 0;
        // }
        $menuitem->menu = request()->input("idmenu");
        $menuitem->sort = MenuItems::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();
    }

    public function generatemenucontrol()
    {
        $menu = Menus::find(request()->input("idmenu"));
        $menu->name = request()->input("menuname");

        $menu->save();
        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {
                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                // if (config('menu.use_roles')) {
                //     $menuitem->role_id = request()->input("role_id");
                // }
                $menuitem->save();
            }
        }
        echo json_encode(array("resp" => 1));
    }
}
