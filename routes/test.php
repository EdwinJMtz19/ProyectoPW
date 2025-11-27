<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/test-auth', function () {
    // Ver todos los usuarios
    $users = User::all();
    
    echo "<h1>Usuarios en la base de datos:</h1>";
    echo "<pre>";
    print_r($users->toArray());
    echo "</pre>";
    
    // Buscar el usuario específico
    $user = User::where('numero_control', '22161228')->first();
    
    if ($user) {
        echo "<h2>Usuario encontrado:</h2>";
        echo "<pre>";
        print_r($user->toArray());
        echo "</pre>";
        
        // Probar si la contraseña coincide
        echo "<h2>Prueba de contraseña:</h2>";
        $testPassword = 'tu_contraseña_aqui'; // Cambia esto por la contraseña que usaste
        $passwordMatch = Hash::check($testPassword, $user->password);
        echo "¿Contraseña coincide? " . ($passwordMatch ? "SÍ ✅" : "NO ❌");
        echo "<br>";
        echo "Password hash en BD: " . $user->password;
        
        // Probar Auth::attempt
        echo "<h2>Prueba de Auth::attempt:</h2>";
        $credentials = [
            'numero_control' => '22161228',
            'password' => $testPassword
        ];
        $attemptResult = \Illuminate\Support\Facades\Auth::attempt($credentials);
        echo "¿Auth::attempt funciona? " . ($attemptResult ? "SÍ ✅" : "NO ❌");
        
    } else {
        echo "<h2>Usuario NO encontrado</h2>";
    }
    
    return '';
});
