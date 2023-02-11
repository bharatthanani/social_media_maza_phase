<?php
use Illuminate\Support\Facades\Route;
/*-- FRONT ROUTES --*/
use App\Http\Controllers\Front\SignupController;
use App\Http\Controllers\Front\GroupController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Controllers\Front\EventController;
use App\Http\Controllers\Front\SettingsController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\FriendRequestController;
use App\Http\Controllers\Front\StoryController;
/*-- ADMIN ROUTES --*/
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
/*-- FRONT ROUTES --*/
Route::get('/', [SignupController::class, 'signupForm'])->name('signupForm');
Route::post('signupProcess', [SignupController::class, 'signupProcess'])->name('signupProcess');
Route::post('signinProcess', [SignupController::class, 'signinProcess'])->name('signinProcess');
Route::group(['middleware' => 'front'], function () {
    Route::get('logout', [SignupController::class, 'logout'])->name('logout');
    Route::get('news-feed', [SignupController::class, 'newsfeed'])->name('news-feed');
    Route::get('groups', [GroupController::class, 'groups'])->name('groups');
    Route::get('events', [EventController::class, 'events'])->name('events');
    Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
    Route::get('notifications', [NotificationController::class, 'notifications'])->name('notifications');
    Route::get('privacypolicy', [SettingsController::class, 'privacypolicy'])->name('privacypolicy');
    Route::get('account', [SignupController::class, 'account'])->name('account');
    Route::get('editprofile', [SignupController::class, 'editprofile'])->name('editprofile');
    Route::get('helpsupport', [SettingsController::class, 'helpsupport'])->name('helpsupport');
    Route::post('uploadProfileImage', [SignupController::class, 'uploadProfileImage'])->name('uploadProfileImage');
    Route::post('uploadBannerImage', [SignupController::class, 'uploadBannerImage'])->name('uploadBannerImage');
    Route::post('uploadUserData', [SignupController::class, 'uploadUserData'])->name('uploadUserData');
    Route::post('uploadAboutData', [SignupController::class, 'uploadAboutData'])->name('uploadAboutData');
    Route::post('uploadUserAboutSection', [SignupController::class, 'uploadUserAboutSection'])->name('uploadUserAboutSection');
    Route::post('uploadUserEducationSection', [SignupController::class, 'uploadUserEducationSection'])->name('uploadUserEducationSection');
    Route::post('createPost', [PostController::class, 'createPost'])->name('createPost');
    Route::post('getLikes', [PostController::class, 'getLikes'])->name('getLikes');
    Route::post('getComments', [PostController::class, 'getComments'])->name('getComments');
    Route::post('addComment', [PostController::class, 'addComment'])->name('addComment');
    Route::post('deletePost', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('addFriend', [FriendRequestController::class, 'addFriend'])->name('addFriend');
    Route::get('allSuggestions', [FriendRequestController::class, 'allSuggestions'])->name('allSuggestions');
    Route::get('allConfirmRequests', [FriendRequestController::class, 'allConfirmRequests'])->name('allConfirmRequests');
    Route::post('confirmRequestDelete', [FriendRequestController::class, 'confirmRequestDelete'])->name('confirmRequestDelete');
    Route::post('acceptFriendrequest', [FriendRequestController::class, 'acceptFriendrequest'])->name('acceptFriendrequest');
    Route::get('yourfriends', [FriendRequestController::class, 'yourfriends'])->name('yourfriends');
    Route::get('yourrequests', [FriendRequestController::class, 'yourrequests'])->name('yourrequests');
    Route::post('unFriend', [FriendRequestController::class, 'unFriend'])->name('unFriend');
    Route::post('createStory', [StoryController::class, 'createStory'])->name("createStory");
    Route::get('getStories', [StoryController::class, 'getStories'])->name('getStories');
    /*-- Groups --*/
    Route::post('createGroup', [GroupController::class, 'createGroup'])->name('createGroup');
    Route::post('changeGroupStatus', [GroupController::class, 'changeGroupStatus'])->name('changeGroupStatus');
    Route::get('groupNewsfeed/{id}', [GroupController::class, 'groupNewsfeed'])->name('groupNewsfeed');
    Route::get('myGroups', [GroupController::class, 'myGroups'])->name('myGroups');
    Route::post('deleteMygroup', [GroupController::class, 'deleteMygroup'])->name('deleteMygroup');
    Route::get('friendGroups', [GroupController::class, 'friendGroups'])->name('friendGroups');
    Route::get('remainingGroups', [GroupController::class, 'remainingGroups'])->name('remainingGroups');
    Route::post('uploadGroupProfileImage', [GroupController::class, 'uploadGroupProfileImage'])->name('uploadGroupProfileImage');
    Route::post('uploadGroupCoverImage', [GroupController::class, 'uploadGroupCoverImage'])->name('uploadGroupCoverImage');
    Route::post('uploadGroupTitle', [GroupController::class, 'uploadGroupTitle'])->name('uploadGroupTitle');
    Route::post('leaveGroup', [GroupController::class, 'leaveGroup'])->name('leaveGroup');
    Route::post('confirmGroupRequest', [GroupController::class, 'confirmGroupRequest'])->name('confirmGroupRequest');
    Route::get('allNewRequests/{id}', [GroupController::class, 'allNewRequests'])->name('allNewRequests');
    Route::get('allGroupMembers/{id}', [GroupController::class, 'allGroupMembers'])->name('allGroupMembers');
     /*-- Events --*/
     Route::post('createEvent', [EventController::class, 'createEvent'])->name('createEvent');
     Route::post('changeEventStatus', [EventController::class, 'changeEventStatus'])->name('changeEventStatus');
     Route::post('deleteMyEvent', [EventController::class, 'deleteMyEvent'])->name('deleteMyEvent');
     Route::get('othersevents', [EventController::class, 'othersevents'])->name('othersevents');
     Route::get('myevents', [EventController::class, 'myevents'])->name('myevents');
     // MessengerController
     Route::get('messages', [MessageController::class, 'messages'])->name('messages');
     Route::get('ViewMessages', [MessageController::class, 'ViewMessages'])->name("ViewMessages");
     Route::get('SendMessage', [MessageController::class, 'SendMessage'])->name("SendMessage");
     
});
/*-- ADMIN ROUTES --*/
Route::get('admin/login', [LoginController::class, 'loginForm'])->name('adminLoginForm');
Route::post('loginProcess', [LoginController::class, 'loginProcess'])->name('loginProcess');
Route::get('adminLogout', [LoginController::class, 'logout'])->name('adminLogout');
Route::group(['middleware' => 'admin'], function () {
     Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UserController::class, 'users'])->name('users');
        Route::get('privacyPolicy', [SettingController::class, 'privacyPolicy'])->name('privacyPolicy');
        Route::post('updatePrivacyPolicy', [SettingController::class, 'updatePrivacyPolicy'])->name('updatePrivacyPolicy');
        Route::get('helpSupport', [SettingController::class, 'helpSupport'])->name('helpSupport');
        Route::get('addHelpSupport', [SettingController::class, 'addHelpSupport'])->name('addHelpSupport');
        Route::post('addhelpSupportProcess', [SettingController::class, 'addhelpSupportProcess'])->name('addhelpSupportProcess');
        Route::get('deleteHelpSupport/{id}', [SettingController::class, 'deleteHelpSupport'])->name('deleteHelpSupport');
        Route::get('editHelpSupport/{id}', [SettingController::class, 'editHelpSupport'])->name('editHelpSupport');
        Route::post('updatehelpSupportProcess/{id}', [SettingController::class, 'updatehelpSupportProcess'])->name('updatehelpSupportProcess');
    });
});
// Route::group(['middleware' => 'admin'], function () {
//     Route::get('dashboard', [LoginController::class, 'dashboard']);

//     Route::get('addAttribute', [ProductController::class, 'addAttribute'])->name('addAttribute');
//     Route::post('attributeProcess', [ProductController::class, 'attributeProcess'])->name('attributeProcess');
//     Route::get('editAttribute/{id}', [ProductController::class, 'editAttribute'])->name('editAttribute');
//     Route::post('updateAttribute/{id}', [ProductController::class, 'updateAttribute'])->name('updateAttribute');
//     Route::get('deleteAttribute/{id}', [ProductController::class, 'deleteAttribute'])->name('deleteAttribute');
//     Route::get('viewAttributes', [ProductController::class, 'viewAttributes'])->name('viewAttributes');

//     Route::get('addVarient', [ProductController::class, 'addVarient'])->name('addVarient');
//     Route::get('viewVarients', [ProductController::class, 'viewVarients'])->name('viewVarients');
//     Route::post('varientProcess', [ProductController::class, 'varientProcess'])->name('varientProcess');
//     Route::get('editVariant/{id}', [ProductController::class, 'editVariant'])->name('editVariant');
//     Route::post('updateVariant/{id}', [ProductController::class, 'updateVariant'])->name('updateVariant');
//     Route::get('deleteVariant/{id}', [ProductController::class, 'deleteVariant'])->name('deleteVariant');

//     Route::get('addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
//     Route::post('productProcess', [ProductController::class, 'productProcess'])->name('productProcess');
//     Route::get('sortProductImages', [ProductController::class, 'sortProductImages'])->name('sortProductImages');
//     Route::post('updateSortProductImages', [ProductController::class, 'updateSortProductImages'])->name('updateSortProductImages');
//     Route::get('viewProducts', [ProductController::class, 'viewProducts'])->name('viewProducts');
//     Route::post('ViewProductVarients', [ProductController::class, 'ViewProductVarients'])->name('ViewProductVarients');
//     Route::get('deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
//     Route::get('editProduct/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
//     Route::post('updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    
//     Route::get('addAbout', [AboutController::class, 'addAbout'])->name('addAbout');
//     Route::post('addAboutProcess', [AboutController::class, 'addAboutProcess'])->name('addAboutProcess');
//     Route::get('viewAbouts', [AboutController::class, 'viewAbouts'])->name('viewAbouts');
//     Route::get('ViewSubItem/{id}',[AboutController::class, 'ViewSubItem'])->name('ViewSubItem');
//     Route::get('aboutZuni',[AboutController::class, 'aboutZuni'])->name('aboutZuni');
//     Route::post('ViewZuniAboutChilds',[AboutController::class, 'ViewZuniAboutChilds'])->name('ViewZuniAboutChilds');
//     Route::get('aboutZast',[AboutController::class, 'aboutZast'])->name('aboutZast');
//     Route::post('updateAboutZast/{id}', [AboutController::class, 'updateAboutZast'])->name('updateAboutZast');
//     Route::get('deleteAboutZuni/{id}', [AboutController::class, 'deleteAboutZuni'])->name('deleteAboutZuni');
//     Route::get('editAboutZuni/{id}', [AboutController::class, 'editAboutZuni'])->name('editAboutZuni');
//     Route::post('deleteChildAttachment', [AboutController::class, 'deleteChildAttachment'])->name('deleteChildAttachment');
//     Route::post('deleteMainAttachment', [AboutController::class, 'deleteMainAttachment'])->name('deleteMainAttachment');
//     Route::post('deleteChildRecord', [AboutController::class, 'deleteChildRecord'])->name('deleteChildRecord');
//     Route::post('updateAboutZuni/{id}', [AboutController::class, 'updateAboutZuni'])->name('updateAboutZuni');
//     Route::get('viewSiteContact', [ContactController::class, 'viewSiteContact'])->name('viewSiteContact');
//     Route::post('updateSiteContact/{id}', [ContactController::class, 'updateSiteContact'])->name('updateSiteContact');
//     // Route::post('varientProcess', [ProductController::class, 'varientProcess'])->name('varientProcess');
//     // Route::get('editVariant/{id}', [ProductController::class, 'editVariant'])->name('editVariant');
//     // Route::post('updateVariant/{id}', [ProductController::class, 'updateVariant'])->name('updateVariant');
//     // Route::get('deleteVariant/{id}', [ProductController::class, 'deleteVariant'])->name('deleteVariant');
//     Route::get('analytics', [AnalyticsController::class, 'analytics'])->name('analytics');
//     Route::get('pending', [OrderController::class, 'pending'])->name('pending');
//     Route::get('confirmed', [OrderController::class, 'confirmed'])->name('confirmed');
//     Route::get('delivered', [OrderController::class, 'delivered'])->name('delivered');
//     Route::get('cancelled', [OrderController::class, 'cancelled'])->name('cancelled');
//     Route::get('returned', [OrderController::class, 'returned'])->name('returned');
//     Route::post('changeStatus', [OrderController::class, 'changeStatus'])->name('changeStatus');
//     Route::get('viewOrderDetails/{id}', [OrderController::class, 'viewOrderDetails'])->name('viewOrderDetails');
    
//     /// view products 
//     Route::get('viewProduct', [ProductController::class, 'viewProduct'])->name('viewProduct');
//     Route::get('getProduct', [ProductController::class, 'getProduct'])->name('getProduct');
//     Route::post('deleteProductImage', [ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
// });