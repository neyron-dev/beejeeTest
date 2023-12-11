<nav class="mt-2">
    <ul class="pagination justify-content-end">
        <? if ($showPreviousPageFlag) : ?>
            <li class="page-item ">
                <a class="page-link" href="<?= $previousPageUrl; ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
        <? endif; ?>
        <li class="page-item disabled"><a class="page-link" href="#">1</a></li>
        <? if ($showNextPageFlag) : ?>
            <li class="page-item">
                <a class="page-link" href="<?=$nextPageUrl;?>">Next</a>
            </li>
        <? endif; ?>
        
    </ul>
</nav>