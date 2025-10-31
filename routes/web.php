<?php  
  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\MainController\HomeController;
use App\Http\Controllers\MainController\ProfileController;
use App\Http\Controllers\MainController\CarierController;
use App\Http\Controllers\MainController\ResearchController;
use App\Http\Controllers\MainController\DailyController;    
use App\Http\Controllers\MainController\GuidanceController;
use App\Http\Controllers\AdminController\LoginAdminController;  
use App\Http\Controllers\AdminController\DashboardController;  
use App\Http\Controllers\AdminController\CarierManageController;  
use App\Http\Controllers\AdminController\UserManageController;  
use App\Http\Controllers\AdminController\ResearchManageController;  
use App\Http\Controllers\AdminController\DailyManageController;  
use App\Http\Controllers\AdminController\VisitorController; 
use App\Http\Controllers\AdminController\FinanceAdminController; 
use App\Http\Controllers\DiscordController;  
use App\Http\Controllers\AnimeController\DashboardAnimeController;
use App\Http\Controllers\AnimeController\AddAnimeController;
use App\Http\Controllers\AnimeController\JourneyAnimeController;
use App\Http\Controllers\SalaryController\SalaryMainController;

Route::middleware(['throttle:web'])->group(function () {  
    // Main Routes  
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('main.index');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('main.index');
    });
    Route::controller(CarierController::class)->group(function () {
        Route::get('/carier', 'index')->name('main.index');
    });
    Route::controller(ResearchController::class)->group(function () {
        Route::get('/research', 'index')->name('main.index');
      //  Route::get('/send', 'sendEmail')->name('main.mail');
    });
   Route::controller(DailyController::class)->group(function () {
    Route::get('/activities', 'index')->name('main.index');
    });
    // Route::controller(GuidanceController::class)->group(function () {  
    //     Route::get('/bimbingan', 'index')->name('main.bimbingan'); 
    //     Route::get('/bimbingan/jadwal', 'indexjadwal')->name('main.bimbingan.jadwal'); 
    //     Route::post('/bimbingan/store', 'store')->name('main.store');  
    // });  
    Route::controller(LoginAdminController::class)->group(function () {  
        Route::get('/login', 'index')->name('login');  
        Route::get('/login/otp', 'otp')->name('login.otp');  
        Route::post('/login/auth-login', 'login')->name('admin.login');  
        Route::post('/login/auth-otp', 'storeotp')->name('admin.otp');  
        Route::get('/logout', 'logout')->name('admin.logout');  
    });  
});  
Route::middleware(['auth', 'user-access:wibu'])->group(function () {  
    Route::controller(DashboardAnimeController::class)->prefix('anime/dashboard')->group(function(){  
        Route::get('/', 'index')->name('dashboard.anime.index');  
    });  
    Route::controller(AddAnimeController::class)->prefix('anime/watchlist')->group(function(){  
        Route::get('/', 'index')->name('add.anime.index'); 
        Route::post('/anime/watchlist/save',  'save')->name('anime.watchlist.save');   
    }); 
    Route::controller(JourneyAnimeController::class)->prefix('anime/journey')->group(function(){  
        Route::get('/', 'index')->name('journey.anime.index'); 
    }); 
    
});  

Route::middleware(['auth', 'otp','user-access:admin,superadmin,regular', 'throttle:admin'])->group(function () {  
    
    Route::controller(FinanceAdminController::class)->prefix('admin/finance')->group(function() {
        Route::get('/', 'index')->name('admin.finance.index');              // Dashboard
        Route::get('/fund', 'Fund')->name('admin.finance.Fund'); // Tambah dana masuk
        Route::post('/add-fund', 'addFund')->name('admin.finance.addFund'); // Tambah dana masuk
        Route::post('/edit-fund', 'editFund')->name('admin.finance.editFund'); // edit dana masuk
        Route::get('/delete-finance/{id}', 'deleteFinance')->name('admin.finance.deleteFinance'); // delete dana masuk
        Route::get('/expense', 'Expense')->name('admin.finance.Expense'); // Tambah pengeluaran
        Route::post('/add-expense', 'addExpense')->name('admin.finance.addExpense'); // Tambah pengeluaran
        Route::post('/edit-expense', 'editExpense')->name('admin.finance.editExpense'); // edit dana masuk
        Route::get('/history', 'history')->name('admin.finance.history');   // Riwayat transaksi
    });
    // Admin Dashboard  
    Route::controller(DashboardController::class)->prefix('admin/dashboard')->group(function () {  
        Route::get('/', 'index')->name('dashboard.admin.index');  
    });  
    // Visitor Management  
    Route::controller(VisitorController::class)->prefix('admin/visitor')->group(function () {  
        Route::get('/', 'index')->name('admin.visitor.index');  
        Route::get('/month_chart', 'month')->name('admin.visitor.month_chart');  
        Route::get('/daily_chart', 'daily')->name('admin.visitor.daily_chart');  
        Route::get('/chart', 'countryChart')->name('admin.visitor.chart');  
    });  
  
    // User Management  
    Route::controller(UserManageController::class)->prefix('admin/user')->group(function () {  
        Route::get('/', 'index')->name('user.admin.index');  
        Route::post('/', 'store')->name('user.admin.store');  
    });  
  
    // Carier Management  
    Route::controller(CarierManageController::class)->prefix('admin/carier')->group(function () {  
        Route::get('/', 'index')->name('carier.admin.index');  
        Route::get('/create', 'create')->name('carier.admin.create');  
        Route::post('/store', 'store')->name('carier.admin.store');  
        Route::get('/inject', 'injectSkills');  
        Route::get('/{id}/edit', 'edit')->name('carier.admin.edit');  
        Route::put('/{id}', 'update')->name('carier.admin.update');  
        Route::delete('/{id}', 'destroy')->name('carier.admin.destroy');  
        Route::get('/add-fake-data', 'addFakeData')->name('carier.admin.addFakeData');  
        Route::get('/delete-all', 'deleteAll')->name('carier.admin.deleteAll');  
    });  
  
    // Research Management  
    Route::controller(ResearchManageController::class)->prefix('admin/research')->group(function () {  
        Route::get('/', 'index')->name('research.admin.index');  
        Route::get('/create', 'create')->name('research.admin.create');  
        Route::post('/store', 'store')->name('research.admin.store');  
        Route::delete('/{id}', 'destroy')->name('research.admin.destroy');  
        Route::get('/add-fake-data', 'addFakeData')->name('research.admin.addFakeData');  
        Route::get('/delete-all', 'deleteAll')->name('research.admin.deleteAll');  
    });  
  
    // Redirect CV  
    Route::get('/redirect-cv/{encryptedUrl}', function ($encryptedUrl) {  
        $decryptedUrl = Crypt::decrypt($encryptedUrl);  
        return redirect($decryptedUrl);  
    })->name('redirect.cv');  
  
    // Daily Activities Management  
    Route::controller(DailyManageController::class)->prefix('admin/activities')->group(function () {  
        Route::get('/', 'index')->name('admin.activities.index');  
        Route::get('/create', 'create')->name('admin.activities.create');  
        Route::post('/', 'store')->name('admin.activities.store');  
        Route::get('/{id}/edit', 'edit')->name('admin.activities.edit');  
        Route::put('/{id}', 'update')->name('admin.activities.update');  
        Route::delete('/{id}', 'destroy')->name('admin.activities.destroy');  
    });  
});  