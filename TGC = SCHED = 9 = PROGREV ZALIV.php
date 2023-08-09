<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
	use LibMy\Ancii;
	use LibMy\DaterUC;
	use LibMy\FileJsoner;
	use LibMy\Sleeper;
	use LibMy\TryCatcher;
	
	# - ### ###
    # - ### ### ###
    # - ### ###
    
    include 'TGC = BEGIN = NEW OR DD.php';
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    #   NOTE: Только ручной залив.
    
    # - ### ### ###
    #   NOTE:
    
    $DataSets_Folder = 'SCHED_GREV/';
    $groupViewsArr = [
        
        # /*
        $CHATS['G-PROGREV-1'] => [
              'DATES_DONE' => $DataSets_Folder . 'GREV-1 = DATES = DONE.json',
              'DATES_WAIT' => $DataSets_Folder . 'GREV-1 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-2'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-2 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-2 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-3'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-3 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-3 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-4'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-4 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-4 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-5'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-5 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-5 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-6'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-6 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-6 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-7'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-7 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-7 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-8'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-8 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-8 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-9'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-9 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-9 = DATES = WAIT.json', ], # */
    
       # /*
       $CHATS['G-PROGREV-10'] => [
             'DATES_DONE' => $DataSets_Folder . 'GREV-10 = DATES = DONE.json',
             'DATES_WAIT' => $DataSets_Folder . 'GREV-10 = DATES = WAIT.json', ], # */
        
    ];
    
    # - ### ### ###
    #   NOTE:
    
    
    dd( $groupViewsArr );
    
    
    
    #$a = 1;
    # - ### ### ###
    #   NOTE:
    
    
    
    try {
        # - ###
        
        $scheduleLimit = 100;
        $scheduleWaitTimeSec = .4;
        
        # - ###
        
        foreach( $groupViewsArr as $groupId => $groupSettings )
        {
            # - ###
            echo '<br><br><hr color="red">';
            
            $TGC->setConfig_Chat($groupId);
            
            # - ###
            
            #dd('От случайного');
            
            
            foreach( range(1,999) as $i )
            {
                # - ###
                echo '<br><br><hr color="red">';
                dump("Группа: $groupId  =>  I: $i");
                # - ###
                
                # Проверка что в отложке еще есть место
                $TGC->api_groupGet_PostsScheduled_Count();
                $postsCurrent = $TGC->getResult();
                
                dump("Сейчас в отложке: $postsCurrent  из  $scheduleLimit");
                
                if( $postsCurrent >= $scheduleLimit )
                {
                    dump('Отложка заполнена до лимита');
                    break;
                }
                # - ###
                
                # Чтение - Даты
                $DS_Time_ALL = FileJsoner::getBase_FullAsArray($groupSettings['DATES_WAIT']);
                
                # - ###
                
                # Проверки что не кончились
                if( count($DS_Time_ALL) === 0 ) dd('Кончились неотправленные время постов');
                
                # - ###
                
                $DS_Time_Key_T = array_key_first($DS_Time_ALL);
                $DS_Time_Val_U = current($DS_Time_ALL);
                
                
                # - ###
                
                # - ###
                
                $post_DT_T = $DS_Time_Key_T;
                $post_DT_U = $DS_Time_Val_U;
                
                dump("Исходные = $post_DT_T => $post_DT_U");
                
                #dd($DS_Data);
                
                # - ###
                
                # Прибавить от 0 до 55мин
                $post_DT_U = DaterUC::modifyUnix_AddMinute($post_DT_U, random_int(0, 55))+10800;
                $post_DT_T = DaterUC::convertUnixToClassic($post_DT_U);
                #$post_DT_T = DaterUC::getClassicFromUnix($post_DT_U);
                dump("С добавкой = $post_DT_T => $post_DT_U");
                
                $post_Text = "$post_DT_T => $post_DT_U => ".random_int(0,999);
                $post_ImgUrl = $TGC->getRand_ImgUrl();
                dump($post_ImgUrl);
                
                # - ###
                
                #dd($post_Text,$post_DT_U,$post_ImgUrl);
                
                # Залив
                dump('Отправляю'); flush();
                $TGC->api_msgSend_Any($post_Text,$post_DT_U-10800,$post_ImgUrl);
                dump('Готово'); flush();
                
                
                # - ###
                # Проверка ошибок
                
                if( $TGC->response_ErrorAny() )
                {
                    Ancii::failed();
                    
                    if($TGC->response_ErrorTg())
                    {
                        Ancii::anyTextDump($TGC->response_ErrorTgGetMsg());
                        Ancii::anyTextDump($TGC->response_ErrorTgGetCode());
                    }
                    
                    $TGC->responseAll_Dump();
                    
                    dd('Выхожу из цикла тк феил');
                    dump('Выхожу из цикла тк феил');
                    break;
                }
                
                
                Ancii::success();
                
                $TGC->api_groupGet_PostsScheduled_Count();
                dump('В отложке сейчас => '.$TGC->getResult());
                #dd(123123);
                # - ###
                
                
                # Дата успех = Дописываю
                FileJsoner::action_addByKey($groupSettings['DATES_DONE'],$DS_Time_Val_U,$DS_Time_Key_T);
                
                
                # Даты успех = Чтение / Склейка / Запись
                #$DS_Done_Time = getAsArray($groupSettings['DATES_DONE']);
                #$DS_Done_Time[$DS_Time_Key_T]= $DS_Time_doned_U;
                #FileJsoner::action_writeArray($groupSettings['DATES_DONE'],$DS_Done_Time);
                
                # - ###
                #$a = current($DS_Time);
                
                #$DS_Time_doned_U = $DS_Time_Val_U;
                #unset($DS_Time_Key_T);
                #FileJsoner::action_writeArray($groupSettings['DATES_DONE'],$DS_Time_ALL);
                
                # Удаление+Запись без = Даты
                FileJsoner::action_deleteKey($groupSettings['DATES_WAIT'],$DS_Time_Key_T);
                #unset($DS_Data_Val);
                #FileJsoner::action_writeArray($groupSettings['DATASET_DONE'],$DS_Data_ALL);
                
                # - ###
                
        
                
                # - ###
    
                Sleeper::sleeper($scheduleWaitTimeSec);
                
                # - ###
        
        
            }# Foreach I
            #dd(__LINE__);
    
    
            # - ###
        }
        
    
    }catch( \Throwable $e){ TryCatcher::ddOnTryCatch($e); }
    
    
    $TGC->onENDING_DD();
    
    
    # - ### ### ###
    #   NOTE:
    
    
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######
    
    # End class
