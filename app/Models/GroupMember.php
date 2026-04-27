<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $fillable = [
    'group_session_id',
    'student_id',
    'nomor_kelompok'
];
}
