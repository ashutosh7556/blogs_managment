<?php

 namespace App\Livewire;

 use App\Models\Category;
 use Illuminate\Database\Eloquent\Builder;
 use Rappasoft\LaravelLivewireTables\DataTableComponent;
 use Rappasoft\LaravelLivewireTables\Views\Column;

 class CategoryTable extends DataTableComponent
 {
     protected $model = Category::class;

     public function configure(): void
     {
         $this->setPrimaryKey('id')
              ->setDefaultSort('created_at', 'desc')
              ->setTableAttributes([
                  'class' => 'min-w-full table-auto border border-gray-300 text-sm rounded-md shadow-sm bg-white',
              ])
              ->setTheadAttributes([
                  'class' => 'bg-gray-100 text-gray-600 text-xs uppercase tracking-wider',
              ])
              ->setThAttributes(fn ($column) => [
                  'class' => 'px-3 py-2 text-left whitespace-nowrap',
              ])
              ->setTdAttributes(fn ($column, $row, $columnIndex, $rowIndex) => [
                  'class' => 'px-3 py-2 text-gray-800 whitespace-nowrap',
              ])
              ->setTbodyAttributes([
                  'class' => 'divide-y divide-gray-200',
              ]);
     }

     public function builder(): Builder
     {
         return Category::query()->select('categories.*'); // ✅ Ensures full model is loaded
     }

     public function columns(): array
     {
         return [
             Column::make('Name', 'name')->sortable()->searchable(),

             Column::make('Created At', 'created_at')
                 ->format(fn ($value) => optional($value)->diffForHumans()),

             Column::make('Actions')
                 ->label(fn ($row) =>
                     view('livewire.category-table-actions', ['category' => $row])->render()
                 )
                 ->html(),
         ];
     }
 }
