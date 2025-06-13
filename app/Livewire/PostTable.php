<?php

namespace App\Livewire;

use App\Models\Post;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PostTable extends DataTableComponent
{
    /** Quick way to tell the table which model to use */
    protected $model = Post::class;

    /** OPTIONAL table options */
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }a

    /** Column definitions */
    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Category', 'category.name')
                ->sortable(),

            Column::make('Created', 'created_at')
                ->sortable()
                ->format(fn($value) => $value->diffForHumans()),

            Column::make('Actions')
                ->label(fn($row) => view('components.post-actions', ['post' => $row])),
        ];
    }
}











//
//namespace App\Livewire;
//
//use Livewire\Component;
//
//class PostTable extends Component
//{
//    public function render()
//    {
//        return view('livewire.post-table');
//    }
//}
