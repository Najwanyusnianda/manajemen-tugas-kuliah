<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     *
     */
    protected $fillable = [
        'name', 'color','person_in_charge','user_id'
    ];
    

    /**
     * Get all projects.
     *
     */
    public static function getAllProjects($search = null)
    {
        #$query = static::query();
        $query = static::where('user_id', auth()->id());
        // If there's a search criteria, filter projects based on it
        if ($search !== null) {
            $query->whereNull('deleted_at');
            $query->where('name', 'like', '%' . $search . '%');
            $query->orderBy('id', 'DESC');
        }

        return $query->get();
    }

    /**
     * Create a new project.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function createProject(array $data)
    {
        $data['user_id'] = auth()->id();
        return static::create($data);
    }

    /**
     * Update a project.
     *
     */
    public function updateProject(array $data)
    {
        return $this->update($data);
    }

    /**
     * Soft delete a project.
     *
     */
    public function deleteProject()
    {
        return $this->delete();
    }
}
