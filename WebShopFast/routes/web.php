<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\RegisterController;
use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\LogoutController;
use App\Http\Controllers\Account\DetailAccountController;
use App\Http\Controllers\Account\ChangePasswordController;
use App\Http\Controllers\Account\VnpayPaymentController;
use App\Http\Controllers\Account\CustomerOrderController;
use App\Http\Controllers\Account\AddressManagerController;
use App\Http\Controllers\Product\DetailProductController;
use App\Http\Controllers\Product\ProductManagerController;
use App\Http\Controllers\Product\ImageManagerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\DetailShopController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\ConfirmOrderController;
use App\Http\Controllers\Shop\PreDeliveryOrderController;
use App\Http\Controllers\Shop\DoneOrderController;
use App\Http\Controllers\Shop\AbortOrderController;
use App\Http\Controllers\Shop\NotSuccessOrderController;
use App\Http\Controllers\Shop\ShopCarrierController;
use App\Http\Controllers\Shop\MarketingProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CheckoutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductListingController;
use App\Http\Controllers\Admin\CommentManagerController;
use App\Http\Controllers\Admin\MemberManagerController;
use App\Http\Controllers\Admin\CarrierManagerController;
use App\Http\Controllers\Admin\DeletedCarrierManagerController;
use App\Http\Controllers\Admin\UnlockMemberController;
use App\Http\Controllers\Admin\CategoryManagerController;
use App\Http\Controllers\Admin\BannerManagerController;
use App\Http\Controllers\Admin\WebIncomeController;
use App\Http\Controllers\Admin\MarketingManagerController;
use App\Http\Controllers\Admin\MarketingProductManagerController;
use App\Http\Controllers\Admin\NotificationManagerController;
use App\Http\Controllers\Admin\ReportProductManagerController;
use App\Http\Controllers\Admin\ReportCommentManagerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\AdminDashBoardController;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\CheckMemberRole;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckShopRole;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('MainWeb');
Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::post('/login', [LoginController::class, 'store'])->name("login");
Route::resource('/register', RegisterController::class);
Route::get('/logout', [ LogoutController::class,'logout'])->name('logout');
Route::get('/detailProduct/Comment_Pagination', [DetailProductController::class, 'Comment_Pagination']);

Route::post('/detailProduct/ReportProduct', [DetailProductController::class, 'ReportProduct']);
Route::post('/detailProduct/ReportComment', [DetailProductController::class, 'ReportComment']);

Route::get('/detailProduct/{id}', [DetailProductController::class,'GetData']);
Route::resource('/detailAccount', DetailAccountController::class);
Route::resource('/change-password', ChangePasswordController::class);
Route::get('/products/type/{type}', [IndexController::class, 'showByType']);
Route::get('/products/type/{type}/subtype/{subtype}', [IndexController::class, 'showBySubType'])->name('products.showBySubType');

Route::get('/search', [
    IndexController::class,
    'search'
]);

Route::get('/IndexNewProduct_Pagination', [
    IndexController::class,
    'IndexNewProduct_Pagination'
]);

Route::get('/IndexMarketing_Pagination', [
    IndexController::class,
    'IndexMarketing_Pagination'
]);


Route::post('/SendMessage', [
    ChatController::class,
    'UserSendMessage'
]);

Route::get('/ChatSupportUser', [
    ChatController::class,
    'ChatSupportUser'
]);

Route::get('/ChatSupportUser/GetBoxChat', [
    ChatController::class,
    'GetBoxChat'
]);

Route::get('/ChatSupportUser/UpdateSeen', [
    ChatController::class,
    'UpdateSeen'
]);

Route::post('/GetMessage', [
    ChatController::class,
    'GetMessage'
]);

Route::get('/VnpayPayment', [
    VnpayPaymentController::class,
    'SaveDeposit'
]);

Route::post('/VnpayPayment', [
    VnpayPaymentController::class,
    'VnpayPayment'
]);

Route::get('/VnpayPaymentShop', [
    VnpayPaymentController::class,
    'SaveDeposit_Shop'
]);

Route::post('/VnpayPaymentShop', [
    VnpayPaymentController::class,
    'VnpayPayment_Shop'
]);






//Route::resource('/shopHome', ShopController::class);
Route::middleware(['member'])->group(function () {
           
    
    Route::resource('/AddressManager', AddressManagerController::class);
    Route::post('/detailAccount/withdraw', [
        DetailAccountController::class,
        'withdraw' //detail function of ProductsController  
    ]);

    
    Route::post('/AddressManager/addAddress', [
        AddressManagerController::class,
        'addAddress'
    ]);

    Route::post('/AddressManager/Edit', [
        AddressManagerController::class,
        'editAddress'
    ]);
    
    Route::get('/AddressManager/Delete/{id}', [
        AddressManagerController::class,
        'deleteAddress'
    ]);
    
    Route::get('/AddressManager/MakeDefault/{id}', [
        AddressManagerController::class,
        'makedefaultAddress'
    ]);

    Route::get('/cart/add/{id}', [
        CartController::class,
        'addProductToCart'
    ]);

    
    Route::get('/cart/increase-quantity/{CartDetailId}', [
        CartController::class,
        'increaseQuantity'
    ]);


    Route::get('/cart/decrease-quantity/{CartDetailId}', [
        CartController::class,
        'decreaseQuantity'
    ]);

    Route::get('/DetailCart/DeleteCartProduct/{id}', [
        CartController::class,
        'removeCartProduct'
    ]);

    Route::get('/cart/remove-product/{CartDetailId}', [
        CartController::class,
        'removeProductFromCart'
    ]);

    Route::resource('/Checkout', CheckoutController::class);

    Route::post('/checkout', [ CheckoutController::class, 'checkout'])->name('checkout');

    Route::post('/AddNewAddress', [
        CheckoutController::class,
        'AddNewAddress'
    ]);
    
    Route::post('/UpdatePaymentMethod', [
        CheckoutController::class,
        'UpdatePaymentMethod'
    ]);
    
    Route::post('/ChangeAddressCart', [
        CheckoutController::class,
        'ChangeAddressCart'
    ]);
    
    Route::post('/UpdateNewAddress', [
        CheckoutController::class,
        'UpdateAddress'
    ]);

    Route::post('/SaveComment', [
        DetailProductController::class,
        'SaveComment'
    ]);
    
    Route::post('/SaveRating', [
        DetailProductController::class,
        'SaveRating'
    ]);

    Route::resource('/CustomerOrders', CustomerOrderController::class);

    Route::get('/CustomerOrders/Abort/{id}', [
        CustomerOrderController::class,
        'ChangeOrderStatusToAbort'
    ]);

    Route::resource('/DetailCart', CartController::class);
});


Route::get('/DetailNewOrders/Abort/{id}', [
    OrderController::class,
    'ChangeOrderStatusToAbort'
]);

Route::middleware(['shop'])->group(function () {
    Route::resource('/shopHome', ShopController::class);
    Route::resource('/DetailShop', DetailShopController::class);
    Route::resource('/ShopCarrier', ShopCarrierController::class);
    Route::resource('/MyOrder', CustomerOrderController::class);
    Route::resource('/DetailPreDeliveryOrders', PreDeliveryOrderController::class);
Route::resource('/DetailConfirmOrders', ConfirmOrderController::class);
Route::resource('/DetailNewOrders', OrderController::class);
Route::resource('/DetailDoneOrders', DoneOrderController::class);
Route::resource('/DetailAbortOrders', AbortOrderController::class);
Route::resource('/DetailNotSuccessOrders', NotSuccessOrderController::class);

    Route::resource('/ProductManager', ProductManagerController::class)->only([
        'index', 'search', 'addProduct', 'EditProduct', 'removeProduct'
    ]);

    Route::resource('/ImageProductManager', ImageManagerController::class)->only([
        'index', 'search', 'addImageProduct', 'removeImageProduct'
    ]);

    Route::get('/shopHome', [
        ShopController::class,
        'index'
    ])->name('shopHome');
    Route::post('/ShopCarrier/{id}/ChangeCarrier', [
        ShopCarrierController::class,
        'ChangeCarrier'
    ])->name('ChangeCarrier');
    
    Route::post('/DetailShop/withdraw', [
        DetailShopController::class,
        'withdraw' //detail function of ProductsController  
    ]);
    
    Route::post('/ProductManager/addProduct', [
        ProductManagerController::class,
        'addProduct' //detail function of ProductsController
    ]);
    
    Route::post('/ProductManager/Edit', [
        ProductManagerController::class,
        'EditProduct' //detail function of ProductsController
    ]);

    Route::get('/ProductManager/Delete/{id}', [
        ProductManagerController::class,
        'removeProduct'
    ]);

    Route::post('/ImageProductManager/addImageProduct', [
        ImageManagerController::class,
        'addImageProduct' //detail function of ProductsController
    ]);

    Route::get('/ImageProductManager/DeleteImage/{id}', [
        ImageManagerController::class,
        'removeImageProduct'
    ]);

    // Route::get('/DetailCart/DeleteCartProduct/{id}', [
    //     ImageManagerController::class,
    //     'removeImageProduct'
    // ]);

    
    Route::get('/DetailNewOrders/Approve/{id}', [
        OrderController::class,
        'ChangeOrderStatusToApprove'
    ]);


    Route::get('/DetailConfirmOrders/PreDelivery/{id}', [
        ConfirmOrderController::class,
        'ChangeOrderStatusToPreDelivery'
    ]);


    Route::get('/DetailPreDeliveryOrders/Success/{id}', [
        PreDeliveryOrderController::class,
        'ChangeOrderStatusToDeliverySuccess'
    ]);

    Route::post('/DetailPreDeliveryOrders/DeliveryNotSuccess', [
        PreDeliveryOrderController::class,
        'ChangeOrderStatusToDeliveryNotSuccess'
    ]);



    Route::post('/GetDataChartDayRevenue', [
        DashBoardController::class,
        'GetDataChartDayRevenue'
    ]);
    
    Route::post('/GetDataChartMonthRevenue', [
        DashBoardController::class,
        'GetDataChartMonthRevenue'
    ]);
    
    Route::post('/GetDataChartStatusBill', [
        DashBoardController::class,
        'GetDataChartStatusBill'
    ]);
    
    Route::post('/GetDataChartDayProduct', [
        DashBoardController::class,
        'GetDataChartDayProduct'
    ]);
    
    Route::post('/GetDataChartTopProduct', [
        DashBoardController::class,
        'GetDataChartTopProduct'
    ]);
    
    Route::get('/MarketingProduct', [
        MarketingProductController::class,
        'index'
    ]);
    
    Route::get('/MarketingProduct/Delete/{id}', [
        MarketingProductController::class,
        'DeleteProductWithMarketing'
    ]);
    
    Route::post('/AddProductWithMarketing', [
        MarketingProductController::class,
        'AddProductWithMarketing'
    ]);

    Route::get('/ProductManager/Search', [
        ProductManagerController::class,
        'search'
    ]);

    Route::get('/ProductManager/Sort',[ProductManagerController::class,'sort']);

    Route::get('/ProductManager/GetSubCategoryByCategory/{IdCategory}',[ProductManagerController::class,'GetSubCategoryByCategory']);

    Route::get('/ImageProductManager/Search', [ImageManagerController::class, 'search']);

});

Route::middleware(['admin'])->group(function () {
    Route::resource('/adminHome', AdminController::class);
    Route::resource('/ProductListingManager', ProductListingController::class)->only([
        'index', 'removeDetailProduct', 'search'
    ]);
    Route::resource('/CommentManager', CommentManagerController::class)->only([
        'index', 'removeComment', 'search'
    ]);
    Route::resource('/MemberManager', MemberManagerController::class)->only([
        'index','deleteMember', 'search'
    ]);
    Route::resource('/CarrierManager', CarrierManagerController::class)->only([
        'index', 'addCarrier','editCarrier','deleteCarrier', 'search'
    ]);
    Route::resource('/DeletedCarrierManager', DeletedCarrierManagerController::class)->only([
        'index', 'active', 'search'
    ]);
    Route::resource('/UnlockMember', UnlockMemberController::class)->only([
        'index', 'unlockMember', 'search'
    ]);
    Route::resource('/CategoryManager', CategoryManagerController::class)->only([
        'index', 'addCategory','editCategory','deleteCategory', 'search'
    ]);

    Route::resource('/BannerManager', BannerManagerController::class)->only([
        'index', 'addBanner','deleteBanner', 'search'
    ]);
    Route::resource('/WebIncome', WebIncomeController::class)->only([
        'index', 'search'
    ]);
    Route::resource('/MarketingManager', MarketingManagerController::class)->only([
        'index', 'addMarketing','editMarketing','deleteMarketing', 'search'
    ]);
    Route::resource('/MarketingProductManager', MarketingProductManagerController::class)->only([
        'index', 'search','deleteProductMarketing'
    ]);
    Route::resource('/Notification', NotificationManagerController::class);

    Route::resource('/ReportProductManager', ReportProductManagerController::class);
    Route::resource('/ReportCommentManager', ReportCommentManagerController::class);

    Route::get('/ReportCommentManager/Delete/{id}', [
        ReportCommentManagerController::class,
        'delete'
    ]);

    Route::get('/ReportProductManager/Delete/{id}', [
        ReportProductManagerController::class,
        'delete'
    ]);

    Route::post('/MemberManager/Delete', [
        MemberManagerController::class,
        'deleteMember'
    ]);

    Route::post('/BannerManager/addBanner', [
        BannerManagerController::class,
        'addBanner'
    ]);

    Route::get('/BannerManager/Delete/{id}', [
        BannerManagerController::class,
        'deleteBanner'
    ]);

    Route::post('/CategoryManager/addCategory', [
        CategoryManagerController::class,
        'addCategory'
    ]);
    
    Route::post('/CategoryManager/editCategory', [
        CategoryManagerController::class,
        'editCategory'
    ]);

    Route::get('/CategoryManager/Delete/{id}', [
        CategoryManagerController::class,
        'deleteCategory'
    ]);

    Route::post('/MarketingManager/addMarketing', [
        MarketingManagerController::class,
        'addMarketing'
    ]);

    Route::post('/MarketingManager/editMarketing', [
        MarketingManagerController::class,
        'editMarketing'
    ]);

    Route::get('/MarketingManager/Delete/{id}', [
        MarketingManagerController::class,
        'deleteMarketing'
    ]);
    
    Route::post('/MarketingProductManager/Delete', [
        MarketingProductManagerController::class,
        'deleteProductMarketing'
    ]);
    
    Route::get('/Notification/Done/{id}', [
        NotificationManagerController::class,
        'doneNotification'
    ]);

    Route::get('/UnlockMember/Unlock/{id}', [
        UnlockMemberController::class,
        'unlockMember'
    ]);

    Route::get('/CarrierManager/Delete/{id}', [
        CarrierManagerController::class,
        'deleteCarrier'
    ]);

    Route::post('/CarrierManager/Edit', [
        CarrierManagerController::class,
        'editCarrier'
    ]);

    Route::post('/CarrierManager/addCarrier', [
        CarrierManagerController::class,
        'addCarrier'
    ]);

    Route::get('/DeletedCarrierManager/Active/{id}', [
        DeletedCarrierManagerController::class,
        'active'
    ]);

    Route::get('/ProductListingManager/Delete/{id}', [
        ProductListingController::class,
        'removeDetailProduct'
    ]);

    Route::get('/CommentManager/Delete/{id}', [
        CommentManagerController::class,
        'removeComment'
    ]);

    Route::get('/MemberManager/search', [
        MemberManagerController::class,
        'search'
    ]);

    Route::get('/UnlockMember/search', [
        UnlockMemberController::class,
        'search'
    ]);

    Route::get('/CarrierManager/search', [
        CarrierManagerController::class,
        'search'
    ]);

    
    Route::get('/ProductListingManager/search', [
        ProductListingController::class,
        'search'
    ]);

    Route::get('/CommentManager/search', [
        CommentManagerController::class,
        'search'
    ]);

    Route::get('/DeletedCarrierManager/search', [
        DeletedCarrierManagerController::class,
        'search'
    ]);

    Route::get('/CategoryManager/search', [
        CategoryManagerController::class,
        'search'
    ]);

    Route::get('/BannerManager/search', [
        BannerManagerController::class,
        'search'
    ]);

    
    Route::get('/WebIncome/search', [
        WebIncomeController::class,
        'search'
    ]);

    Route::get('/MarketingManager/search', [
        MarketingManagerController::class,
        'search'
    ]);

    Route::get('/MarketingProductManager/search', [
        MarketingProductManagerController::class,
        'search'
    ]);

    Route::post('/GetDataChartDayRevenueAdmin', [
        AdminDashBoardController::class,
        'GetDataChartDayRevenueAdmin'
    ]);
    
    Route::post('/GetDataChartMonthRevenueAdmin', [
        AdminDashBoardController::class,
        'GetDataChartMonthRevenueAdmin'
    ]);
    
    Route::post('/GetDataChartStatusBillAdmin', [
        AdminDashBoardController::class,
        'GetDataChartStatusBillAdmin'
    ]);
    
    Route::post('/GetDataChartDayProductAdmin', [
        AdminDashBoardController::class,
        'GetDataChartDayProductAdmin'
    ]);
    
    Route::post('/GetDataChartTopProductAdmin', [
        AdminDashBoardController::class,
        'GetDataChartTopProductAdmin'
    ]);

    Route::get('/GetDataProductById', [
        ReportProductManagerController::class,
        'GetDataProductById'
    ]);
});
















