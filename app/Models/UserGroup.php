<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{

	protected $table = 'user_groups';

	protected $perPage = 10;

	protected $fillable = [
		'id',
		'user_id',
		'group_name',
		'created_at',
		'updated_at',
	];

	public function user_id()
	{
		return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
	}

	public function role()
	{
		return $this->hasMany(\App\Models\UserGroupRole::class, 'user_groups_id', 'id');
	}
}
