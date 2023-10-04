<?php

namespace App\Http\Services;

use App\Contracts\AuthTenantContract;
use App\Exceptions\CustomException;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

/**
* @var AuthTenantService
*/
class AuthTenantService implements AuthTenantContract
{
    protected $model;
        public function __construct(){
        $this->model = new Tenant();

    }
    public function register($data)
    {
        $model = new $this->model;
        $user = $this->prepareData($model, $data, true);
        return $user;
    }
    public function prepareData($model, $input , $new_record = false)
    {
        if ($new_record){
            $model->id = ($model->count())+1;
        }
        if (isset($input['package_id']) && $input['package_id'] != '') {
            $model->package_id = $input['package_id'];
        }
        if (isset($input['name']) && $input['name'] != '') {
            $model->name = $input['name'];
        }
        if (isset($input['email']) && $input['email'] != '') {
            $model->email = $input['email'];
        }
        if (isset($input['phone']) && $input['phone'] != '') {
            $model->phone = $input['phone'];
        }
        if (isset($input['bank_name']) && $input['bank_name'] != '') {
            $model->bank_name = $input['bank_name'];
        }
        if (isset($input['account_number']) && $input['account_number'] != '') {
            $model->account_number = $input['account_number'];
        }
        if (isset($input['latitude']) && $input['latitude'] != '') {
            $model->latitude = $input['latitude'];
        }
        if (isset($input['longitude']) && $input['longitude'] != '') {
            $model->longitude = $input['longitude'];
        }
        if (isset($input['address']) && $input['address'] != '') {
            $model->address = $input['address'];
        }
        if (isset($input['logo']) && $input['logo'] != '') {
            $model->logo = $input['logo'];
        }
        if (isset($input['about']) && $input['about'] != '') {
            $model->about = $input['about'];
        }
        if (isset($input['website']) && $input['website'] != '') {
            $model->website = $input['website'];
        }
        if (isset($input['industry']) && $input['industry'] != '') {
            $model->industry = $input['industry'];
        }
        if (isset($input['company_size']) && $input['company_size'] != '') {
            $model->company_size = $input['company_size'];
        }
        if (isset($input['headquarter']) && $input['headquarter'] != '') {
            $model->headquarter = $input['headquarter'];
        }
        if (isset($input['is_verified']) && $input['is_verified'] != '') {
            $model->is_verified = $input['is_verified'];
        }
        if (isset($input['is_actively_recruiting']) && $input['is_actively_recruiting'] != '') {
            $model->is_actively_recruiting = $input['is_actively_recruiting'];
        }
        if (isset($input['domain']) && $input['domain'] != '') {
            $model->domain = $input['domain'];
        }
//        if (isset($input['password']) && $input['password'] != '') {
            $model->password = bcrypt('password');
//        }
        $model->save();
        if ($new_record) {
            $model->domains()->create([
                'domain' => $input['domain'] . '.' . config('app.domain'),
            ]);
        }
        return $model;
    }
}
