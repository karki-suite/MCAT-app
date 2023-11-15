<?php

namespace App\Models;

use App\Models\Content\Group;
use App\Models\Content\Response;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'content_responses'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getResponsesArray(): array
    {
        return json_decode($this->content_responses, true);
    }

    public function isResponseComplete(int $contentId): bool
    {
        $responses = $this->getResponsesArray();
        return isset($responses[$contentId]) && strlen($responses[$contentId]) > 0
        && $responses[$contentId] !== 'false';
    }

    public function getResponsesCompletedPercentage(array $contentIds): int
    {
        $completed = [];
        foreach($contentIds as $contentId) {
            $completed[] = $this->isResponseComplete($contentId);
        }
        if(count($completed) == 0) {
            return 0;
        }

        return round(count(array_filter($completed)) / count($completed) * 100);
    }

    public function getResponseCompletionSummary(): array
    {
        $groups = Group::all();
        $completion = [];
        foreach($groups as $group) {
            $groupSummary = [];
            $groupSummary['all'] = $this->getResponsesCompletedPercentage($group->contentIds());
            foreach($group->categories as $category) {
                $categoryContentIds = $category->contents->pluck('id')->toArray();
                $groupSummary[$category->title] = $this->getResponsesCompletedPercentage($categoryContentIds);
            }
            $completion[$group->shortname] = $groupSummary;
        }
        return $completion;
    }
}
