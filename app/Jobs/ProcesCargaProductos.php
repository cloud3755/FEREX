<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Excel;
use App\Models\Producto;
use App\Models\Inventario;

class ProcesCargaProductos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     
            Excel::load($this->path, function($reader) 
            {
                
                //dd($reader->toArray());
               
                $line0 = $reader->get()->getHeading();
                $len = count( $line0);

                $arraySucursales = [];

                for($i = 7 ; $i<$len; $i++)
                {
                    $explodeSucursales = explode("_",$line0[$i]);
                    $arraySucursales[$explodeSucursales[2]] =  $explodeSucursales[1];
                    //array_push($arraySucursales, explode("_",$line0[$i])[1] );
                }
               // dd($arraySucursales);
               // $reader->each(function($row) {
                foreach ($reader->toArray() as $key => $row) {
               //     dd($row);
                    $Producto = new Producto;
                    $Producto->nombre =  $row['producto'];
                    $Producto->descripcion =  $row['descripcion'];
                    $Producto->claveProdServ =  $row['clave_sat'];
                    //$Producto->minimoAlarma =  $row['minimoAlarma'];
                    $Producto->codigoBarras =  $row['codigo_barras'];
                    $Producto->precioA =  $row['precio_a'];
                    $Producto->precioB =  $row['precio_b'];
                    $Producto->precioC =  $row['precio_c'];
                    $Producto->save();
                    foreach($arraySucursales as $key => $value)
                    {
                        $inventario = new Inventario();
                        $inventario->idSucursal = $value;
                        $inventario->idProducto = $Producto->id;
                        $inventario->cantidad = $row["sucursal_".$value."_".$key];
                        $inventario->save();
                        $inventario = null;
                    }
                    
                    $Producto = null;
                };
            });
            
    }
}
