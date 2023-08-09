<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    include 'TGC = BEGIN = NEW OR DD.php';
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    #dd('От случайного = Строка: '.__LINE__);
    
    $TGC->setConfig_ChatForLogs($CHATS['MY_LOGS']);
    
    # - ### ###
    # Настройки
    
    $OPT_LastPostsCount = 6; # Сколько последних постов брать
    $OPT_GroupsArr = [ # Какие группы будем проверять.   Все детали внутри класса.
        $CHATS['G-KINO-1'],
        $CHATS['G-KINO-2'],
        $CHATS['G-KINO-3'],
        $CHATS['G-GAME-1'],
    ];
    
    
    # - ### ###
    try { # NOTE: Рабочий
        # - ###
    
        #$TGC->sendInLogChat('Актуализация: Начал');
        
        # - ###
        # - ### ###
        # - ###
    
        #$SUM_VIEWS_TO_ADD = 0;
        $FIN_ARRAYS = [];
        
        # - ###
        foreach( $OPT_GroupsArr as $groupId )
        {
            # - ### Получить посты из группы
            $TGC->setConfig_Chat($groupId);
            
            # - ### Для юзера
            $TGC->action_groupGet_PostsWall_ContentALL_Last($OPT_LastPostsCount);
            
            # - ### Для бота
            /*
            # WORK
            $TGC->apiBot_groupGet_FullChat();
            $groupFullInfo = $TGC->getResult();
            $groupLastId = $groupFullInfo['read_inbox_max_id'];
            $groupPts = $groupFullInfo['pts'];
            
            
            $TGC->apiBot_groupGet_PostsWall_byIdsArr(
                array_reverse(range($groupLastId-$OPT_LastPostsCount,$groupLastId+3))  );
            */
            
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
                $TGCA = new TGCoreActual();
                $TGCA->optSetGroup($groupId);
                $TGCA->optSetMsgOne($oneMsg);
    
                $TGCA->calculateAll();
    
                $FIN_ARRAYS[$groupId][$oneMsg['MSG_URL']] = $TGCA->getResult();
                
                #$fin = $TGCA->FINAL_INFO;
                
                
                
            }# End OneMsg
            
            
            
            
            
            # - ###
            
            
            # - ###
        } # End groupIds
        
        
        #dd($FIN_ARRAYS);
    
    
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
                'V_Add',
                'Накрут авто',
                'Накрут мой',
                'НакрутМикро',
                'НакрутРовный',
            ]);
    
            TableDumper::bodyBegin();
            
            foreach( $rowsArr as $cellsArr )
                TableDumper::makeRow($cellsArr);
    
            TableDumper::bodyEnd();
            TableDumper::tableEnd();
            
        }
        
        function getFormHtml($service,$url,$count,$cntHidden=true,$massBtns=false)
        {
            
            $urlForm = 'SMM = ADD.php';
            
            if($massBtns)
                $style = ' display:inherit; margin-block-end: 0px; ';
            else
                $style = '';
            
            $text = '<form action="/'.$urlForm.'" method="GET" target="_blank" style="'.$style.'">';
            
            $text .= '<input type="text" name="SERVICE_NUM" hidden value="'.$service.'">';
            $text .= '<input type="text" name="MSG_URL"     hidden value="'.$url.'">';
            
            if($cntHidden)
            {
                $text .= '<input type="text" name="COUNT" hidden value="'.$count.'">';
                $text .= '<button>'.$count.'</button>';
            }
            else
            {
                $text .= '<input type="text" name="COUNT"   style="width: 50px;"     value="">';
                $text .= '<br><button>Накрут</button>';
                
            }
            
            $text .= '</form>';
            return $text;
        }
        
        
        
        
        $serv = $TGCA->serviceNumber;
        
        $FIN_ROWS_WAIT = [];
        $FIN_ROWS = [];
        
        foreach( $FIN_ARRAYS as $groupId=>$msgsArr )
        {
            
            foreach( $msgsArr as $msgId => $data )
            {
                $url = $data['POST']['URL'];
                
                $finArr = [];
                $finArr []= '<a href="'.$data['POST']['URL'].'" target="_blank">'.
                    str_replace('https://t.me/','@', $data['POST']['URL']).'</a>';
                
                $finArr []= $data['POST']['DATE_T'];
    
                $dateDiff = date_diff(new DateTime(), new DateTime($data['POST']['DATE_T']), true);
                $finArr []= ($dateDiff->h + $dateDiff->d*24).'ч'.$dateDiff->i.'м';
                #dd($dateDiff);
                
                
                $finArr []= substr($data['POST']['TEXT_FIRST'],0,80);
                
                $color = '';
                switch($data['FINAL']['REASON_MAIN'])
                {
                    case 'COUNT_ENOUGH': $color='lime'; break;
                    case 'POST_PROMO': $color='deepskyblue'; break;
                    case 'NEED_FAST': $color='red'; break;
                    case 'NEED': $color='yellow'; break;
                    default: $color='lightgray'; break;
                }
                $finArr []= '<span style="background: '.$color.';">'.
                    str_replace('_',' ', $data['FINAL']['REASON_MAIN']).
                    '</span>';
                
                
                $finArr []= $data['POST']['VIEWS'];
                $finArr []= $data['CALC']['VIEWS_TARGET_WITH_RAND'];
                
                
                if( $data['FINAL']['NEED_ADD_COUNT'] === -1 )
                {
                    $finArr []= '0';
                    $finArr []= 'X';
                }
                else
                {
                    $finArr []= $data['FINAL']['NEED_ADD_COUNT'];
                    $finArr []= getFormHtml($serv,$url,$data['FINAL']['NEED_ADD_COUNT']);
                }
                
                $finArr []= getFormHtml($serv,$url,-1,false);
                
                
                #$finArr []= ;
                
                
                $str = '<div style="display:inline-block;">';
                foreach([100,125, 150,200, 300,400, 500,600, 700,800, 900,1000] as $count)
                {
                    $cnt = $count+random_int(0,25);
                    $str .= getFormHtml($serv,$url,$cnt,true,true);
                }
                $str .= '</div>';
                $finArr []= $str;
                
                
                $str = '<div style="display:inline-block;">';
                foreach([100,125,150,200,250,300,350,400] as $count)
                    $str .= getFormHtml($serv,$url,$count,true,true);
                $str .= '</div>';
                $finArr []= $str;
    
                
                #if( $color !== 'lime' )
                if( $data['FINAL']['REASON_MAIN'] !== 'COUNT_ENOUGH' )
                    $FIN_ROWS_WAIT[$msgId] = $finArr;
                
                $FIN_ROWS[$groupId][$msgId] = $finArr;
                
            }# End OneMsg
    
            
            
            # - ###
            
            
            # - ###
        } # End groupIds
        
        
        # - ###
        # - ###
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
            dump('Группа: '.$groupId);
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
