<?php 

    // Получение IP пользователя 
    function getClientIP():string {
        $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
        foreach($keys as $k)
        {
            if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
            {
                return $_SERVER[$k];
            }
        }
        return "Неопределён";
    }

    // Получение браузера пользователя 
    function getClientBrowser() {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        
        if (strpos($user_agent, "Firefox") !== false) {
            $browser = "Firefox";
        } elseif (strpos($user_agent, "Opera") !== false || strpos($user_agent, "OPR") !== false) {
            $browser = "Opera"; 
        } elseif (strpos($user_agent, "Edg") !== false) {
            $browser = "Microsoft Edge";
        } elseif (strpos($user_agent, "YaBrowser") !== false) {
            $browser = "Яндекс Браузер";
        } elseif (strpos($user_agent, "MSIE") !== false || strpos($user_agent, "Trident") !== false) {
            $browser = "Internet Explorer";
        } elseif (strpos($user_agent, "Chrome") !== false) {
            $browser = "Chrome";
        } elseif (strpos($user_agent, "Safari") !== false) {
            $browser = "Safari"; 
        } else {
            $browser = "Неизвестный";
        }
        return $browser;
    }
    
    
    // Сортировка
    function sort_link_th($title, $a, $b) {
        $sort = @$_GET['sort'];
     
        if ($sort == $a) {
            return '<a class="active" href="?sort=' . $b . '">' . $title . ' <i>▲</i></a>';
        } elseif ($sort == $b) {
            return '<a class="active" href="?sort=' . $a . '">' . $title . ' <i>▼</i></a>';  
        } else {
            return '<a href="?sort=' . $a . '">' . $title . '</a>';  
        }
    }

    //  Все варианты сортировки 
    $sort_list = array(
        'username_asc'   => '`username`',
        'username_desc'  => '`username` DESC',
        'email_asc'  => '`email`',
        'email_desc' => '`email` DESC',
        'date_asc'   => '`date`',
        'date_desc'  => '`date` DESC',
    );
    
    //  Проверка GET-переменной для сортировки
    $sort = @$_GET['sort'];
    if (array_key_exists($sort, $sort_list)) {
        $sort_sql = $sort_list[$sort];
    } else {
        $sort_sql = "`message`.`date` DESC";
    }

    // Генератор рандомных значений
    function random_number($length = 5)
    {
        $arr = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );
    
        $res = '';
        for ($i = 0; $i < $length; $i++) {
            $res .= $arr[random_int(0, count($arr) - 1)];
        }
        return $res;
    }

    // Простая устаревшая кодировка. ИСК: Для администратора
    function OnCoding($text)
	{
		return base64_encode($text);      
	}
	function OnEncoding($text)
	{        
		return base64_decode($text);
	}
    
?>