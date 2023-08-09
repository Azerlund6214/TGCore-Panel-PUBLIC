<?php
    # - ### ### ### ### ###
    # - ### ### ###
    #   NOTE:
    
    use LibMy\TimerMy;
    use LibMy\apiTGCore;
    use LibMy\TryCatcher;
    
    #/* #
    try {
        
        $TIMER_TGC = new TimerMy();
        
        $TGC = new apiTGCore();
    
        $TGC->setConfig_Session($TGC_SESS_PATH); # Из файла настроек
        
        dump('TGC - Начало init()'); flush();
        
        $TGC->init();
        
        $TGC->setConfig_PreviewIsOn(false);
        $TGC->setConfig_Silent(true);
        $TGC->setConfig_ParseMode_HTML();
        
        dump('TGC - Подулючен => '.$TIMER_TGC->getTimeMs()); flush();
        
        
    }catch( \Throwable $e)
    {
        TryCatcher::ddOnTryCatch($e);
    }
    # */
    
    
    # - ### ### ###
    # - ### ### ### ### ###
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######
    
    # End
