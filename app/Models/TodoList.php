<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'desc', 'status', 'completed'];

    public function scopeUpdateTodoByStatus($query, $id, $status)
    {
        if ($status == 'COMPLETED') {
            return $query->find($id)->update([
                'status' => $status,
                'completed' => true,
            ]);
        }
        return $query->find($id)->update(['status' => $status]);
    }

    public function scopeCompleted($query, $completed = true)
    {
        return $query->where('completed', $completed);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
