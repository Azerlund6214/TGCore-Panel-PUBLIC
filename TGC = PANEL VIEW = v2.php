<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
	use LibMy\Ancii;
    use LibMy\FileJsoner;
    use LibMy\TryCatcher;
    use LibMy\TableDumper;
    use LibMy\TGCorePanelViewsStatic;
	
    # - ### ###
    
    /*if( @$_GET['PASS'] !== '1234' ) # WORK
    {
        file_WriteStringNewLine($OPT_PANEL__LOG_PathRequests,date('d M Y H:i:s').' => '.str_pad($_SERVER['REMOTE_ADDR'],15,' ').' => NO PASS');
        dd('Неверный пароль');
    } # */
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    include 'TGC = BEGIN = NEW OR DD.php';
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    #dd('От случайного = Строка: '.__LINE__);
    
    #$TGC->setConfig_ChatForLogs($CHATS['MY_LOGS']);
    
    # - ### ###
    # Настройки
	
	
    
    echo '<a href="SMM = BALANCE.php" target="_blank">УЗНАТЬ БАЛАНС</a><br><br><br>';
    
    dump('API KEY: '.substr($OPT_PANEL__SMM_API_KEY, 0,-22).str_pad('',12,'.').substr($OPT_PANEL__SMM_API_KEY, 22,100));
    dump($OPT_PANEL__ServiceArr,$OPT_PANEL__GROUPS_ARR,'API MODE: '.$OPT_PANEL__TGC_API_MODE);
    
    # - ### ###
    try { # NOTE: Рабочий
        # - ###
    
        #$TGC->sendInLogChat('Актуализация: Начал');
        
        # - ###
        # - ### ###
        # - ###
    
        $FIN_ARRAYS = [];
        
        # - ###
        foreach($OPT_PANEL__GROUPS_ARR as $groupId => $optsArr )
        {
            # - ###
            $groupId = (string) $groupId;
            
            # - ### Получить посты из группы
            #  Разные апи и методы для бота июзера
            
            $TGC->setConfig_Chat($groupId);
    
            if( $OPT_PANEL__TGC_API_MODE === 'USER')
            {
                $TGC->action_groupGet_PostsWall_ContentALL_Last($OPT_PANEL__LastPostsCount);
            }
            else
            {
                # WORK
                $TGC->apiBot_groupGet_FullChat();
                $groupFullInfo = $TGC->getResult();
                $groupLastId = $groupFullInfo['read_inbox_max_id'];
                $groupPts = $groupFullInfo['pts'];
    
                if( $groupId === '-123123' )
                {
                    $groupLastId += 27;
                    #dump($groupFullInfo);
                    #dump( array_reverse(range(
                    #    $groupLastId-$OPT_PANEL__LastPostsCount,
                    #    $groupLastId+5)) );
                    #dd(123);
                }
                
                $TGC->apiBot_groupGet_PostsWall_byIdsArr(
                    array_reverse(range(
                        $groupLastId-$OPT_PANEL__LastPostsCount,
                        $groupLastId+3))  );
            }
            
            
            
            # - ###
    
            if($TGC->response_ErrorAny())
            {
                if($TGC->response_ErrorTg())
                    Ancii::anyTextDump($TGC->response_ErrorTgGetMsg());
                
                $TGC->getResponse_full(true);
            }
            
            $postsAllMsg = $TGC->getResult();
            #dump( "Получили постов: ".count($postsAllMsg) );
            
            # - ###
            
            foreach( $postsAllMsg as $oneMsg )
            {
                
                $TGCA = new TGCorePanelViewsStatic();
                $TGCA->optSetGroup($groupId,$optsArr);
                $TGCA->optSetMsgOne($oneMsg);
                $TGCA->optSetMsgOne($oneMsg);
                
                $TGCA->calculateAll();
                
                $FIN_ARRAYS[$groupId][$oneMsg['MSG_URL']] = $TGCA->getResult();
                
            }# End OneMsg
            
            # - ###
        } # End groupIds
        
    }catch( \Throwable $e ) {  $TGC->responseAll_Dump();  TryCatcher::ddOnTryCatch($e); }
    # - ### ###
    #dd($FIN_ARRAYS);
    
    # - ###
    # - ### ###
    # - ###
    
    
    function printFullTable($rowsArr)
    {
        TableDumper::echoStyle_1();
        TableDumper::tableBegin();

        TableDumper::makeHead([
            'URL',
            'Дата',
            'Прошло',
            'Текст',
            #'',
            'Reason',
            'V_Now',
            'V_Targ',
            #'V_Add',
            'Авто',
            'Любой',
            'Микро',
            'Заказы',
        ]);

        TableDumper::bodyBegin();
        
        foreach( $rowsArr as $cellsArr )
            TableDumper::makeRow($cellsArr);

        TableDumper::bodyEnd();
        TableDumper::tableEnd();
        
    }
    
    
    
    
    # IMPORTANT Фул переписывать нормально.   Много методов для разных кнопок
    #  Добавить инпут для тек просмотров + сколько будет.   Писать это в жсон и выводить.
    function getFormHtml($service,$url,$count,$cntHidden=true,$massBtns=false,$btnText='DEF',$noStyle=false,$inputPlaceholder='NO')
    {
        $urlForm = 'SMM = ADD.php';
        
        
        
        if($massBtns)
            $style = ' display:inherit; margin-block-end: 0px; ';
        else
            $style = '';
        
        if($noStyle) # TODO: Это костыль за 5сек.
            $style = ' margin-block-end: 0em; ';
        
        $text = '<form action="/'.$urlForm.'" method="GET" target="_blank" style="'.$style.'">';
        
        $text .= '<input type="text" name="SERVICE_NUM" hidden value="'.$service.'">';
        $text .= '<input type="text" name="MSG_URL"     hidden value="'.$url.'">';
        
        if($cntHidden)
        {
            if($btnText === 'DEF') $btnText = $count;
            
            $text .= '<input type="text" name="COUNT" hidden value="'.$count.'">';
            $text .= '<button>'.$btnText.'</button>';
        }
        else
        {
            if($btnText === 'DEF') $btnText = 'Накрут';
            
            if( $inputPlaceholder === 'NO' )
                $inputPlaceholder = '';
                
            $text .= '<input type="text" name="COUNT"   style="width: 50px;"     value="'.$inputPlaceholder.'">';
            $text .= ' <button>'.$btnText.'</button>';
            
        }
        
        $text .= '</form>';
        return $text;
    }
    
    
    
    
    
    $serviceNum_Fast  = $OPT_PANEL__ServiceArr['VIEW_FAST']['S_NUM'];
    $serviceNum_Slow2 = $OPT_PANEL__ServiceArr['VIEW_SMOOTH_2']['S_NUM'];
    $serviceNum_Slow5 = $OPT_PANEL__ServiceArr['VIEW_SMOOTH_5']['S_NUM'];
    
    
    $FIN_ROWS_WAIT = [];
    $FIN_ROWS = [];
    
    try { # NOTE: Рабочий
        # - ###
        
        foreach( $FIN_ARRAYS as $groupId=>$msgsArr )
        {
            
            foreach( $msgsArr as $msgId => $data )
            {
                $url = $data['POST']['URL'];
    
                $priceFast = number_format(($data['FINAL']['NEED_ADD_COUNT']/1000*$OPT_PANEL__ServiceArr['VIEW_FAST']['PRICE_1k']),2,'.').'руб';
                $priceSlow = number_format(($data['FINAL']['NEED_ADD_COUNT']/1000*$OPT_PANEL__ServiceArr['VIEW_SMOOTH_2']['PRICE_1k']),2,'.').'руб';
                
                
                $finArr = [];
                $finArr []= '<a href="'.$data['POST']['URL'].'" target="_blank">'.
                    str_replace('/','<br>',  # NOTE:
                    str_replace('_',' ',  # NOTE: Меняю на прпобелы чтоб были переносы.
                    str_replace('https://t.me/','@', $data['POST']['URL'])
                    )).'</a>';
                
                $finArr []=  str_replace(' ',"<br>",str_replace('2023','23',$data['POST']['DATE_T']));
                
                $dateDiff = date_diff(new DateTime(), new DateTime($data['POST']['DATE_T']), true);
                $finArr []= ($dateDiff->h + $dateDiff->d*24).'ч'.$dateDiff->i.'м';
                #dd($dateDiff);
                
                
                $textCell = substr($data['POST']['TEXT_FIRST'],0,30);
                $textCell = '<span title="'.$data['POST']['TEXT_RAW'].'">'.$textCell.'<span>';
                $finArr []= $textCell;
    
    
                # - ###
                
                #$title .= 'Цена Fast: '.$priceFast."\n";
                #$title .= 'Цена Slow: '.$priceSlow."\n";
    
                $title  = $data['FINAL']['REASON_DESC']."\n";
                $title .= $serviceNum_Fast.' | '.$data['POST']['URL'].' | '.$data['FINAL']['NEED_ADD_COUNT']."\n";
                
                $htmlReason  = '<span  style="background: '.$data['FINAL']['REASON_COLOR'].';" title="'.$title.'" >';
                $htmlReason .= str_replace('_',' ', $data['FINAL']['REASON_MAIN']);

                if( $data['FINAL']['REASON_MAIN'] === 'COUNT_ENOUGH' )
                    $htmlReason = str_replace('UNT ENO','UNT<br>ENO', $htmlReason);

                if( in_array($data['FINAL']['REASON_MAIN'],['NEED'])  )
                {
                    $htmlReason .= "<br>F: $priceFast";
                    $htmlReason .= "<br>S: $priceSlow";
                }
        
                    $htmlReason .= '</span>';
                $finArr []= $htmlReason;
                
                # - ###
                
                
                $finArr []= $data['POST']['VIEWS']."<br>"
                    .floor($data['POST']['VIEWS']/$data['CALC']['VIEWS_TARGET_FULL']*100).'%';
                
                #$finArr []= $data['CALC']['VIEWS_TARGET_WITH_RAND'];
                $znak = ''; if($data['CALC']['RANDOM_STATIC'] >= 1) $znak='+';
                $finArr []= $data['CALC']['VIEWS_TARGET_WITH_RAND']."<br>(".$znak.
                                $data['CALC']['RANDOM_STATIC'].')';
    
    
    
                $needAddCnt = $data['FINAL']['NEED_ADD_COUNT'];
                if( $needAddCnt === -1 )
                {
                    #$finArr []= '✅';
                    $finArr []= '✅';
                }
                else
                {
                    #$finArr []= $needAddCnt;
                    
                    
                    # NOTE: Ооооооочень костыльно, не было времени на рефактор.
                    $htmlAuto  = getFormHtml($serviceNum_Fast,$url,$needAddCnt
                        ,true,false,$needAddCnt."<br>Fast", true);
                    $htmlAuto .= getFormHtml($serviceNum_Slow2,$url,$needAddCnt
                        ,true,false,$needAddCnt."<br>Slow2", true);
                    
                    $finArr []= $htmlAuto;
                }
    
                
                
                
                
                
                $htmlManual  = getFormHtml($serviceNum_Fast,$url,-1,false,
                    false,'Fast_',true);
                #$htmlManual .= '<br>';
                $htmlManual .= getFormHtml($serviceNum_Slow2,$url,-1,false,
                    false,'Slow2',true,random_int(50,65));
                $htmlManual .= getFormHtml($serviceNum_Slow5,$url,-1,false,
                    false,'Slow5',true,random_int(50,65));
                
                $finArr []= $htmlManual;
                
                
                
                
                
                
                
                #$finArr []= ;
                
                # 400, 500,600, 700,800, 900,1000
                $str = '<div style="">'; #display:inline-block;
                foreach([150,300,400] as $count)
                {
                    $cnt = $count+random_int(0,25);
                    $str .= getFormHtml($serviceNum_Fast,$url,$cnt,true,true);
                }
                $str .= '</div>';
                $finArr []= $str;
                
                
                #$str = '<div style="display:inline-block;">';
                #foreach([100,125,150,200,250,300,350,400] as $count)
                #    $str .= getFormHtml($serviceNum_Fast,$url,$count,true,true);
                #$str .= '</div>';
                #$finArr []= $str;
                
                # - ###
                
                #$arrOrders = FileJsoner::getAsArray($OPT_PANEL__LOG_PathOrdersJson);
                $arrOrders = FileJsoner::getBase_FullAsArray($OPT_PANEL__LOG_PathOrdersJson);
                
                $pathFile_OrderInfo = 'SMM = ORDER_INFO.php';
                
                
                if( in_array($url, array_keys($arrOrders)) )
                {   # Если нашли такой ключ - заказ был.
                    $INFO = $arrOrders[$url];
                    
                    #dd($INFO);
                    if( isset($INFO['url']) ) # Если старый формат и только 1 заказ.
                    {
                        $ORD_ARR = [
                            "{$INFO['time']}",
                            "+{$INFO['count']}шт",
                            "{$INFO['cost']}р",
                            #"{$INFO['']}",
                        ];
                        
                        $orderNumWithUrl = '<a href="'.$pathFile_OrderInfo.'?ORDER_NUM='.$INFO['orderNum'].'" target="_blank" >ORDER</a>';
                        
                        if( $INFO['serviceNum'] === '854' )
                            $ORD_ARR []= "{$orderNumWithUrl}-<span style='background: deepskyblue;'>{$INFO['serviceNum']}</span>";
                        else
                            $ORD_ARR []= "{$orderNumWithUrl}-{$INFO['serviceNum']}";
                            
                        $finArr []= implode(' | ',$ORD_ARR);
                    }
                    else
                    {
                        $ordersTextArr = [ ];
                        foreach( $INFO as $oneOrder )
                        {
                            #dd($INFO);
                            
                            $ORD_ARR = [
                                "{$oneOrder['time']}",
                                "+{$oneOrder['count']}шт",
                                "{$oneOrder['cost']}р",
                                #"{$INFO['']}",
                            ];
                            
                            $orderNumWithUrl = '<a href="'.$pathFile_OrderInfo.'?ORDER_NUM='.$oneOrder['orderNum'].'" target="_blank" >ORDER</a>';
                            
                            if( $oneOrder['serviceNum'] === '854' )
                                $ORD_ARR []= "{$orderNumWithUrl}-<span style='background: deepskyblue;'>{$oneOrder['serviceNum']}</span>";
                            else
                                $ORD_ARR []= "{$orderNumWithUrl}-{$oneOrder['serviceNum']}";
                            
                            $ordersTextArr []= implode(' | ',$ORD_ARR);
                        }
                        
                        $finArr []= implode('<br>',$ordersTextArr);
                        
                    }
                    
                    
                    #$htmlOrders .= 'X'.' -> '.$INFO['count'].' = +X'.'<br>';
                }
                else
                {
                    $finArr []= 'Нет';
                }
                
                # - ###
                
                #if( $color !== 'lime' )
                if( $data['FINAL']['REASON_MAIN'] !== 'COUNT_ENOUGH' )
                    $FIN_ROWS_WAIT[$msgId] = $finArr;
                
                $FIN_ROWS[$groupId][$msgId] = $finArr;
                
            }# End OneMsg
    
            
            
            # - ###
            
            
            # - ###
        } # End groupIds
        
        # - ###
    
    }catch( \Throwable $e) {  $TGC->responseAll_Dump();  TryCatcher::ddOnTryCatch($e); }
    
    
    try { # NOTE: Рабочий
        # - ###
        
        echo '<br><br><hr color="red">';
        dump('Сразу нужные: '.count($FIN_ROWS_WAIT).' шт');
        printFullTable($FIN_ROWS_WAIT);
        #dump($FIN_ROWS_WAIT);
        echo '<br><br><hr color="red"><br><br><br>';
        
        # - ###
        
        foreach( $FIN_ROWS as $groupId=>$msgsArr )
        {
            echo '<br><br><hr color="red">';
            dump("Группа: $groupId => Цель: ".$OPT_PANEL__GROUPS_ARR[$groupId]['STATIC_COUNT'].
                ' => Рандом: '.$OPT_PANEL__GROUPS_ARR[$groupId]['STATIC_RANDOM'][0].'...'.$OPT_PANEL__GROUPS_ARR[$groupId]['STATIC_RANDOM'][1]);
            printFullTable($msgsArr);
        }
        
        # - ###
        
        #dump($FIN_ROWS);
        dump($FIN_ARRAYS);
        
        # - ## #### ##
        # - ### ## ###
        # - ## #### ##
        
        $TGC->onENDING_DD();
        
        # - ## #### ##
        # - ### ## ###
        # - ## #### ##
    }catch( \Throwable $e) {  $TGC->responseAll_Dump();  TryCatcher::ddOnTryCatch($e); }
    
    
    # - ### ### ###
    #   NOTE:
    
    
    # - ### ### ###
    #   NOTE:
    
    
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######

# End class
