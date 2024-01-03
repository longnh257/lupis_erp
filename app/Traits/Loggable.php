<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\UserActivityLog;

trait Loggable
{
    public static function bootLoggable()
    {

        static::updated(function (Model $model) {
            $old_value = json_encode($model->getOriginal());
            //Get which columns changed
            $current_user_name = \Auth::user()->name;
            $current_user_email = \Auth::user()->email;
            $changes = array_keys($model->getDirty());
            $model_name = class_basename(get_class($model));

            $array_new_value = array();
            foreach ($changes as $key => $change) {
                if ($model[$change] != null) {
                    // $array_data =
                    $array_new_value[$change] = $model[$change];
                }
            }


            //Creates a log for every column changed
            $array_new_value = array();
            foreach ($changes as $key => $change) {
                if ($model[$change] !== null) {
                    $array_new_value[$change] = $model[$change];
                }
            }
            $new_value = json_encode($array_new_value);
            $string_new_value = implode(",", $array_new_value);

            // Creates a log for created action
            $log = new UserActivityLog;
            $log->user_id = \Auth::check() ? \Auth::id() : 1;
            $log->action = 'updated';
            $log->model_path = get_class($model);
            $log->model_name = $model_name;
            $log->table = $model->table;
            $log->row = $model->id;
            $log->messages = $current_user_name." (".$current_user_email.") updated: ".$string_new_value." in model". $model_name . " id ".$model->id;
            $log->new_value = $new_value;
            $log->old_value = $old_value;
            $log->ip_address = $_SERVER['REMOTE_ADDR'];
            $log->user_agent  = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No UserAgent';
            $log->created_at = now();
            $log->save();

        });

        static::created(function (Model $model) {
            //Get which columns changed
            $current_user_name = \Auth::check() ? \Auth::user()->name : 'Super Admin';
            $current_user_email = \Auth::check() ? \Auth::user()->email : 'admin@gmail.com';
            $changes = array_keys($model->getDirty());
            $model_name = class_basename(get_class($model));
            // echo "<pre/>";print_r( );die;

            // Format changed data to json
            $array_new_value = array();
            foreach ($changes as $key => $change) {
                if ($model[$change] != null) {
                    // $array_data =
                    $array_new_value[$change] = $model[$change];
                }
            }
            $new_value = json_encode($array_new_value);

            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $clientIP = @$_SERVER['REMOTE_ADDR'];
            }
            // Creates a log for created action
            $log = new UserActivityLog;
            $log->user_id = \Auth::check() ? \Auth::id() : '1';
            $log->action = 'created';
            $log->model_path = get_class($model);
            $log->model_name = $model_name;
            $log->table = $model->table;
            $log->row = $model->id;
            $log->messages = $current_user_name." (".$current_user_email.") created ". $model_name." id ".$model->id;
            $log->new_value = $new_value;
            $log->old_value = "";
            $log->ip_address = $clientIP;
            $log->user_agent  = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No UserAgent';
            $log->created_at = now();
            $log->save();

        });

        static::deleted(function (Model $model) {
            $current_user_name = \Auth::user()->name;
            $current_user_email = \Auth::user()->email;
            $model_name = class_basename(get_class($model));
            // echo "<pre/>";print_r();die;

            $old_value = json_encode($model->attributesToArray());

            // Creates a log for deleted action
            $log = new UserActivityLog;
            $log->user_id = \Auth::id();
            $log->action = 'deleted';
            $log->model_path = get_class($model);
            $log->model_name = $model_name;
            $log->table = $model->table;
            $log->row = $model->id;
            $log->messages = $current_user_name." (".$current_user_email.") deleted ". $model_name . " id ".$model->id;
            $log->new_value = "";
            $log->old_value = $old_value;
            $log->ip_address = $_SERVER['REMOTE_ADDR'];
            $log->user_agent  = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No UserAgent';
            $log->created_at = now();
            $log->save();

        });
    }

    private function saveLog($model, $action, $column, $data)
    {
        $log = new UserActivityLog;

        $log->user_id = \Auth::id();
        $log->action = $action;
        $log->model = get_class($model);
        $log->column = $column;
        $log->row = $model->id;
        $log->data = $data;
        $log->created_at = now();

        $log->save();
    }



}
