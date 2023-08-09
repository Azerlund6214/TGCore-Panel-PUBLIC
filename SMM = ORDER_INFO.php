<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
    use LibMy\Filer;
    use LibMy\Ancii;
    use LibMy\TryCatcher;
    use LibMy\apiSmmPrime;
	
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    # - ### ###
    try { # NOTE: Рабочий
        # - ###
        
        dump($_GET);
    
        if( count($_GET) !== 1 )
            dd('Кривой GET, !=1');
    
        if( ! isset($_GET['ORDER_NUM']) )
            dd('Кривой GET isset');
        
        $res = apiSmmPrime::action_OrderInfo($OPT_PANEL__SMM_API_KEY, $_GET['ORDER_NUM']);
        
        dump($res);
        
        Ancii::anyTextDump($res['status']);
        Ancii::anyTextDump($res['remains']);
        
        # - ###
    
        Filer::writeToNewLine($OPT_PANEL__LOG_PathRequests,
            date('d M Y H:i:s').' => '.
            str_pad($_SERVER['REMOTE_ADDR'],15,' ').
            ' => ORDER_INFO = '.$_GET['ORDER_NUM']
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
