<div class="unit_admin">
    <div class="img_admin">{img_admin}</div>
    <div class="name_admin">{name_admin}</div>
    <div class="wrap_unit_admin">
        <form class="edit_admin" action="edit.php" method="POST">
            <input type="hidden" name="id" value="{id}">
            <input type="hidden" name="category" value="{category}">
            <input type="submit" class="edit_btn_admin" value="Редактировать">
        </form>
        <form class="del_admin" action="../php/server_confirm.php" method="POST">
            <input type="hidden" name="id" value="{id}">
            <input type="submit" class="edit_btn_admin" value="Удалить">
        </form>
    </div>
</div>
