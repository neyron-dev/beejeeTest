<div class="d-flex  align-items-center mb-4 pt-2 pb-3">
    <p class="small mb-0  me-2">Sort</p>
    
    <select name="order" class="js-sort-values" autocomplete="off">
        <?foreach ($data["fields"] as $key => $value):?>
            <option value="<?=$value;?>"><?=$data["labels"][$value];?></option>
        <?endforeach;?>
    </select>
    <a  href="#!" class="sort-button ms-2 text-white fs-4 js-sort-asc-button js-sort-button" data-sort="asc" title="Ascending">
        <i class="bi bi-sort-down-alt"></i>
    </a>
    <a  href="#!" class="sort-button ms-2 text-white fs-4 js-sort-desc-button js-sort-button" data-sort="desc" title="Descending">
        <i class="bi bi-sort-down"></i>
    </a>
    
    
</div>