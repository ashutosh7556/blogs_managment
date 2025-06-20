<?php

 namespace App\Livewire;

 use App\Models\Category;
 use Rappasoft\LaravelLivewireTables\DataTableComponent;
 use Rappasoft\LaravelLivewireTables\Views\Column;

 class CategoryTable extends DataTableComponent
 {
     protected $model = Category::class;

     public function configure(): void
     {
         $this->setPrimaryKey('id')
             ->setDefaultSort('created_at', 'desc');
     }

      public function columns(): array
      {
          return [
              Column::make('Name', 'name')->sortable()->searchable(),

              Column::make('Created At', 'created_at')
                  ->format(fn($value) => optional($value)->diffForHumans()),

              Column::make('Actions')
                  ->label(fn($row) =>
                      view('livewire.category-table', ['category' => $row])->render()
                  )
                  ->html(),
          ];
      }

     }

