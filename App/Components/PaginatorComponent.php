<?

namespace App\Components;

use Framework\ActiveProviderResult;
use Framework\Component;
use Framework\Router;
use Framework\UrlGenerator;

class PaginatorComponent extends Component
{
    protected $template = "paginator";

    public static function include($data, ?string $template = null)
    {
        $dataResult = [
            "showPreviousPageFlag" => true,
            "previousPageUrl" => "",
            "showNextPageFlag" => true,
            "nextPageUrl" => ""
        ];
        if (empty($data["providerResult"])) {
            throw new \InvalidArgumentException("providerResult must be set in PaginatorComponent");
        }
        /**
         * @var ActiveProviderResult $providerResult;
         */
        $providerResult = $data["providerResult"];
        if ($providerResult->getCurrentPage() == 1) {
            $dataResult["showPreviousPageFlag"] = false;
        } else {
            $dataResult["previousPageUrl"] = (new UrlGenerator(Router::getInstance()->getRoutes()))
                ->generate("index_page", [], ["page" => $providerResult->getCurrentPage() - 1]);
        }
        
        if ($providerResult->getCurrentPage() == $providerResult->getPages()) {
            $dataResult["showNextPageFlag"] = false;
        } else {
            $dataResult["nextPageUrl"] = (new UrlGenerator(Router::getInstance()->getRoutes()))
                ->generate("index_page", [], ["page" => $providerResult->getCurrentPage() + 1]);
        }


        return parent::include($dataResult, $template);
    }
}
