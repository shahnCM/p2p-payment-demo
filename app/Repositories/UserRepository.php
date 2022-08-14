<?php

namespace App\Repositories;

use App\DataTransferObjects\UserCreateDto;
use App\Models\User;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    protected String $modelName = User::class;

    private static UserRepository $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function createNewUser(UserCreateDto $userCreateDto, bool $toArray = true): null|array|Model
    {
        $data = [
            'name' => $userCreateDto->get('name'),
            'email' => $userCreateDto->get('email'),
            'password' => $userCreateDto->get('password')
        ];

        $user = $this->model->query()->create($data);

        return $toArray ? $user->toArray() : $user;
    }

    public function findUserById(int $userId, bool $toArray = true): null|array|User
    {
        $user = $this->model->query()->find($userId);
        return $toArray ? $user?->toArray() : $user;
    }

    public function getNthHighestTransaction(int $n = 1, int $userId = null): null|array
    {
        $query = $this->model->query();

        $query->with(['completedDebitTransactions' => function ($q) use ($n){
            $q->orderByRaw('CONVERT(amount_before, SIGNED) desc')->offset($n - 1)->limit(1);
        }]);

        $query->whereHas('completedDebitTransactions', function ($q) use ($n) {
            $q->where('status', TransactionStatus::S);
        });

        if(!is_null($userId)) {
            return $query->where('id', $userId)->first()?->toArray();
        }

        return $query->get()?->toArray();
    }
}
