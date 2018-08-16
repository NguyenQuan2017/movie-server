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
        $extension = $type_explode[1];
        $data = base64_decode($file_data);
        return collect([
            'type' => $type,
            'data' => $data,
            'extension' => $extension
        ]);
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