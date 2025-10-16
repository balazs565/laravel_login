<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TimeslotController;
use App\Http\Controllers\ReservationController;


// Public routes
Route::view('/', 'welcome');
Route::view('/login', 'login')->name('login');
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withInput()->withErrors(['error' => 'Autentificare eșuată.']);
});
Route::get('/register', function () { return view('register'); });


Route::post('/logout', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    try {
        try {
            $incoming = $request->input('_token');
            $cookie = $request->cookie(config('session.cookie'));
            $serverSessionToken = session()->token();
            logger()->info('Registration debug', [
                'incoming_token' => $incoming,
                'cookie_session' => $cookie,
                'server_csrf' => $serverSessionToken,
                'session_id' => session()->getId(),
            ]);
        } catch (\Throwable $e) {
            logger()->warning('Registration debug failed to read session: '.$e->getMessage());
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        logger()->info('Registration: validated', ['email' => $request->input('email')]);

        $user = App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], 
        ]);

        logger()->info('Registration: created user', ['id' => $user->id ?? null, 'email' => $user->email ?? null]);


        auth()->login($user);

        logger()->info('Registration: logged in', ['id' => $user->id ?? null]);

        return redirect('/dashboard');
    } catch (\Throwable $e) {
        logger()->error('Registration failed: '.$e->getMessage());

        return back()->withInput()->withErrors(['error' => 'Unable to register. Please try again.']);
    }
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function() { return view('dashboard'); })->name('dashboard');

    
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index ');
    Route::get('/services/{service}/timeslots', [TimeslotController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations', [ReservationController::class, 'index']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('timeslots', TimeslotController::class)->except(['show']);
    Route::resource('reservations', ReservationController::class)->except(['store']);
});
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->middleware('auth')->name('reservations.destroy');
Route::post('/profile/avatar', [\App\Http\Controllers\ProfileController::class, 'uploadAvatar'])->name('profile.avatar');

