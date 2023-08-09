<?php
    # - ### ### ###
    # - ### ###
    
    include 'ALL=includes/includes-BASIC.php';
    include 'GLOBAL = Settings.php';
    
	use LibMy\Ancii;
    use LibMy\Sleeper;
    use LibMy\FileJsoner;
	use LibMy\TryCatcher;
	
	# - ### ###
    # - ### ### ###
    # - ### ###
    
    include 'TGC = BEGIN = NEW OR DD.php';
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    function generateTextFor_Film_1_Basic($data)
    {
        $countryFin = '';
        if( count($data['COUNTRY_ARR']) === 1 ) $countryFin = ''.$data['COUNTRY_ARR'][0];
        if( count($data['COUNTRY_ARR']) === 2 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1];
        if( count($data['COUNTRY_ARR']) === 3 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1].', '.$data['COUNTRY_ARR'][2];
        
        $genreFin = '';
        if( count($data['GENRE_ARR']) === 1 ) $genreFin = '#'.$data['GENRE_ARR'][0];
        if( count($data['GENRE_ARR']) === 2 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1];
        if( count($data['GENRE_ARR']) === 3 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1].' #'.$data['GENRE_ARR'][2];
        
        $textStringsArr = [
            '🎬 '.$data['ABOUT_TITLE'].' 🔥',
            '',
            '📅 '.$data['ABOUT_YEAR'].' | '.$countryFin.' 🌏',
            '',
            '📌 '.$data['ABOUT_DESC_END_LAST_DOT'],
            '',
            '🏆 Рейтинг:',
            '🎩 Критики - '.$data['ABOUT_RATE_CRIT'],
            '🍿 Зрители - '.$data['ABOUT_RATE_USER'],
            '',
            '🔮 Жанр: '.$genreFin,
        ];
        
        return implode(PHP_EOL,$textStringsArr);
    }
    function generateTextFor_Film_2_Rus($data)
    {
        #$countryFin = '';
        #if( count($data['COUNTRY_ARR']) === 1 ) $countryFin = ''.$data['COUNTRY_ARR'][0];
        #if( count($data['COUNTRY_ARR']) === 2 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1];
        #if( count($data['COUNTRY_ARR']) === 3 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1].', '.$data['COUNTRY_ARR'][2];
        
        $genreFin = '';
        if( count($data['GENRE_ARR']) === 1 ) $genreFin = '#'.$data['GENRE_ARR'][0];
        if( count($data['GENRE_ARR']) === 2 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1];
        if( count($data['GENRE_ARR']) === 3 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1].' #'.$data['GENRE_ARR'][2];
        
        $textStringsArr = [
            '🎬🍿 '.$data['ABOUT_TITLE'].' ('.$data['ABOUT_YEAR'].')',
            '',
            '<i>'.$data['ABOUT_DESC_END_LAST_DOT'].'</i>',
            '',
            '🎥 Режиссер: '.$data['ABOUT_DIRECTOR'],
            '🍷 Оценка критиков: '.$data['ABOUT_RATE_CRIT'],
            '',
            ''.$genreFin,
        ];
        
        return implode(PHP_EOL,$textStringsArr);
    }
    function generateTextFor_Film_3_Mult($data)
    {
        #$countryFin = '';
        #if( count($data['COUNTRY_ARR']) === 1 ) $countryFin = ''.$data['COUNTRY_ARR'][0];
        #if( count($data['COUNTRY_ARR']) === 2 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1];
        #if( count($data['COUNTRY_ARR']) === 3 ) $countryFin = ''.$data['COUNTRY_ARR'][0].', '.$data['COUNTRY_ARR'][1].', '.$data['COUNTRY_ARR'][2];
        
        $genreFin = '';
        if( count($data['GENRE_ARR']) === 1 ) $genreFin = '#'.$data['GENRE_ARR'][0];
        if( count($data['GENRE_ARR']) === 2 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1];
        if( count($data['GENRE_ARR']) === 3 ) $genreFin = '#'.$data['GENRE_ARR'][0].' #'.$data['GENRE_ARR'][1].' #'.$data['GENRE_ARR'][2];
        
        $genreFin = str_replace('#Мультики','', $genreFin);
        $genreFin = str_replace('  ',' ', $genreFin); # Может быть двойной пробел.
        
        $textStringsArr = [
            '🌟 '.$data['ABOUT_TITLE'].' ('.$data['ABOUT_YEAR'].')',
            '',
            '📍 '.$data['ABOUT_DESC_END_LAST_DOT'].'',
            '',
            '🌏 Страна: '.$data['COUNTRY_ARR'][0],
            '🍿 Оценки зрителей: '.$data['ABOUT_RATE_USER'],
            '📅 Премьера: '.$data['DATE_RUS']['D'].'.'.$data['DATE_RUS']['M'].'.'.$data['DATE_RUS']['Y'],
            '',
            '⚜️ '.$genreFin,
        ];
        
        return implode(PHP_EOL,$textStringsArr);
    }
    function generateTextFor_Game_1($data)
    {
        /*
            "_PAGE_URL" => "https://www.chaynikam.info/Dead_Space_(2023).html"
            "_PARSE_DT" => "2023-02-10 02:16:57"
            "_NULLS_COUNT" => 0
            "IMG_COVER_URL_RAW" => "../prevgame/Dead_Space_(2023)-ver.jpg"
            "IMG_COVER_URL" => "https://www.chaynikam.info/prevgame/Dead_Space_(2023)-ver.jpg"
            "NAME" => "Dead Space (2023)"
            "GENRES_ARR" => array:4 [ …4]
            "GENRES_ARR_CNT" => 4
            "DATE_RELEASE" => "27.01.2023"
            "RATING_AGE" => "18+"
            "DEV_STUDIO" => "MOTIVE"
            "RATING" => "89"
            "DESC_ARR" => array:3 [ …3]
            "DESC_ARR_CNT" => 3
              "DESC_VIDEO" => array:3 [▼
                    0 => array:3 [▼
                      "URL_RAW" => "https://www.youtube.com/embed/ctQl9wa3ydE?rel=0"
                      "URL" => "https://www.youtube.com/watch?v=ctQl9wa3ydE"
                      "TITLE" => "Dead Space Official Launch Trailer"
            "DESC_VIDEO_CNT" => 3
              "DESC_PHOTO" => array:12 [▼
                        0 => array:2 [▼
                          "URL" => "https://www.chaynikam.info/imgames/Dead_Space_(2023)-10.jpg"
                          "RESOLUTION" => "1920x1080"
            "DESC_PHOTO_CNT" => 12
            "TTH_DISK_SPACE" => "50 GB"
        */
        
        
        $finArr = [ ];
        
        
        
        
        $finArr []= '🎮 '.$data['NAME'].' 🔥';
        $finArr []= '';
        $finArr []= '✨ '.$data['DESC_ARR'][0].'';  # Бывало вылетал из-за 0
        if( isset($data['DESC_ARR'][1]) ) $finArr []= ''.str_replace(';<br />',PHP_EOL,$data['DESC_ARR'][1]).'';
        if( isset($data['DESC_ARR'][2]) ) $finArr []= ''.str_replace(';<br />',PHP_EOL,$data['DESC_ARR'][2]).'';
        #';<br />'
        
        
        $finArr []= '';
        
        $rate = '';
        $data['RATING'] = floor($data['RATING']);
        if(  $data['RATING'] <  50 ) $rate = '⭐';
        if( ($data['RATING'] >= 50) && ($data['RATING'] < 60)) $rate = '⭐⭐';
        if( ($data['RATING'] >= 60) && ($data['RATING'] < 80)) $rate = '⭐⭐⭐';
        if( ($data['RATING'] >= 80) && ($data['RATING'] < 90)) $rate = '⭐⭐⭐⭐';
        if( ($data['RATING'] >= 90) ) $rate = '⭐⭐⭐⭐⭐';
        $finArr []= 'Рейтинг: '.$rate.' ('.$data['RATING'].') ';
        
        $finArr []= '';
        
        $finArr []= '💎 Разработчик: '.$data['DEV_STUDIO'].'';
        $finArr []= '📅 Дата выхода: '.$data['DATE_RELEASE'].'';
        
        $space = explode(' ', $data['TTH_DISK_SPACE']);
        if( count($space) === 2 )
            $finArr []= '💾 Размер: '.$space[0].'Gb ';
        
        $finArr []= '';
        
        if( $data['DESC_VIDEO_CNT'] >=1 )
        {
            $finArr []= '🎩 Трейлеры и обзоры:';
            
            if( isset($data['DESC_VIDEO'][0]['URL']) && str_contains($data['DESC_VIDEO'][0]['URL'],'youtube.com/watch') )
                $finArr []= '🔸'.' - <a href="'.$data['DESC_VIDEO'][0]['URL'].'">Первый</a>';
            
            if( isset($data['DESC_VIDEO'][1]['URL']) && str_contains($data['DESC_VIDEO'][1]['URL'],'youtube.com/watch') )
                $finArr []= '🔹'.' - <a href="'.$data['DESC_VIDEO'][1]['URL'].'">Второй</a>';
            
            if( isset($data['DESC_VIDEO'][2]['URL']) && str_contains($data['DESC_VIDEO'][2]['URL'],'youtube.com/watch') )
                $finArr []= '♦'.' - <a href="'.$data['DESC_VIDEO'][2]['URL'].'">Третий</a>';
            
            $finArr []= '';
        }
        
        
        
        
        if( $data['GENRES_ARR_CNT'] <= 0 ) dd('Жанры = 0');
        #if( $data['GENRES_ARR_CNT'] >= 5 ) dd('Жанры >=5');
        
        $genreFin = '';
        if( $data['GENRES_ARR_CNT'] === 1 ) $genreFin = '#'.$data['GENRES_ARR'][0];
        if( $data['GENRES_ARR_CNT'] === 2 ) $genreFin = '#'.$data['GENRES_ARR'][0].' #'.$data['GENRES_ARR'][1];
        if( $data['GENRES_ARR_CNT'] === 3 ) $genreFin = '#'.$data['GENRES_ARR'][0].' #'.$data['GENRES_ARR'][1].' #'.$data['GENRES_ARR'][2];
        if( $data['GENRES_ARR_CNT']  >= 4 ) $genreFin = '#'.$data['GENRES_ARR'][0].' #'.$data['GENRES_ARR'][1].' #'.$data['GENRES_ARR'][2].' #'.$data['GENRES_ARR'][3];
        
        $genreFin = str_replace('  ',' ', $genreFin); # Может быть двойной пробел.
        $genreFin = str_replace('#Онлайн игра','#Онлайн_игра', $genreFin);
        $genreFin = str_replace('#Уличные гонки','#Уличные_гонки', $genreFin);
        $genreFin = str_replace('#Воздушный бой','#Воздушный_бой', $genreFin);
        $genreFin = str_replace('#Бойснайперов','#Бой_снайперов', $genreFin);
        $genreFin = str_replace('#Формула 1','#Формула1', $genreFin);
        $finArr []= '🕹 '.$genreFin.'';
        
        
        return implode(PHP_EOL,$finArr);
    }
    
    # TODO:  Переписать на возврат асоц массива с инфой и дамп её
    function checkAllowSendOrDD($dataArr, $textFin)
    {
    
        $scheduleMaxTextLen = 1950; # TODO !!!!
        
        
        $pageUrl = $dataArr['PAGE_URL'] ?? $dataArr['_PAGE_URL'];
        
        if( in_array($pageUrl, [
            'https://www.chaynikam.info/Pathfinder_Kingmaker.html',
            'https://www.chaynikam.info/Trine_4_The_Nightmare_Prince.html',
            'https://www.chaynikam.info/Alan_Wake_Remastered.html',
            'https://www.chaynikam.info/Wasteland_3.html',
            'https://www.chaynikam.info/Far_Cry_3.html',
            'https://www.chaynikam.info/Immortals_Fenyx_Rising.html',
            'https://www.chaynikam.info/Far_Cry_New_Dawn.html',
            'https://www.chaynikam.info/Jurassic_World_Evolution_2.html',
            'https://www.chaynikam.info/Nex_Machina.html',
            'https://www.chaynikam.info/Marvels_Avengers.html',
            'https://www.chaynikam.info/ArmA_3.html',
            'https://www.chaynikam.info/Alan_Wake.html',
            'https://www.chaynikam.info/King%60s_Bounty_2.html',
            'https://www.chaynikam.info/Star_Wars_Battlefront_2_(2017).html',
            'https://www.chaynikam.info/Metro_Exodus.html',
            'https://www.chaynikam.info/Metro_Last_Light.html',
            #'',
            #'',
        ]) )
        {
            dump( Ancii::anyText('URL BAN'));
            return true;
            #dd('Забаненый URL');
        }
        
        # - ###
        
        
        Ancii::anyTextDump('LEN = '.strlen($textFin));
        # NOTE: Вылет MEDIA_CAPTION_TOO_LONG  400      1883  2122  2800  2106 1990
        # Норм  1824  1933
        
        if( strlen($textFin) >= $scheduleMaxTextLen )
        {
            
            #dd( Ancii::anyText('Too big len'));
            dump( Ancii::anyText('Too big len'));
            return true;
        }
        
        #dd($textFinal);
        
    }
    
    # - ### ###
    # - ### ### ###
    # - ### ###
    
    #   NOTE: Только ручной залив.
    
    # - ### ### ###
    #   NOTE:
    
    $DataSets_Folder = 'SCHED/';
    $groupViewsArr = [
    
        /*
        $CHATS['G-TEST'] => [
           'DATASET_DONE' => $DataSets_Folder . 'TEST = DATASET = DONE.json', #
           'DATASET_WAIT' => $DataSets_Folder . 'TEST = DATASET = WAIT.json', #
             'DATES_DONE' => $DataSets_Folder . 'TEST = DATES = DONE.json', #
             'DATES_WAIT' => $DataSets_Folder . 'TEST = DATES = WAIT.json', #
           'PEER' => $CHATS['G-TEST'], #
        ], # */
        
         /*
        $CHATS['G-KINO-1'] => [
            'DATASET_DONE' => $DataSets_Folder . 'G-KINO-1-BASIC = DATASET = DONE.json', #
            'DATASET_WAIT' => $DataSets_Folder . 'G-KINO-1-BASIC = DATASET = WAIT.json', #
              'DATES_DONE' => $DataSets_Folder . 'G-KINO-1-BASIC = DATES = DONE.json', #
              'DATES_WAIT' => $DataSets_Folder . 'G-KINO-1-BASIC = DATES = WAIT.json', #
            'PEER' => $CHATS['G-KINO-1'], #
        ], # */
        
         /*
        $CHATS['G-KINO-2'] => [
            'DATASET_DONE' => $DataSets_Folder . 'G-KINO-2-RUS = DATASET = DONE.json', #
            'DATASET_WAIT' => $DataSets_Folder . 'G-KINO-2-RUS = DATASET = WAIT.json', #
              'DATES_DONE' => $DataSets_Folder . 'G-KINO-2-RUS = DATES = DONE.json', #
              'DATES_WAIT' => $DataSets_Folder . 'G-KINO-2-RUS = DATES = WAIT.json', #
            'PEER' => $CHATS['G-KINO-2'], #
        ], # */
        
         /*
        $CHATS['G-KINO-3'] => [
            'DATASET_DONE' => $DataSets_Folder . 'G-KINO-3-MULT = DATASET = DONE.json', #
            'DATASET_WAIT' => $DataSets_Folder . 'G-KINO-3-MULT = DATASET = WAIT.json', #
              'DATES_DONE' => $DataSets_Folder . 'G-KINO-3-MULT = DATES = DONE.json', #
              'DATES_WAIT' => $DataSets_Folder . 'G-KINO-3-MULT = DATES = WAIT.json', #
            'PEER' => $CHATS['G-KINO-3'], #
        ], # */
        
         /*
        $CHATS['G-GAME-1'] => [
            'DATASET_DONE' => $DataSets_Folder . 'G-GAME-1 = DATASET = DONE.json', #
            'DATASET_WAIT' => $DataSets_Folder . 'G-GAME-1 = DATASET = WAIT.json', #
              'DATES_DONE' => $DataSets_Folder . 'G-GAME-1 = DATES = DONE.json', #
              'DATES_WAIT' => $DataSets_Folder . 'G-GAME-1 = DATES = WAIT.json', #
            'PEER' => $CHATS['G-GAME-1'], #
        ], # */
        
    ];
    
    # - ### ### ###
    #   NOTE:
    
    
    #dd( $groupViewsArr );
    #$a = 1;
    # - ### ### ###
    #   NOTE:
    
	# NOTE:
    #dd('От случайного, массивы закомменчены, лить по одному');
    
    $test_maxCount = 100;
    
    
    try {
        # - ###
        #$scheduleLimit = 10;
        $scheduleLimit = 100;
        $scheduleWaitTimeSec = 1;
        
        foreach( $groupViewsArr as $k => $groupSettings )
        {
            # - ###
            echo '<br><br><hr color="red">';
            
            $TGC->setConfig_Chat($groupSettings['PEER']);
            
            # - ###
            
            
            # - ###
            
            foreach( range(1,999) as $i )
            {
                # - ###
                echo '<br><br><hr color="red">';
                dump("Группа: $k  =>  I: $i");
                # - ###
                
                if( $i-1 === $test_maxCount )
                {
                    dd("I = $i = dd");
                }
                
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
                
                # Чтение - Датасет
                $DS_Data_ALL = FileJsoner::getBase_FullAsArray($groupSettings['DATASET_WAIT']);
                
                # Чтение - Даты
                $DS_Time_ALL = FileJsoner::getBase_FullAsArray($groupSettings['DATES_WAIT']);
                
                # - ###
                
                # Проверки что не кончились
                if( count($DS_Data_ALL) === 0 ) dd('Кончились неотправленные датасеты');
                if( count($DS_Time_ALL) === 0 ) dd('Кончились неотправленные время постов');
                
                # - ###
                
                # Берем рандомный
                
                $DS_Data_Key = array_rand($DS_Data_ALL);
                $DS_Data_Val = $DS_Data_ALL[$DS_Data_Key];
                
                
                $DS_Time_Key_T = array_key_first($DS_Time_ALL);
                $DS_Time_Val_U = current($DS_Time_ALL);
                
                if( ! empty( $DS_Data_Val['TG_SENDED'] ) ) # Устаревшее, в фильмах.
                {
                    dump('Есть ключ TG_SENDED, значит уже заливал - пропускаю');
                    continue;
                    # TODO: Вырезать и убратьв Done
                }
                
                # - ###
                
                dump($DS_Data_Key, $DS_Data_Val);
                
                # - ###
                
                $post_DT_T = $DS_Time_Key_T;
                $post_DT_U = $DS_Time_Val_U;
                
                dump("$post_DT_T => $post_DT_U");
                
                #dd($DS_Data);
                
                switch($groupSettings['PEER'])
                {
                    case $CHATS['G-TEST']:
                    case $CHATS['G-GAME-1']:
                        $post_Text = generateTextFor_Game_1($DS_Data_Val);
                        $post_ImgUrl = $DS_Data_Val['IMG_COVER_URL'];
                        break;
                    case $CHATS['G-KINO-1']:
                        $post_Text = generateTextFor_Film_1_Basic($DS_Data_Val);
                        $post_ImgUrl = $DS_Data_Val['IMG']['URL'];
                        break;
                    case $CHATS['G-KINO-2']:
                        $post_Text = generateTextFor_Film_2_Rus($DS_Data_Val);
                        $post_ImgUrl = $DS_Data_Val['IMG']['URL'];
                        break;
                    case $CHATS['G-KINO-3']:
                        $post_Text = generateTextFor_Film_3_Mult($DS_Data_Val);
                        $post_ImgUrl = $DS_Data_Val['IMG']['URL'];
                        break;
                    default: dd('Дефолт свитча по пирам');
                }
                
                
                dump($post_ImgUrl, $post_Text);
                #dd();
                
                
                # - ###
                
                #dd($DS_Data);
                echo "<br><a href='$post_ImgUrl' target='_blank'>$post_ImgUrl</a>";
                
                $pageUrl = $DS_Data_Val['PAGE_URL'] ?? $DS_Data_Val['_PAGE_URL'] ?? 'NULL';
                echo "<br><a href='".$pageUrl."' target='_blank'>".$pageUrl."</a>";
                
                # - ###
                
                # Проверка и решение - отправлять или нет.
                $r = checkAllowSendOrDD( $DS_Data_Val , $post_Text );
                
                if( $r === true )
                {
                    dump('Скипаю',$pageUrl);
                    continue;
                }
                
                # - ###
                
                # Залив
                dump('Отправляю'); flush();
                $TGC->api_msgSend_Any($post_Text,$post_DT_U,$post_ImgUrl);
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
                
                # - ###
                
                # Датасет успех = Дописываю
                FileJsoner::action_addByKey($groupSettings['DATASET_DONE'],$DS_Data_Val);
                
                # Дата успех = Дописываю
                FileJsoner::action_addByKey($groupSettings['DATES_DONE'],$DS_Time_Val_U,$DS_Time_Key_T);
                
                
                # Даты успех = Чтение / Склейка / Запись
                #$DS_Done_Time = getAsArray($groupSettings['DATES_DONE']);
                #$DS_Done_Time[$DS_Time_Key_T]= $DS_Time_doned_U;
                #FileJsoner::action_writeArray($groupSettings['DATES_DONE'],$DS_Done_Time);
                
                # - ###
                #$a = current($DS_Time);
                # Удаление+Запись без = Датасет
                FileJsoner::action_deleteKey($groupSettings['DATASET_WAIT'],$DS_Data_Key);
                
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
