<?php

namespace App\Http\Controllers;

use PHPJasper\PHPJasper;

class ReportesController extends Controller
{
     public function CompilarReportesProductos(){
        $input = 'C:\Users\Danny Delgadillo\JaspersoftWorkspace\MyReports\Productos10.jrxml';   

        $jasper = new PHPJasper;
        $jasper->compile($input)->execute();
        return "Compilado";
     }

     public function ReporteProducto(){
        $input = 'C:\Users\Danny Delgadillo\JaspersoftWorkspace\MyReports\Productos10.jasper';   
        $output = 'C:\Users\Danny Delgadillo\JaspersoftWorkspace\MyReports';
        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [],
            'db_connection' => [
                'driver' => 'postgres', 
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE'),
                'port' => env('DB_PORT')
            ]
        ];
        
        $jasper = new PHPJasper;
        
        $jasper->process(
                $input,
                $output,
                $options
        )->execute();
        
         return response()->file($output . "\Productos10.pdf");
    }

}
