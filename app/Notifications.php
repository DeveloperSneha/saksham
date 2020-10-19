<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model {
    
    protected $primaryKey = 'idNotification';
    protected $table = 'notifications';
    protected $fillable = ['type','text', 'url','file','status'];

}
