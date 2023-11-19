<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupRole extends Model
{
	protected $table = 'user_group_roles';
	protected $fillable = [
		'id',
		'name',
		'show',
		'add',
		'edit',
		'delete',
		'financial',
		'user_groups_id',
	];

	public function user_groups_id()
	{
		return $this->hasMany(\App\Models\UserGroup::class, 'id', 'user_groups_id');
	}
}
