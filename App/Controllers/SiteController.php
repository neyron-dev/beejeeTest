<?

namespace App\Controllers;

use App\Components\PaginatorComponent;
use App\Components\SortComponent;
use App\Models\TodoModel;
use Framework\ActiveProvider;
use Framework\Controller;
use Framework\NotFoundException;
use Framework\Request;

class SiteController extends Controller
{

    public function actionIndex()
    {
        

        $pageSize = 3;
        $providerResult = (new ActiveProvider(
            TodoModel::find(),
            $pageSize
        ))->getResult();

    
        if (empty($providerResult->getModels())) {
            throw new NotFoundException("Page not found"); 
        }

        $sortComponent = SortComponent::include([
            "fields" => TodoModel::sortableFields(),
            "labels" => TodoModel::fieldLabels()
        ]);

        $paginatorComponent = PaginatorComponent::include([
            "providerResult" => $providerResult,
        ]);

        return $this->render("index", [
            "items" => $providerResult->getModels(),
            "paginatorComponent" => $paginatorComponent,
            "sortComponent" => $sortComponent
        ]);
    }

    public function actionView($id)
    {
        echo $id;
        return "viewPage";
    }
}
