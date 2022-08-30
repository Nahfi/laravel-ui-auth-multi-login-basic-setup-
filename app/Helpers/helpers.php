<?php
    function generalSettings(){
        $generalSettings = App\Models\GeneralSettings::latest()->first();
        return $generalSettings;
    }