<?php

namespace App\Http\Controllers;
use App\Trendyol;
use GuzzleHttp\Client;

class TrendyolController extends Controller
{
    public function executeOrder($array){
        if(is_array($array))
        {
            foreach ($array as $item) {
                if(isset($item['subCategories']) and count($item['subCategories'])>0){
                    if(!isset($item['parentId']))
                    {
                        $item['parentId'] = 0;
                    }
                    $this->saveToDb($item['id'],$item['parentId'],$item['name'],0);
                    $item=$item['subCategories'];
                    $this->executeOrder($item);
                    continue;
                }else{
                    $this->saveToDb($item['id'],$item['parentId'],$item['name'],1);
                }
            }
        }
    }

    public function getData(){
        $client = new Client(['headers'=>['content-type'=> "application/json","Accept"=>"application/json"],]);
        $response = $client->request('GET','https://api.trendyol.com/sapigw/product-categories');
        $data = $response->getBody();
        $data = json_decode($data,true);
        $cats = $data;
        $this->executeOrder($cats['categories']);
        echo "<h1 class='font-size:50px;'>Executed successfully. Check the database.</h1>";
    }


    public function saveToDb($category_id,$parent_id,$name,$is_last){
        $status = 1;
        $site_id= 1;
        $urun = new Trendyol();
            $urun->category_id = $category_id;
            $urun->parent_id = $parent_id;
            $urun->name = $name;
            $urun->is_last = $is_last;
            $urun->status = $status;
            $urun->site_id = $site_id;
            $urun->save();
    }
}
