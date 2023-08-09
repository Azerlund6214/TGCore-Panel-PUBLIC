<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    
    use LibMy\Ancii;
    use LibMy\TableDumper;
	
    # - ### ###
    
    include 'TGC = BEGIN = NEW OR DD.php';
    
    # - ### ###
    
    function getAllInfo($TGC, $groupId)
    {
        # - ###
        $OPT_MaxLastPosts = 80;
        
        # - ###
        $TGC->setConfig_Chat($groupId);
        
        # - ###
        # Общая инфа
        echo "<hr color='red'>";
        dump("Группа = $groupId");
        
        
        $TGC->api_groupGet_PostsWall_PostsCount();
        $count = $TGC->getResult();
        dump("Всего постов: $count");
        $TGC->responseAll_Clear();
    
        $TGC->api_groupGet_PostsWall_PTS();
        dump("PTS постов: ".$TGC->getResult());
        
        #$TGC->api_groupGet_UsersCount();
        #dump("Подписоты: ".$TGC->getResult());
        #dd($TGC->getResult());
        #$TGC->responseAll_Clear();
    
        $TGC->api_groupGet_PostsScheduled_Count();
        dump("Отложка залито: ".$TGC->getResult());
        $TGC->responseAll_Clear();
        
        # - ###
        # Получение и разборка постов
        
        if($count > $OPT_MaxLastPosts)
            $count = $OPT_MaxLastPosts;
    
        $TGC->action_groupGet_PostsWall_ContentALL_Last($count);
        $MSGsArr = $TGC->getResult();
        dump("Получено постов: ".count($MSGsArr));
        
        # - ###
    
        TableDumper::echoStyle_1();
        TableDumper::tableBegin();
    
        TableDumper::makeHead([
            'MSG_ID',
            'URL',
            'Дата',
            'Текст',
            'V_Now',
        ]);
    
        TableDumper::bodyBegin();
        
        #dd($MSGsArr);
        foreach( $MSGsArr as $msgId => $data )
        {
            $finArr = [];
            $finArr []= $data['MSG_ID'];
            
            
            $url = $data['MSG_URL'];
            $finArr []= '<a href="'.$url.'" target="_blank">'.$url.'</a>';
            
            $finArr []= $data['DATE_T'];
            $finArr []= substr($data['TEXT_ARR'][0],0,80);
            $finArr []= $data['STAT_VIEWS'];
            
            TableDumper::makeRow($finArr);
        }# End OneMsg
    
    
        TableDumper::bodyEnd();
        TableDumper::tableEnd();
        
        # - ###
        
    }
    
    
    # - ### ###
    
    
    $IDsArr = [
        $CHATS['G-KINO-1'],
        $CHATS['G-KINO-2'],
        $CHATS['G-KINO-3'],
        $CHATS['G-GAME-1'],
        
    ];
    
    foreach( $IDsArr as $groupId )
        getAllInfo($TGC, $groupId);
    
	
    # - ### ###
    
	Ancii::success();
	
    $TGC->onENDING_DD();
    
    # - ### ### ###
    #   NOTE:
    
    
    
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######

# End class
