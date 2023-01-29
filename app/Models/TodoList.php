<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'status', 'completed'];

    public function scopeUpdateTaskByStatus($query, $id, $status)
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
}
