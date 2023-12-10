<?php
/**
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 */
?>

<tr>
    <td style="width: 200px;">
        <img width="50" src="<?php echo $storage->url($movie->preview()) ?>" alt="<?php echo $movie->name() ?>">
    </td>
    <td style="width: 200px;"><?php echo $movie->name() ?></td>
    <td><span class="badge bg-warning warn__badge"><?php echo substr($movie->description(), 0, 51)?>...</span></td>
    <td>
        <div class="dropdown d-flex justify-content-end">
            <button class="dropbtn ">Действия</button>
            <div class="dropdown-content">
                <a class="btn btn-warning w-100 d-flex" href="/admin/movies/update?id=<?php echo $movie->id() ?>">Изменить</a>
                <form action="/admin/movies/destroy" method="post">
                    <input type="hidden" value="<?php echo $movie->id() ?>" name="id">
                    <button class="btn btn-warning w-100" type="submit">Удалить</button>
                </form>
            </div>
        </div>
    </td>
</tr>