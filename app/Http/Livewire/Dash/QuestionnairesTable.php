<?php

namespace App\Http\Livewire\Dash;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class QuestionnairesTable extends DataTableComponent
{
    protected $listeners = [
        'questionnaireTable' => '$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Questionnaire')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.questionnaire-name', ['data' => $row]);
                }),
            Column::make('Link')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return '<a href="' . route('survey', $row->uri) . '" class="text-indigo-600 font-semibold hover:underline cursor-pointer">' . route('survey', $row->uri) . '</a>';
                })
                ->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.questionnaire-actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Questionnaire::query()
            ->with('questions')
            ->where('status', 1)
            ->latest();
    }
}
