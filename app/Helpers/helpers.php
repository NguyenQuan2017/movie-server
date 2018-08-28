<?php
    function response_success($data = [], $msg = 'everything is ok', $status = 200, $note = 'custom response success')
    {
        return response(
            [
                'status' => $status,
                'statusText' => 'OK',
                'data' => $data,
                'message' => $msg,
                'note' => $note
            ]


        );
    }

    function response_error($data = [], $msg = 'something went wrong', $status = 400, $note = 'custom response error')
    {
        return response(
            [
                'status' => $status,
                'statusText' => 'ERROR',
                'data' => $data,
                'message' => $msg,
                'note' => $note
            ]
        );
    }

    function faker() {
        $faker = \Faker\Factory::create();

        return $faker;
    }

    function imageDirectory()
    {
        $path = 'public/images/';

        $imageDir = storage_path('app/') . $path ;
        File::makeDirectory($imageDir, 0777, true, true);

        return $path;
    }

    function decodeImageBase64($file) {
        @list($type, $file_data) = explode(';', $file);
        @list(, $file_data) = explode(',', $file_data);
        $type_explode = explode("/", $type);
        try{
            $extension = $type_explode[1];
            $data = base64_decode($file_data);
            return collect([
                'type' => $type,
                'data' => $data,
                'extension' => $extension
            ]);
        }catch (Exception $e){}

    }

    function convertStringToArray($str) {
        $array = explode(",", $str);
        return $array;
    }

    function slugify($string, $replace = array(), $delimiter = '-')
    {
        if (!extension_loaded('iconv')) {
            throw new Exception('iconv module not loaded');
        }
        // Save the old locale and set the new locale to UTF-8
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        if (!empty($replace)) {
            $clean = str_replace((array) $replace, ' ', $clean);
        }
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        // Revert back to the old locale
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }

    function getFileTypeVideo($url){
        if (preg_match('/^.*\.(mp4|mov|mpg|mpeg|wmv|mkv)$/i', $url, $mine))
        {
            switch ($mine[1])
            {
                case 'mp4' :
                    $type = 'video/mp4';
                    break;
                case 'mov':
                    $type = 'video/mov';
                    break;
                case 'mpg':
                    $type = 'video/mpg';
                    break;
                case 'mpeg':
                    $type = 'video/mpeg';
                    break;
                case 'wmv':
                    $type = 'video/wmv';
                    break;
                case 'mkv':
                    $type = 'video/mkv';
                    break;
            }
            return $type;
        }
    }
    function curl($url) {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }

    function getPhotoGoogle($link){
        $get = curl($link);
        $data = explode('url\u003d', $get);
        $url = explode('%3Dm', $data[1]);
        $decode = urldecode($url[0]);
        $count = count($data);
        $results = [
            [
                'label' => '',
                'type' => 'video/mp4',
                'file' => ''
            ],
            [
                'label' => '720p',
                'type' => 'video/mp4',
                'file' => ''
            ],
            [
                'label' => '360p',
                'type' => 'video/mp4',
                'file' => ''
            ]
        ];

        if($count > 7 && $count <= 9) {
            $v1080p = $decode.'=m37';
            $v720p = $decode.'=m22';
            $v360p = $decode.'=m18';
            $results[0]['file'] = $v1080p;
            $results[1]['file'] = $v720p;
            $results[2]['file'] = $v360p;

        }
        if($count > 2) {
            $v720p = $decode.'=m22';
            $v360p = $decode.'=m18';

            $results[1]['file'] = $v720p;
            $results[2]['file'] = $v360p;
        }
        if($count > 1) {
            $v360p = $decode.'=m18';
            $results[2]['file'] = $v360p;

        }
        return $results;
    }

