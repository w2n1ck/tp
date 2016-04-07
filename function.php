
    function require_https_url($aim_url, $ispost = 0, $require_header = 1, $returntransfer = 1, $cookie, $add_header = array(), $post_data = "", $encoding = "gzip")
    {
        /*
        参数说明：
            $aim_url:       请求的目的网址
            $ispost:        留空或值为false时，为get请求当值为true的时候，表示此请求为post请求
            $require_header:是否请求header，**注意，目前全部请求header
            $returntransfer:true表示在请求完网页后是返回请求到的文本数据，false表示直接跳转请求的url
            $cookie:        在header中添加cookie
            $add_header:    当需要特殊的头部格式时可自行添加，eg.浏览器UA，http的安全升级
            $post_data:     当请求为post类型的时候，这里用来添加post内容，格式为string
            $encoding:      请求的编码方式，eg.gzip
        */
        $timeout = 600; 
        $require_header = 1;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $aim_url);
        curl_setopt($curl, CURLOPT_POST, $ispost);
        if($ispost){curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);}
        curl_setopt($curl, CURLOPT_HTTPHEADER, $add_header);
        curl_setopt($curl, CURLOPT_HEADER, $require_header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $returntransfer);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。https请求 不验证证书和hosts,其实主要是传输层不同，在其他地方处理起来和http请求没什么不同
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); 
        curl_setopt($curl, CURLOPT_ENCODING, $encoding);
        $data = curl_exec($curl);
        //错误控制
        if($data == false){
            $this->error("用户名密码错误");
            return array(false,false);
        }



        $info = curl_getinfo($curl);
        if (in_array('200', array(200, 302, 301),false)) {
            list($header, $body) = explode("\r\n\r\n", $data, 2);
        }
        curl_close($curl);

        return array($header, $body);
    }






     function get_student_info($username, $password){
        $t1 = microtime(true);

        $url="https://login.bit.edu.cn/cas/login?service=http://online.bit.edu.cn/leaving/shiro-cas";
        $return_data = $this->require_https_url($url);
        $body_dom = str_get_html($return_data[1]);
        $cookie = (explode("; ", explode(": ", array_slice(explode("\r\n", $return_data[0]),-2,1)[0], 2)[1], 2)[0]);

        $ticket1 = $body_dom->find('input')[4]->attr['value'];
        $body_dom->clear();//release resouces

        $post_data = "username=".$username."&password=".$password."&lt=".$ticket1."&execution=e1s1&_eventId=submit&rmShown=1";
        $add_header_array = array('User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36');

        $re_data2 = $this->require_https_url($url, 1, 1, 1, $cookie, $add_header_array, $post_data);
        $re_header_array = explode("\r\n", $re_data2[0]);

        $jump_url = substr($re_header_array[7], 10);
        $jump_data = $this->require_https_url($jump_url);

        $jump_header_array = explode("\r\n", $jump_data[0]);
        $final_url = substr($jump_header_array[5], 10);

        $img_start_time = microtime(true);
        $img_page_cookie = substr($jump_header_array[5], 43);
        $img_raw_url = "http://online.bit.edu.cn/leaving/dashboard/student";
        $img_page_data = $this->require_https_url($img_raw_url.$img_page_cookie);
        $img_page_body_dom = str_get_html($img_page_data[1]);
        $img_source = $img_page_body_dom->find('img')[0]->attr['src'];
        $img_end_time = microtime(true);

        $final_data = $this->require_https_url($final_url);
        $final_body_dom = str_get_html($final_data[1]);
        $name = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[0]->nodes[0]->_[4];
        $student_id = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[1]->nodes[0]->_[4];
        $campus = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[2]->nodes[0]->_[4];
        $final_body_dom->clear();

        dump(array($name, $student_id, $campus, $img_source));
        echo "<img src='".$img_source."' width='150' />";

        $t2 = microtime(true);
        echo "<br/>本网页执行耗时：".round($t2-$t1,3)." 秒。";
        echo "<br/>图片加载耗时：".round($img_end_time-$img_start_time, 3)."秒。";

    }


