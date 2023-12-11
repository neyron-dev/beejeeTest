<div class="card p-4 text-white">
    <h1 class="mb-3">Todo List</h1>
    <?= $sortComponent; ?>
    
    <div class="todolist ">
        <div class="todolist__header">
            <div class="row">
                <div class="col-auto todolist__item-col">
                    <div class="form-check "></div>
                </div>
                <div class="col">
                    <div class="row todolist__header-cols">
                        <div class="col todolist__header-col">
                            Name
                        </div>
                        <div class="col todolist__header-col">
                            Email
                        </div>
                        <div class="col todolist__header-col">
                            Task
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <? foreach ($items as $item) : ?>
            <label class="todolist__item js-todo-item">
                <div class="row">
                    <div class="col-auto todolist__item-col">
                        <div class="form-check">
                            <input class="form-check-input" name="todo" type="checkbox" <?= $item->status ? 'checked=""' : "" ?> autocomplete="off">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row todolist__item-cols">
                            <div class="col todolist__item-col">
                                <?= $item->name; ?>
                            </div>
                            <div class="col todolist__item-col">
                                <?= $item->email; ?>
                            </div>
                            <div class="col todolist__item-col">
                                <?= $item->task; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </label>
        <? endforeach; ?>


    </div>
</div>

<?= $paginatorComponent; ?>