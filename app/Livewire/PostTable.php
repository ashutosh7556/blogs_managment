<?php

 namespace App\Livewire;

 use App\Models\Post;
 use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Support\Facades\Auth;
 use Rappasoft\LaravelLivewireTables\DataTableComponent;
 use Rappasoft\LaravelLivewireTables\Views\Column;

 class PostTable extends DataTableComponent
 {
     protected $model = Post::class;

     public function configure(): void
     {
         $this->setPrimaryKey('id')
              ->setDefaultSort('created_at', 'desc');
     }

     public function builder(): Builder
     {
         return Post::query()
             ->with('category')
             ->select('posts.*')
             ->when(
                 !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('author'),
                 fn ($q) => $q->where('user_id', Auth::id())
             );
     }


     public function columns(): array
     {
         return [
             Column::make('Title', 'title')
                   ->sortable()
                   ->searchable(),

              Column::make('Content', 'content')
                  ->sortable()
                  ->searchable()
                  ->format(fn($value) => \Illuminate\Support\Str::limit($value, 20)),


             Column::make('Category', 'category.name')
                   ->sortable(),

             Column::make('Created', 'created_at')
                   ->sortable()
                   ->format(fn ($v) => optional($v)->diffForHumans()),

             Column::make('Actions')
                   ->label(fn (Post $row) => view('livewire.post-actions', [
                       'post' => $row,
                   ])->render())
                   ->html(),
         ];
     }
 }
