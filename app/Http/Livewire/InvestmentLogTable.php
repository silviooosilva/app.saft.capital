<?php

namespace App\Http\Livewire;

use App\Exports\TradeLogExport;
use App\Models\InvestmentLog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class InvestmentLogTable extends DataTableComponent
{

    public function builder(): Builder
    {
        return InvestmentLog::query()->with(['plan', 'user']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setColumnSelectDisabled()
            ->setFilterLayoutSlideDown()
            ->setOfflineIndicatorEnabled()
            ->setEmptyMessage('No results found');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("user", "user_id")
                ->hideIf(true),
            Column::make("Username", "user.username")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row, Column $column) {
                        if ($row->user) {
                            return '<a href="' . route('admin.users.detail', $row->user_id) . '" class="badge bg-primary">' . ucfirst($row->user->username) . '</a>';
                        } else {
                            return '<span class="badge bg-danger">' . __('Account Not Found') . '</span>';
                        }
                    }
                )
                ->html(),
            Column::make("Plan", "investment_plan_id")
                ->searchable()
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) => $row->plan->name ?? $row->investment_plan_id
                )
                ->html(),
            Column::make("Amount", "amount")
                ->searchable()
                ->collapseOnTablet()
                ->sortable(),
            Column::make("Profit", "profit")
                ->searchable()
                ->collapseOnTablet()
                ->sortable(),
            Column::make("Status", "status")
                ->view('admin.investment.status_view'),
            Column::make("Start Date", "created_at")
                ->searchable()
                ->collapseOnTablet()
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) => showDateTime($row->created_at, 'd M, Y h:i:s')
                )
                ->html(),
            Column::make("End Date", "end_date")
                ->searchable()
                ->collapseOnTablet()
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) => showDateTime($row->end_date, 'd M, Y h:i:s')
                )
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->setFilterPillTitle('Status')
                ->setFilterPillValues([
                    ''    => 'Any',
                    '3' => 'Cancelled',
                    '2' => 'Completed',
                    '1' => 'Active',
                ])
                ->options([
                    '' => 'All',
                    '3' => 'Cancelled',
                    '2' => 'Completed',
                    '1' => 'Active',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('investments_log.status', $value);
                }),
            DateFilter::make('From')
                ->config([
                    'min' => '2020-01-01',
                    'max' => date('y-m-d'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('investments_log.created_at', '>=', $value);
                }),
            DateFilter::make('To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('investments_log.created_at', '<=', $value);
                }),
        ];
    }
}
