<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Psr\Log\LoggerInterface;
use Random\RandomException;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [
        "form", "url", "date", "text", "cookie", "html", "custom", "icons", "general"
    ];
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;
    protected $userModel;
    protected $customerModel;
    protected $subscriberModel;
    protected $supportTicketModel;
    protected $supportTicketMessageModel;
    protected $supportTicketImageModel;
    protected $cafeModel;
    protected $staffModel;
    protected $shiftModel;
    protected $floorModel;
    protected $tableModel;
    protected $qrModel;
    protected $categoryModel;
    protected $categoryImageModel;
    protected $productModel;
    protected $productImageModel;
    protected $cartModel;
    protected $orderModel;
    //////////////////////////
    protected $dbConfig;
    /////////////////////////
    protected $controllerName;
    protected $methodName;
    /////////////////////////
    protected $db;
    protected $DBUsername;
    protected $DBPassword;
    protected $DBName;
    /////////////////////////
    protected $loggedUser;
    protected $loggedSubscriber;
    /////////////////////////
    protected $stableSessionId;
    protected $globalVars = [];

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $currentUrl = current_url();
        set_cookie('previous_url', $currentUrl, 3600);

        $router = service('router');
        $this->db = Database::connect();

        $dbConfig = config('Database');
        if (isset($dbConfig->default['username'])) {
            $this->DBUsername = $dbConfig->default['username'];
        }
        if (isset($dbConfig->default['password'])) {
            $this->DBPassword = $dbConfig->default['password'];
        }
        if (isset($dbConfig->default['database'])) {
            $this->DBName = $dbConfig->default['database'];
        }

        $controllerName = explode("\\", $router->controllerName());
        $this->controllerName = $controllerName[count($controllerName) - 1];
        $this->methodName = $router->methodName();

        //$this->tokenBlacklistModel = model("TokenBlacklistModel");
        $this->userModel = model("UserModel");
        $this->customerModel = model("CustomerModel");
        $this->subscriberModel = model("SubscriberModel");
        $this->supportTicketModel = model("SupportTicketModel");
        $this->supportTicketMessageModel = model("SupportTicketMessageModel");
        $this->supportTicketImageModel = model("SupportTicketImageModel");
        $this->cafeModel = model("CafeModel");
        $this->staffModel = model("StaffModel");
        $this->shiftModel = model("ShiftModel");
        $this->floorModel = model("FloorModel");
        $this->tableModel = model("TableModel");
        $this->qrModel = model("QRCodeModel");
        $this->categoryModel = model('MenuCategoryModel');
        $this->categoryImageModel = model('MenuCategoryImageModel');
        $this->productModel = model('MenuProductModel');
        $this->productImageModel = model('MenuProductImageModel');

        $this->orderModel = model("OrderModel");

        if (!empty(session()->get('loggedUser'))) {
            $this->loggedUser = $this->userModel->where('id', session()->get('loggedUser')["id"])->first();
            $this->loggedSubscriber = [];
            if ($this->loggedUser["subscriber_id"] != "*") {
                $this->loggedSubscriber = $this->subscriberModel->where('id', $this->loggedUser["subscriber_id"])->first();
            }
        }

       /* $qrCode = session()->get('qrCode');
        if ($qrCode) {
            var_dump($qrCode);
            exit();
            $qrData = $this->qrModel->where('code', $qrCode)->first();

            // Cafe bilgilerini getir
            $cafe = $this->cafeModel->find($qrData['cafe_id']);

            // Kategorileri ve ürünleri getir
            $categories = $this->categoryModel
                ->where('cafe_id', $qrData['cafe_id'])
                ->where('status', '1')
                ->findAll();

            // Her kategori için ürünleri getir
            foreach ($categories as &$category) {
                $category['products'] = $this->productModel
                    ->where('cafe_id', $qrData['cafe_id'])
                    ->where('category_id', $category['id'])
                    ->where('status', '1')
                    ->findAll();

                // Her ürün için resimleri getir
                foreach ($category['products'] as &$product) {
                    $product['images'] = $this->productImageModel
                        ->where('product_id', $product['id'])
                        ->findAll();
                }

                // Kategori resmini getir
                $category['image'] = $this->categoryImageModel
                    ->where('category_id', $category['id'])
                    ->first();
            }

            session()->set([
                'qrData' => [
                    'data' => $qrData,
                    'cafe' => $cafe,
                    'categories' => $categories,
                    'tableNumber' => $qrData['table_id'],
                    'floorNumber' => $qrData['floor_id']
                ]
            ]);
        }*/

        $cafeData = session()->get('qrData');

        if ($cafeData != NULL) {
            $this->globalVars = [
                'site_name' => 'My Website',
                'qrData' => session()->get('qrData'),
                'cafe' => session()->get('qrData')["cafe"],
                'qrInfo' => session()->get('qrData')["data"],
                'floorNumber' => session()->get('qrData')["data"]["floor_id"],
                'tableNumber' => session()->get('qrData')["data"]["table_id"],
                'categories' => session()->get('qrData')["categories"]
            ];
        }

        $this->dbConfig = array(
            'user' => $this->DBUsername,
            'pass' => $this->DBPassword,
            'db' => $this->DBName,
            'host' => "localhost",
            'charset' => 'utf8'
        );

        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = service('session');

        $this->setupOrderController();

    }

    protected function setupOrderController(): void
    {
        $this->session = service('session');
        helper('text');

        // Kalıcı Session ID yönetimi
        $this->initializeStableSession();
    }

    /**
     * Kalıcı Session ID başlatma
     * @throws RandomException
     */
    protected function initializeStableSession(): void
    {
        $cookieName = 'stable_session_id';

        // Cookie'den stable session ID'yi al
        $stableSessionId = $this->request->getCookie($cookieName);

        if (empty($stableSessionId)) {
            // Yeni bir stabil session ID oluştur (32 karakter)
            $stableSessionId = bin2hex(random_bytes(16));

            // 90 gün (3 ay) geçerli cookie oluştur
            $cookie = new \CodeIgniter\Cookie\Cookie(
                $cookieName,
                $stableSessionId,
                [
                    'expires'  => time() + (90 * 24 * 60 * 60), // 90 gün
                    'path'     => '/',
                    'domain'   => '',
                    'secure'   => false,
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );

            $this->response->setCookie($cookie);
        }

        // Session'da da sakla
        session()->set('stable_session_id', $stableSessionId);
        $this->stableSessionId = $stableSessionId;
    }

    /**
     * Stable Session ID getter
     */
    protected function getStableSessionId()
    {
        return $this->stableSessionId;
    }
    protected function render(string $view, array $data = []): string
    {
        return view($view, array_merge($data, $this->globalVars));
    }
}
