<?php

namespace Database\Seeders;

use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Domain\Models\User as ModelsUser;
use App\Domain\Models\UserCommon;
use App\Domain\Models\UserShopKeeper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            new UserCommon([
                'name' => 'Usuário Comum',
                'email' => 'user_common@email.com.br',
                'document' => '547.974.880-77',
                'document_type' => Document::cpf,
                'password' => Hash::make('12345678')
            ]),
            new UserShopKeeper([
                'name' => 'Usuário Lojista',
                'email' => 'user_shopkeeper@email.com.br',
                'document' => '32.637.346/0001-91',
                'document_type' => Document::cnpj,
                'password' => Hash::make('12345678')
            ]),
        ];

        foreach ($users as $user) {
            $user->save();
        }
    }
}
