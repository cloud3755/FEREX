<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->command->info('USERS creados');
    }
}

class UsersTableSeeder extends Seeder {

        public function run()
        {
           
          db::table('users')->insert(array(
                   'name' => "ferex",
                   'email'     => 'ferex@ferex.com',
                   'password'    =>  Hash::make('ferex@ferex.com'),
                   'idSucursal'      =>  1,
                   'permisos'      =>  1,
                 )
            );
            db::table('sucursales')->insert(array(
                   'nombre' => "Matriz",
                   
            ));
            db::table('direcciones')->insert(array(
              
                'numInterior' => '',
                'numExterior'=> "5099",
                'calle'=> "Av Mariano Otero",
                'entre1'=> "",
                'entre2'=> "",
                'referencia'=> "",
                'colonia'=> "La Calma",
                'CP'=> "45070",
                'ciudad'=> "Zapopan",
                'estado'=> "Jalisco",
                'pais'=>"México"
                
             ));
             db::table('sucursales_direcciones')->insert(array(
                'idSucursal' => 1,
                'idDireccion' => 1,
                'tipo'=> "principal"
             ));
          
           
            
            db::table('productos')->insert(array(
                   'nombre' => "Producto dummie",
                   'descripcion'     => 'Producto dummie',
                   'claveProdServ'     => '0101010101',
                   'codigoBarras'     => '000000',
                   'precioA'     => 99.99,
            ));     
            /*for($i=0 ; $i< 10000; $i++)
            {
            db::table('productos')->insert(array(
                   'nombre' => $i,
                   'descripcion'     => '12',
                   'claveProdServ'     => '0101010101',
                   'codigoBarras'     => $i,
                   'precioA'     => 99.99,
            ));     
            }*/
            db::table('cajas')->insert(array(
                'nombre' => "Principal",
                'saldo'     => 0,
                'estado'     => 'NI',
                'idSucursal'     => 1,
            ));


            db::table('clientes')->insert(array(
                'id' => "0",
                'nombre'     => "Cliente general",
                'razonSocial'     => '0000',
                'contacto'     => "00",
                'rfc' => "0000",
                'email'     => "000",
                'limiteCredito'     => '0',
                'credito'     => "0",
                'telefono1' => "0",
                'telefono2'     => 0,
                'telefono3'     => '0',
                'consumoTotal'     => 0,
                'activo' => "1",
                'idDireccion'     => 1,

            ));
        }
}
