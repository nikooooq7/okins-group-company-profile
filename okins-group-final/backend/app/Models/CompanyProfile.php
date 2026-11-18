<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CompanyProfile extends Model {
    protected $fillable = ['name','description','vision','address','email','phone'];
}
