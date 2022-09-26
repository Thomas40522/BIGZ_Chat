<?php

    function prep_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = addslashes($data);
        return $data;
    }

    function block_content($data){
        $block_list = ['fuck','shit','idiot','bitch','asshole','suck','ass hole','dick','pussy','操','屌','你全家','f u','他妈','你妈','母狗','顶你个肺','','妈的','傻逼','porn','xvideo','打飞机','jerk','masturbat','sex','wank','prostitute','damn','piss','cock','cunt','nigger','chink','chong','nigga','horny','genitle','anal','boob','penis','hentai','testicle','thesun.co.uk','vine.co'];
        foreach($block_list as $word){
            $data = str_ireplace($word, "*", $data);
        }
        return $data;
    }

    function check_email($email){
        // $allowed_domains = ['outlook.com','basisinternational-gz.com','basisinternationalgz.com','163.com','qq.com','yahoo.com','hotmail.com','gmail.com'];
        $allowed_domains = ['basisinternational-gz.com','basisinternationalgz.com'];
        $parts = explode('@',$email);
        $domain = array_pop($parts);
        // return true;
        return in_array($domain, $allowed_domains);
    }
    
    function restore($data){
        $data = str_replace('<br />', '', $data);
        $data = str_ireplace('&nbsp',' ', $data);
        return $data;
    }
?>