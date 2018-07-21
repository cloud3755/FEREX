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
                   'direccion'     => 'Mariano Otero SN',
            ));
            db::table('productos')->insert(array(
                   'nombre' => "Producto dummie",
                   'descripcion'     => 'Producto dummie',
                   'claveProdServ'     => '0101010101',
                   'codigoBarras'     => '000000',
                   'precio'     => 99.99,
            ));        

        }
}
