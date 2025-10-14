<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_description' => $this->project_description,
            'is_shared' => $this->is_shared,
            'user' => User::make($this->user),
            'photos' => File::collection($this->photos),
            'videos' => File::collection($this->videos),
            'audios' => File::collection($this->audios),
            'documents' => File::collection($this->documents),
            'sheets' => File::collection($this->sheets),
            'project_answers' => ProjectAnswer::collection($this->project_answers),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'user_id' => $this->user_id
        ];
    }
}
