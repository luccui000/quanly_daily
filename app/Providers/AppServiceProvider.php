<?php

namespace App\Providers;

use Stringable;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
  

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $mySelf = $this;
        Builder::macro('search', function($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        }); 
        Builder::macro('toCsv', function () {
            $results = $this->get();

            if ($results->count() < 1) return;

            $titles = implode(',', array_keys((array) $results->first()->getAttributes())); 
            $values = $results->map(function ($result) {
                return implode(',', collect($result->getAttributes())->map(function ($thing) {
                    return '"'.$thing.'"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });
         
        Builder::macro('layMa', function($column) use ($mySelf) {
            $mySelf->kiemtraCotCoTonTaiHayKhong($column);
            $codegenerate = $this->find(1)->$column;
            $strCode = '';
            if($codegenerate < 10000) {
                for($i = 0; $i < 4 - strlen($codegenerate); $i++) $strCode .= '0';
                $strCode .= $codegenerate; 
            } else {
                $strCode = $codegenerate;
            }
            return $strCode; 
        });
        Builder::macro('tangMa', function($column) use ($mySelf) {
            $mySelf->kiemtraCotCoTonTaiHayKhong($column);
            $prevMa = $this->find(1)->$column; 
            $this->where('id', 1)->update([
                $column => (int)$prevMa + 1
            ]);  
        });
    }
    public function kiemtraCotCoTonTaiHayKhong($column)
    {
        $codeGeneratorSchema = \DB::getSchemaBuilder()->getColumnListing('CODE_GENERATOR');
        if(!in_array($column, $codeGeneratorSchema)) {
            throw new InvalidArgumentException('Không tìm thấy thuộc tính '. $column);
        } 
    }
}
