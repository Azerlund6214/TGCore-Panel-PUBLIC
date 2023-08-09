<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
    use LibMy\Filer;
    use LibMy\Ancii;
    use LibMy\TryCatcher;
    use LibMy\apiSmmPrime;
    use LibMy\FileJsoner;
    
    ignore_user_abort(true);
    dump( 'ignore_user_abort' );
    # Иначе не запишет в жсон
    
    ini_set('max_execution_time',60); # 3600=1час
    dump( 'max_execution_time = 60' );
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    # - ### ###
    try { # NOTE: Рабочий
        # - ###
        
        dump($_GET);
        
        # - ###
        
        if( count($_GET) !== 3 )
            dd('Кривой GET');
        
        if( ! isset($_GET['SERVICE_NUM'],$_GET['MSG_URL'],$_GET['COUNT']) )
            dd('Кривой GET isset');
        
        # - ###
        
        $res = apiSmmPrime::action_AddOrder( $OPT_PANEL__SMM_API_KEY,$_GET['SERVICE_NUM'],
                                                 $_GET['MSG_URL'],$_GET['COUNT']);
        dump($res);
        
        $orderNum = $res['order'];
        
        usleep(300);
        
        # - ###
        
        $orderInfo = apiSmmPrime::action_OrderInfo($OPT_PANEL__SMM_API_KEY,$orderNum);
        
        dump($orderInfo);
        usleep(500);
        
        # - ###
        
        $balance = apiSmmPrime::action_GetBalance($OPT_PANEL__SMM_API_KEY);
        dump($balance);
        
        Ancii::anyTextDump($orderInfo['charge']);
        Ancii::anyTextDump(explode('.',$balance['balance'])[0]);
        
        # - ###
    
    
        $arrData_NewOrder = [
            'time' => date('Hч:iм'),
            #'countBefore' => $_GET['COUNT_NOW'],
            'serviceNum' => $_GET['SERVICE_NUM'],
            'url' => $_GET['MSG_URL'],
            'count' => $_GET['COUNT'],
            'orderNum' => (string) $orderNum,
            'cost' => number_format($orderInfo['charge'],2,'.'),
            'balance' => $balance['balance'],
        ];
        dump($arrData_NewOrder);
        
        # - ###
        
        
        $arrOrders_ALL = FileJsoner::getBase_FullAsArray($OPT_PANEL__LOG_PathOrdersJson);
        
        #$ordersAlreadyHave = in_array($_GET['MSG_URL'], array_keys($arrOrders_ALL));
        $ordersAlreadyHave = isset($arrOrders_ALL[$_GET['MSG_URL']]);
        
        if( $ordersAlreadyHave )
        {
            $OldOrders = $arrOrders_ALL[$_GET['MSG_URL']];
            dump('Заказы уже есть',$OldOrders);
            
            if( isset($OldOrders['url']) ) # Если старый формат и только 1 заказ.
            {
                dump('Есть старого формата');
                $finOrdersArr = [];
                $finOrdersArr []= $OldOrders; # Старый ключной массив
                $finOrdersArr []= $arrData_NewOrder;
            }
            else # Новый формат
            {
                dump('Есть нового формата');
                $finOrdersArr = [];
                $finOrdersArr = $OldOrders; # Старые номерные массивы
                $finOrdersArr []= $arrData_NewOrder;
            }
            
            FileJsoner::action_addByKey($OPT_PANEL__LOG_PathOrdersJson,$finOrdersArr,$_GET['MSG_URL']);
            dump('Итого пишу в ключ:',$finOrdersArr);
        }
        else
        {
            dump('Первый заказ');
            $finOrdersArr = [$arrData_NewOrder];
            
            # NOTE: Уже по номерам
            FileJsoner::action_addByKey($OPT_PANEL__LOG_PathOrdersJson, $finOrdersArr,$_GET['MSG_URL']);
            
            dump('Итого пишу в ключ:',$finOrdersArr);
        }
        
        
        
        
        
        
        
        # - ###
    
        Filer::writeToNewLine($OPT_PANEL__LOG_PathRequests,
            date('d M Y H:i:s').' => '.str_pad($_SERVER['REMOTE_ADDR'],15,' ').' => ORDER'.
            ' => '.$arrData_NewOrder['serviceNum'].' : '.$arrData_NewOrder['url'].' : '.$arrData_NewOrder['count'].
            ' => №'.$arrData_NewOrder['orderNum'].' => '.$arrData_NewOrder['cost'].'р => '.$arrData_NewOrder['balance'].'р'
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
