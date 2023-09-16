<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    //userテーブルと多対多
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    //他テーブルと一対多
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    
    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }
    
    public function costs()
    {
        return $this->hasMany(Cost::class);
    }
    
    public function entryFees()
    {
        return $this->hasMany(EntryFee::class);
    }
    
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
    
    public function performers()
    {
        return $this->hasMany(Performer::class);
    }
    
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
