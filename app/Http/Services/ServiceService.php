<?php


namespace App\Http\Services;


use App\Models\Service;
use App\Models\User;
use App\Notifications\SmsNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ServiceService implements ServiceServiceInterface
{

    /**
     * Store a newly created resource in storage.
     * @param array $params
     * @return Builder|Model
     */
    public function store(array $params)
    {
        $serviceModel = Service::query()->create($params);
        if (isset($params['users'])) {
            $this->saveUsers($params['users'], $serviceModel->id);
        }
        if (isset($params['types'])) {
            $serviceModel->types()->sync($params['types']);
        }
        return $serviceModel;
    }

    /**
     * Update the specified resource in storage.
     * @param array $attribute
     * @param int $id
     * @return Builder|Model
     */
    public function update(array $attribute, int $id)
    {
        $serviceModel = Service::query()->where('id', $id);
        $serviceModel->update($attribute);
        if (isset($params['users'])) {
            $this->saveUsers($params['users'], $serviceModel->id);
        }
        if (isset($params['types'])) {
            $serviceModel->types()->sync($params['types']);
        }
        return $serviceModel;
    }

    public function saveUsers(array $usersId, int $serviceId)
    {
        $users = [];
        $serviceModel = Service::query()->firstWhere('id', $serviceId);
        foreach ($usersId as $id) {
            if (User::where('id', $id)->whereHas('services', function ($q) use ($id) {
                $q->where('user_id', $id);
            })
                ->exists()) {
                continue;
            }else{
                $user = User::query()->firstWhere('id', $id);
                $user->notify(
                    new SmsNotification("У вас работа $serviceModel->name")
                );
                $users[] = $id;
            }
        }
        if (isset($users[0])) {
            $serviceModel->users()->sync($users);
        }
        return $users;
    }
}
