<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider{

    public function boot(){
        $modules = config('module.modules');

        foreach($modules as $module){
            if(file_exists(base_path().'/modules/'.$module.'/Routes/web.php')){
                include base_path().'/modules/'.$module.'/Routes/web.php';
            }

            if(file_exists(base_path().'./modules/'.$module.'/Routes/api.php')){
                include base_path().'/modules/'.$module.'/Routes/api.php';
            }

            if(is_dir(base_path().'/modules/'.$module.'/Views')){
                $this->loadViewsFrom(base_path().'/modules/'.$module.'/Views/',$module);
            }
        }
    }
}