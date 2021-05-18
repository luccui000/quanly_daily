<?php

namespace App\Helpers;

use App\Models\MatHang;

class GioHangService
{
    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->empty());
    }

    public function add(MatHang $mathang): void
    {    
        $cart = $this->get(); 
         
        $cartProductsIds = array_column($cart['mathangs'], 'id');
        $mathang->GiaXuat = !empty($mathang->GiaXuat) ? $mathang->GiaXuat : 1;

        if (in_array($mathang->id, $cartProductsIds)) {
            // foreach($cart['mathangs'])
            $cart['mathangs'] = $this->productCartIncrement($mathang->id, $cart['mathangs']);
            $this->set($cart);
            return;
        }

        array_push($cart['mathangs'], $mathang);
        $this->set($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        array_splice($cart['mathangs'], array_search($productId, array_column($cart['mathangs'], 'id')), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'mathangs' => [],
        ];
    }

    public function get(): ?array
    { 
        return request()->session()->get('giohang');
    }

    private function set($cart): void
    {
        request()->session()->put('giohang', $cart); 
    }

    private function productCartIncrement($productId, $cartItems)
    {
        // $amount = 1;
        // $cartItems = array_map(function ($item) use ($productId, $amount) { 
        //     if ($productId == $item['id']) { 
        //         // $item['SoLuong'] += $amount;
        //         // $item['GiaXuat'] += $item['GiaXuat'];
        //     }

        //     return $item;
        // }, $cartItems);

        return $cartItems;
    }
}