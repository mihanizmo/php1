<?
// функция для транслитерации имени загружаемого файла в латиницу
function translit($string) {
      $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'ъ' => '', 'ь' => '', 'э' => 'eh', 'ю' => 'yu', 'я'=>'ya');

      return str_replace(' ', '_', strtr(mb_strtolower(trim($string)), $translit));
}

// функция взята из интернета, она принимает параметры файла высоту, ширину, источник, новый источник, тип файла, и в зависимости от типа файла делает уменьшенную копию картинки
function changeImage($h, $w, $src, $newsrc, $type) {
    $newimg = imagecreatetruecolor($h, $w);
    switch ($type) {
      case 'jpeg':
        $img = imagecreatefromjpeg($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagejpeg($newimg, $newsrc);
        break;
      case 'png':
        $img = imagecreatefrompng($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagepng($newimg, $newsrc);
        break;
      case 'gif':
        $img = imagecreatefromgif($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagegif($newimg, $newsrc);
        break;
    }
}

// При загрузке картинки выполняется условие, если есть ошибки при загрузке - выдается сообщение об ошибке, иначе-если размер превышает 1 000 000 байт, то выдается сообщение об ошибке, иначе-если тип файла или jpeg или png или gif - выполняется условие: копируется файл из временного места загрузки в указанную нами папку с картинками в нормальном размере с приминением транслитерации названия, задаем $path как наименование файла и директорию для перемещения уменьшенной копии картинки, задаем $type - преобразуем путь в массив и берем второй (1) элемент - расширение, далее отправляем в функцию изменения размера наш файл из временной загрузки с необходимыми параментрами - и уменьшенная копия картинки кладется в указанную папку, иначе выходит сообщение ошибки, и иначе выходит сообщение ошибки.
if (isset($_POST['send'])) {
    if ($_FILES['userfile']['error']) {
      $message = 'Ошибка загрузки файла!';
    } elseif ($_FILES['userfile']['size'] > 1000000) {
      $message = 'Файл слишком большой';
    } elseif (
        $_FILES['userfile']['type'] == 'image/jpeg'||
        $_FILES['userfile']['type'] == 'image/png' ||
        $_FILES['userfile']['type'] == 'image/gif'
      ) {
          if (copy($_FILES['userfile']['tmp_name'], PHOTO_BIG.translit($_FILES['userfile']['name']))) {
            $path = PHOTO_SMALL.translit($_FILES['userfile']['name']);
            $type = explode('/', $_FILES['userfile']['type'])[1];
            changeImage(150, 150, $_FILES['userfile']['tmp_name'], $path, $type);
          } else {$message = 'Ошибка загрузки файла!';}
      } else {
        $message = 'Неправильный тип файла!';
    }
  }

// сканируется папка photo_small и первые системные 2 файла не берутся в массив $images
$images = array_slice(scandir(PHOTO_SMALL), 2);