<?php
/**
 * @var \App\Models\Category $category
 */
?>

<tr>
    <td style="width: 200px; height:100px"><?php echo $category->name() ?></td>
    <td>
        <div class="dropdown d-flex justify-content-end">
            <button class="dropbtn">Действия</button>
            <div class="dropdown-content">
                <a class="btn btn-warning w-100 d-flex" href="/admin/categories/update?id=<?php echo $category->id() ?>">Изменить</a>
                <form action="/admin/categories/destroy" method="post">
                    <input type="hidden" value="<?php echo $category->id() ?>" name="id">
                    <button class="btn btn-warning w-100 d-flex" type="submit">Удалить</button>
                </form>
            </div>
        </div>
    </td>
</tr>
