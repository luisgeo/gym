<?php


use App\Http\Controllers\PdfController;
use App\Http\Livewire\AlmacenesEdit;
use App\Http\Livewire\AlmacenesTable;
use App\Http\Livewire\CajaEdit;
use App\Http\Livewire\CarteraClientesEdit;
use App\Http\Livewire\CarteraClientesTable;
use App\Http\Livewire\UsuariosTable;
use App\Http\Livewire\ComprasTable;
use App\Http\Livewire\DetalleCompra;
use App\Http\Livewire\MarcasEdit;
use App\Http\Livewire\MarcasTable;
use App\Http\Livewire\NotificacionesTable;
use App\Http\Livewire\ProductosEdit;
use App\Http\Livewire\ProductosTable;
use App\Http\Livewire\ProveedoresEdit;
use App\Http\Livewire\ProveedoresTable;
use App\Http\Livewire\RegisterUser;
use App\Http\Livewire\RegisterUserSinLogin;
use App\Http\Livewire\RepartirProductos;
use App\Http\Livewire\TestProductosEdit;
use App\Http\Livewire\TestProductosTable;
use App\Http\Livewire\UsuarioEdit;
use App\Http\Livewire\VenderProducto;
use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/php', function(){
//     return phpinfo();
// });

// Route::get('/testing', function () {
//     return view('livewire.ejemplo');
// });

// Route::get('/csrf', function () {
//     return csrf_token();
// });

// Route::post('/uploadImage', function (Request $request) {
//     return $request->file('imagen')->store('imagenes_producto', 'public');
// });

// Route::post('/deleteImage', function () {
//     if(Storage::disk('public')->exists("/imagenes_producto/php9A2B.tmp.jpg"))
//         Storage::delete("/imagenes_producto/php9A2B.tmp.jpg");
//     // $request->file('imagen')->storeAs('imagenes_producto', $request->file('imagen')->getFilename() . '.jpeg');
// });

// Route::get('/exists', function (Request $request){
//     echo Storage::disk('public')->exists("/imagenes_producto/1.jpeg") ? 'Existe': 'No existe';
//     // return Storage::exists(Storage::path('/imagenes_producto/php9A2B.tmp.jpg')) ? 'Sí existe': 'No existe';
// });

Route::get('/test', function () {

    $prods = Producto::all('id_producto')->toArray();
    // $alms = Almacen::all('id_almacen')->toArray();
    $alms = [
        0 => [
            'id_almacen' => 4
        ]
    ];

    $new = [];

    $new = Arr::crossJoin($prods, $alms);

    foreach($new as $item => $val){

       $new[$item] = array_merge($val[0], $val[1]);
       $new[$item]['stock'] = 0;

    }

    echo json_encode($new);

    // $prods = Producto::all('id_producto');

    // array_map(function ($prodsList) use (&$prodsFixed) {
    //     $prodsList['stock'] = 0;
    //     $prodsFixed = $prodsList;
    // }, $prods->toArray());

    // foreach($prods as $prod => $val){
    //     $prods[$prod]['stock'] = 0;
    // }

    // echo json_encode($new);
    // $cant = 0;
    // $productoValues['almacenes'] = [
    //     1 => 25,
    //     2 => 0,
    //     3 => 50
    // ];

    // array_map(function ($val) use (&$cant) {
    //     $cant += $val;
    // }, array_values($productoValues['almacenes']));

    // return $cant;
});

Route::get('/routeclear', function () {
    Artisan::call('route:clear'); // this will do the command line job
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link'); // this will do the command line job
});

Route::get('/registrar-usuario-sin-login', [RegisterUserSinLogin::class, 'render'])->name('registrar-usuario-sin-login');

Route::post('/registrar-usuario-sin-login', [RegisterUserSinLogin::class, 'register'])->name('usuario-not-registered.new');

# General routes

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login-user', [RegisterUser::class, 'login'])->name('usuario.login');

Route::middleware(['RoleAssignment'])->group(function () {

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth'])->group(function () {

        Route::post('/salir', [RegisterUser::class, 'logout'])->name('logout.app');

        //Administrador

        Route::middleware(['CheckRole:administrador'])->group(function () {

            # Usuarios routes

            Route::get('/usuarios', UsuariosTable::class)->name('usuarios');

            Route::get('/registrar-usuario', RegisterUser::class)->name('registrar-usuario');

            Route::post('/registrar-usuario', [RegisterUser::class, 'register'])->name('usuario.new');

            Route::get('/editar-usuario/{id}', UsuarioEdit::class)->name('usuario.edit');

            Route::post('/editar-usuario', [UsuarioEdit::class, 'edit'])->name('usuario.edit.post');



            # Productos routes


            Route::get('/producto', ProductosTable::class)->name('productos');

            Route::get('/producto/{id}', ProductosEdit::class)
                ->where('id', '[0-9]+')->name('productos.edit');

            Route::get('/producto/new', ProductosEdit::class)->name('productos.new');

            Route::get('/producto/modificar', [RepartirProductos::class, 'generateRegisters'])->name('productos.modificar');

            Route::get('/producto/repartir', RepartirProductos::class)->name('productos.repartir');

            Route::post('/producto/repartir', [RepartirProductos::class, 'save'])->name('productos.repartir.post');


            # Proveedores routes

            Route::get('/proveedor', ProveedoresTable::class)->name('proveedores');

            Route::get('/proveedor/{id}', ProveedoresEdit::class)
                ->where('id', '[0-9]+')->name('proveedores.edit');

            Route::get('/proveedor/new', ProveedoresEdit::class)->name('proveedores.new');


            # Marcas routes

            Route::get('/marca', MarcasTable::class)->name('marcas');

            Route::get('/marca/{id}', MarcasEdit::class)
                ->where('id', '[0-9]+')->name('marcas.edit');

            Route::get('/marca/new', MarcasEdit::class)->name('marcas.new');


            # Marcas clientes

            Route::get('/clientes', CarteraClientesTable::class)->name('clientes');

            Route::get('/cliente/{id}', CarteraClientesEdit::class)
                ->where('id', '[0-9]+')->name('clientes.edit');

            Route::get('/cliente/new', CarteraClientesEdit::class)->name('clientes.new');


            # Compras routes

            Route::get('/ventas', ComprasTable::class)->name('compras');

            Route::get('/compra/{id}', DetalleCompra::class)
                ->where('id', '[0-9]+')->name('detalle.compra');

            Route::get('/compra/new', VenderProducto::class)
                ->name('compra.new');

            Route::get('/notificaciones', NotificacionesTable::class)
                ->name('notificaciones');


            # Almacenes routes

            Route::get('/almacen', AlmacenesTable::class)->name('almacenes');

            Route::get('/almacen/{id}', AlmacenesEdit::class)
                ->where('id', '[0-9]+')->name('almacenes.edit');

            Route::get('/almacen/new', AlmacenesEdit::class)->name('almacenes.new');


            # Cajas routes

            Route::get('/cajas/{id}', CajaEdit::class)
                ->where('id', '[0-9]+')->name('cajas.edit');


            #Ver ticket

            Route::get('/ver-ticket/{id}', [PDFController::class, 'ticket'])
                ->where('id', '[0-9]+')->name('admin.ticket');
        });


        //Empleado
        Route::middleware(['CheckRole:empleado'])->group(function () {

            #Ver ticket

            Route::get('/imprimir-ticket', [PDFController::class, 'ticket'])
                ->name('empleado.ticket');



            Route::get('/compra/new', VenderProducto::class)
                ->name('compra.new.tienda');
        });
    });
});


# Jasper Reports
// Route::get('/compilar', function () {
//     $input = base_path() . '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';

//     $jasper = new PHPJasper;
//     $jasper->compile($input)->execute();

//     return response()->json([
//         'status' => 'ok'
//     ]);
// });

// Route::get('/reporte', function () {
//     $input = base_path() . '/vendor/geekcom/phpjasper/examples/hello_world.jasper';
//     $output = base_path() . '/vendor/geekcom/phpjasper/examples';
//     $options = [
//         'format' => ['pdf', 'rtf']
//     ];

//     $jasper = new PHPJasper;
//     $jasper->process($input, $output, $options)->execute();

//     $pathToFile = base_path() .
//         '/vendor/geekcom/phpjasper/examples/hello_world.pdf';

//     return response()->file($pathToFile);
// });
