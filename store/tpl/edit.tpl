<div class="unit_edit">
    <p>Малая картинка сейчас:</p>
    <div class="img_edit">
        {img_dir_filename}
    </div>
    <p>Большая картинка сейчас:</p>
    <div class="img_max_edit">
        {img_max_dir_filename}
    </div>
    <form action="../php/server_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{id}">
        <input type="hidden" name="filename" value="{filename}">
        <input type="hidden" name="filename_max" value="{filename_max}">
        <input type="hidden" name="category" value="{category}">
        <p>Выберите новую МАЛУЮ картинку:<br>Рекомендуемое разрешение 512х384 !</p>
        <input type="file" name="img_file" accept="image/*">
        <p>Выберите новую БОЛЬШУЮ картинку:<br>Рекомендуемое разрешение 1920х1080 !</p>
        <input type="file" name="img_max_file" accept="image/*">
        <p>Имя товара:</p>
        <input class="name_edit" type="text" name="name" value="{name}">
        <p>Короткое описание товара:</p>
        <textarea class="info_short_edit" name="info_short">{info_short}</textarea>
        <p>Полное описание товара:</p>
        <textarea class="info_full_edit" name="info_full">{info_full}</textarea>
        <p>Цена товара:</p>
        <input class="price_edit" type="text" name="price" value="{price}">
        <p>Категория товара:</p>