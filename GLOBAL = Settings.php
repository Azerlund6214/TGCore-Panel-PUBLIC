<?php
    # - ### ### ###
    
	# Папка \\ имя всех файлов
	$TGC_SESS_PATH = 'SESSION = USER = MAIN REAL\\session.madeline';
	
    # - ### ### ###
    #   NOTE:
    
    $CHATS = [
        'MY_LOGS' => '-123123123', # TG Core - Логи
        
        'U-RANDOM-REAL-1'   => '1831513702', #
        'U-RANDOM-REAL-2'   => '5795789130', #
        'U-RANDOM-REAL-3'   => '5927210193', #
        'U-123'  => '123123123', #
        
        'B-GREEN'  => '@GreenLike_robot', # Бот накрутки
        'B-GREEN-ID'=> '1963696978', # Бот накрутки
        
        'G-TEST'   => '-123123123', # Тест группа оформления =>  =>
        'G-KOSMOS' => '-123123123', #  =>  =>
        
        'G-KINO-1' => '-123123123', # Кино-1 
        'G-KINO-2' => '-123123123', # Кино-2 =>
        'G-KINO-3' => '-123123123', # Кино-3 =>
        'G-GAME-1' => '-123123123', # Игры-1 =>
        
        'G-PROGREV-1' => '-123123123', #
        'G-PROGREV-2' => '-123123123', #
        'G-PROGREV-3' => '-123123123', #
        'G-PROGREV-4' => '-123123123', #
        'G-PROGREV-5' => '-123123123', #
        'G-PROGREV-6' => '-123123123', #
        'G-PROGREV-7' => '-123123123', #
        'G-PROGREV-8' => '-123123123', #
        'G-PROGREV-9' => '-123123123', #
        'G-PROGREV-10'=> '-123123123', #
        '' => '', #
    ];
    
    # - ### ### ###
    #   NOTE:
    
    $tasksPath_ALL  = 'TGC = TASKS v2 = ALL.json';
    
    
    
    #$tasksPath_ALL  = 'Tasks = ALL.json';
    #$tasksPath_New  = 'Tasks = New.json';
    #$tasksPath_Err  = 'Tasks = Error.json';
    #$tasksPath_Done = 'Tasks = Done.json';
    
    
    # - ### ### ###
    #   NOTE: ПАНЕЛЬ
    
    $OPT_PANEL__LOG_PathOrdersJson = 'TGC = PANEL VIEW = v2 = ORDERS.json';
    $OPT_PANEL__LOG_PathRequests   = 'TGC = PANEL VIEW = v2 = REQUESTS.txt';
    
    $OPT_PANEL__SMM_API_KEY = ''; # Чика, реал.
    $OPT_PANEL__SMM_API_KEY = '123123123'; # Мой, реал.
    
    
    
    $OPT_PANEL__TGC_API_MODE = 'USER'; # USER || BOT   # NOTE: Ставить руками
    
    
    $OPT_PANEL__LastPostsCount = 4; # Сколько последних постов брать
    
    
    
    
    
    $OPT_PANEL__ServiceArr = [  # Юзается только номер.
        'VIEW_FAST'     => [ 'S_NUM'=>'708' , 'ORDER_MIN'=>100, 'PRICE_1k' => 0.3 ],
        'VIEW_SMOOTH_2' => [ 'S_NUM'=>'854' , 'ORDER_MIN'=>50 , 'PRICE_1k' => 3.0 ],
        'VIEW_SMOOTH_5' => [ 'S_NUM'=>'858' , 'ORDER_MIN'=>50 , 'PRICE_1k' => 3.0 ],
        # 857-10  856-20
    ];
    
    
    $OPT_PANEL__GROUPS_ARR_ALL = [
        # Какие группы будем проверять.   Все детали внутри класса.
        'MY' => [
            $CHATS['G-KINO-1'] => [ 'STATIC_COUNT' => 1100, 'STATIC_RANDOM' => [-70,100] ],
            $CHATS['G-KINO-2'] => [ 'STATIC_COUNT' => 1100, 'STATIC_RANDOM' => [-70,100] ],
            $CHATS['G-KINO-3'] => [ 'STATIC_COUNT' => 1100, 'STATIC_RANDOM' => [-70,100] ],
            $CHATS['G-GAME-1'] => [ 'STATIC_COUNT' => 1100, 'STATIC_RANDOM' => [-70,100] ],
        ],
        'CHI' => [
            $CHATS['G-CHI-1'] => [ 'STATIC_COUNT' => 1800, 'STATIC_RANDOM' => [-150,100] ],
            $CHATS['G-CHI-2'] => [ 'STATIC_COUNT' => 1050, 'STATIC_RANDOM' => [-40,100] ],
            $CHATS['G-CHI-3'] => [ 'STATIC_COUNT' => 1050, 'STATIC_RANDOM' => [-40,100] ],
            $CHATS['G-CHI-4'] => [ 'STATIC_COUNT' => 1050, 'STATIC_RANDOM' => [-40,100] ],
            $CHATS['G-CHI-5'] => [ 'STATIC_COUNT' =>  950, 'STATIC_RANDOM' => [-50,50] ],
        ],
        
    ];
    
    $OPT_PANEL__GROUPS_ARR = $OPT_PANEL__GROUPS_ARR_ALL['MY'];
    
    
    
    # - ### ### ###
    #   NOTE:
	
	
	
    
    # - ### ### ###
    #   NOTE:
    
    
    
    # - ##### ##### ##### ##### ##### ##### ######
    # - #####             #####             ######
    # - ##### ##### ##### ##### ##### ##### ######
    
    # End class
