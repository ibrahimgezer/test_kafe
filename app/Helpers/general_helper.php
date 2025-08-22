<?php

/**
 * @throws Exception
 */
function get_panel_save_path(): string
{
    // XAMPP/WAMP için local yol
    $localPath = "C:/xampp/htdocs/web_kafe_otomasyon/public/backend/assets/images";

    // Sunucu yolu
    $serverPath = __DIR__ . "/../../../web_kafe_otomasyon/public/backend/assets/images";

    $absolutePath = is_dir($localPath) ? $localPath : realpath($serverPath);

    if ($absolutePath === false) {
        throw new Exception("Panel assets klasörü bulunamadı!");
    }

    return str_replace('\\', '/', rtrim($absolutePath, '/\\')) . '/';
}

function get_panel_image_url($filename): string
{
    // Local geliştirme ortamı kontrolü
    if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '192.168.1.27') {
        return 'http://192.168.1.27/web_kafe_otomasyon/' . ltrim($filename, '/');
    }

    // Canlı sunucu yolu
    return get_panel_save_path();
}



if (!function_exists('edited_var_dump')) {
    function edited_var_dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}