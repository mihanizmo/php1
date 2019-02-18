<?
// Создать галерею фотографий. Она должна состоять из одной страницы, на которой пользователь видит все картинки в уменьшенном виде. При клике на фотографию она должна открыться в браузере в новой вкладке. Размер картинок можно ограничивать с помощью свойства width.
// Cтроить фотогалерею, не указывая статичные ссылки к файлам, а просто передавая в функцию построения адрес папки с изображениями. Функция сама должна считать список файлов и построить фотогалерею со ссылками в ней.

// Прописываем пути до папки
$dirBig = "images/img_big";
$dirSmall = "images/img_small";

// Убираем лишние файлы из массива
$filesBig = array_slice(scandir($dirBig), 2);
$filesSmall = array_slice(scandir($dirSmall), 2);
?>

    <html>

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body>

        <div class="img">
            <? for ($i=0; $i<count($filesSmall); $i++) { ?>
                <a href="<?=$dirBig."/".$filesBig[$i]?>" target="_blank">
                    <img src="<?=$dirSmall."/".$filesSmall[$i]?>">
                </a>
            <? } ?>
        </div>

    </body>

    </html>
