<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Category;
use App\Item;
use App\Option;
use App\Choice;
use App\Selection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $string = file_get_contents(database_path("seeds/menu.json"));
        $json_a = json_decode($string);  
        $menu_sort =0;
        $category_sort = 0;
        $item_sort = 0;
        $option_sort = 0;
        $choice_sort = 0;
        foreach ($json_a as $k=>$menus) {
            foreach ($menus as $menu) {
                $menu_data = [
                'en' => ['name'  => $menu->en->name,],
                'es' => ['name' => $menu->es->name,],
                ];
                $m = Menu::create($menu_data);
                $category_sort = 0;
                foreach ($menu->categories as $category) {
                   $cat_data = [
                        'en'=> ["name" => $category->en->name],
                        'es'=> ["name" => $category->es->name], 
                        "sort_order"=>$category_sort++, 
                        "menu_id"=> $m->id                   
                   ];
                   if (isset($category->en->description)){
                       $cat_data['en']["description"] = $category->en->description;
                       $cat_data['es']["description"] = $category->es->description;
                   }
                   $c = Category::create($cat_data);
                    $item_sort = 0;
                    if (isset($category->items)) {
                        foreach ($category->items as $item) {
                            $item_data = [
                                'en'=> ["name" => $item->en->name],
                                'es'=> ["name" => $item->es->name], 
                                "price"=> $item->price,
                                "sort_order"=>$item_sort++, 
                                "category_id"=> $c->id                   
                            ];
                            if (isset($item->en->description)){
                                $item_data['en']["description"] = $item->en->description;
                                $item_data['es']["description"] = $item->es->description;
                            }
                            if (isset($item->instructions)){
                                $item_data['instructions'] = $item->instructions;
                            }
                            $i = Item::create($item_data);
                            $choice_sort =0;
                            $option_sort=0;
                            if (isset($item->choices)){
                                foreach($item->choices as $choice) {
                                    $choice_data = [
                                        'en'=> ["name" => $choice->en->name],
                                        'es'=> ["name" => $choice->es->name], 
                                        "sort_order"=>$choice_sort++, 
                                        "item_id"=> $i->id                   
                                    ];                                   
                                    if (isset($choice->instructions)){
                                        $choice_data['instructions'] = $choice->instructions;
                                    }
                                    Choice::create($choice_data);
                                }
                            }
                            if (isset($item->options)){
                                foreach($item->options as $option) {
                                    $option_data = [
                                        'en'=> ["name" => $option->en->name],
                                        'es'=> ["name" => $option->es->name], 
                                        "sort_order"=>$option_sort++, 
                                        "item_id"=> $i->id                   
                                    ];
                                    if (isset($option->price)) {
                                        $option_data['price'] = $option->price;
                                    }    
                                    if (isset($option->instructions)){
                                        $option_data['instructions'] = $option->instructions;
                                    }                                
                                    $o = Option::create($option_data);
                                    if (isset($option->selections)){
                                        foreach($option->selections as $selection) {
                                            $sel_data = [
                                                'en'=> ["name" => $selection->en->name],
                                                'es'=> ["name" => $selection->es->name],
                                                "option_id"=> $o->id,
                                            ];
                                            Selection::create($sel_data);
                                        }
                                    }
                                }                            
                            }
                        }
                    }
                }
            }
        }        
    }
}