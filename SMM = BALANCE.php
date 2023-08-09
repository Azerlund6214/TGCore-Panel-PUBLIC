<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
    use LibMy\Filer;
    use LibMy\apiSmmPrime;
	
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    # - ### ###
    try { # NOTE: Рабочий
        # - ###
        
        dump($_GET);
        
        $res = apiSmmPrime::action_GetBalance($OPT_PANEL__SMM_API_KEY);
        dump($res);
        
        # - ###
    
        Filer::writeToNewLine($OPT_PANEL__LOG_PathRequests,
            date('d M Y H:i:s').' => '.str_pad($_SERVER['REMOTE_ADDR'],15,' ').' => BALANCE'.
            ' => '.$res['balance'].'р'
        );
        
        # - ###
        
        dd('dd');
        
        # - ## #### ##
        # - ### ## ###
        # - ## #### ##
    }catch( \Throwable $e) { TryCatcher::ddOnTryCatch($e); }
    
    
    # - ### ### ###
    #   NOTE:
    
    
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######

# End class
