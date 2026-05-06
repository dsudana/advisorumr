<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeadStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'order',
        'description',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'order' => 'integer',
    ];

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'status');
    }

    public static function getDefaultStatuses(): array
    {
        return [
            ['name' => 'new', 'color' => '#3498db', 'order' => 1, 'description' => 'New lead, not yet contacted', 'is_default' => true],
            ['name' => 'contacted', 'color' => '#f39c12', 'order' => 2, 'description' => 'Lead has been contacted'],
            ['name' => 'qualified', 'color' => '#9b59b6', 'order' => 3, 'description' => 'Qualified lead with genuine interest'],
            ['name' => 'proposal_sent', 'color' => '#34495e', 'order' => 4, 'description' => 'Proposal or quotation sent'],
            ['name' => 'negotiation', 'color' => '#e67e22', 'order' => 5, 'description' => 'In negotiation phase'],
            ['name' => 'converted', 'color' => '#27ae60', 'order' => 6, 'description' => 'Successfully converted to customer'],
            ['name' => 'lost', 'color' => '#e74c3c', 'order' => 7, 'description' => 'Lead lost or unresponsive'],
        ];
    }
}
